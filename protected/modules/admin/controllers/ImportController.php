<?php

/*
  # Author: Austin
  # Date: 18/10/2013
  # Version: 1.0
  # Description: this controller use for importing product, category, attributes, types
 */

class ImportController extends AdminController {

    public function actionIndex() {
        $model = new ImportForm('create');

        if (isset($_POST['ImportForm'])) {
            $model->attributes = $_POST['ImportForm'];
            $model->filename = $_POST['ImportForm']['filename'];
            $model->filename = CUploadedFile::getInstance($model, 'filename');
            if ($model->validate())
            {
                $model->filename->saveAs('upload/import/' . $model->filename->name);
                $documentFilename = Yii::getPathOfAlias('webroot') . '/upload/import/' . $model->filename->name;
                $_SESSION['import_file_name'] = $documentFilename;
                $this->redirect(Yii::app()->createAbsoluteUrl('/admin/import/index'));
            }
        }

        $this->render('index', array('model' => $model));
    }
    
    public function actionRemoveFile()
    {
        if ($_SESSION['import_file_name'])
        {
            unlink ($_SESSION['import_file_name']);
            unset($_SESSION['import_file_name']);
            $this->redirect(Yii::app()->createAbsoluteUrl("admin/import"));
        }
    }

    public function actionImportAttribute() {
        $tableName = 'precicon_import_attributes';
        $categoryTable = 'precicon_prec_categories';
        $brandTable = 'precicon_prec_brand';
        $attributeTable = 'precicon_prec_attributes';
        $categoryAttributeTable = 'precicon_prec_categories_attributes';
        //get import file path from session
        $documentFilename = $_SESSION['import_file_name'];
        //check if file exists
        if (file_exists($documentFilename)) {
            //read sheet product family with index 0
            $sheet1 = new ExcelReader($documentFilename, 0);
            Yii::app()->db->createCommand('truncate table ' . $tableName)->query();
            unset($sheet1->data[1]);
            if (count($sheet1) > 0) {
                //building import query
                $sql = "INSERT INTO " . $tableName . " (`sn`, `brand`, `category`, `attribute`, `show_on_filter`) VALUES ";
                $columns = array('A', 'B', 'C', 'D', 'E');
                foreach ($sheet1->data as $item) {
                    if ((int) $item['A'] > 0 && $item['B'] != '') {
                        $sql .= "(";
                        foreach ($columns as $col)
                            $sql .= "'" . $this->escapeValues($item[$col]) . "',";
                        //remove latest comma
                        $sql = trim($sql, ',');
                        $sql .= "),";
                    }
                }
                //remove latest comma
                $sql = trim($sql, ',');
                //do import 1 time to safe connect to database and improved loading speed
                Yii::app()->db->createCommand($sql)->query();
                //update filter from Yes/No to 0/1
                $sql = "Update " . $tableName . " set filtered = 0 where `show_on_filter` = 'No'; 
                        Update " . $tableName . " set filtered = 1 where `show_on_filter` = 'Yes'; 
                        ";
                Yii::app()->db->createCommand($sql)->query();

                //update all reference existing ID to temp table
                $this->updateProductAttributeReferenceID();

                $sql = "UPDATE " . $tableName . " SET is_new = 1 WHERE attribute_id = 0 or category_id = 0";
                Yii::app()->db->createCommand($sql)->query();

                //insert new attribute records
                $sql = "Insert Into " . $attributeTable . "(`name`, `show_on_filter`)
                        SELECT `attribute`, filtered FROM " . $tableName . "
                            WHERE attribute_id = 0 GROUP BY `attribute`";
                Yii::app()->db->createCommand($sql)->query();

                //insert category attributes
                $sql = "SELECT category_id, attribute_id, sn FROM " . $tableName . " WHERE category_id <> 0";
                $list = Yii::app()->db->createCommand($sql)->queryAll();
                foreach ($list as $row) {
                    $sql = "SELECT id FROM " . $categoryAttributeTable . " 
                            WHERE category_id = " . (int) $row['category_id'] . " AND attribute_id = " . (int) $row['attribute_id'];
                    $existCatAttr = Yii::app()->db->createCommand($sql)->queryAll();
                    if (count($existCatAttr) == 0) {
                        $sql = "Insert Into " . $categoryAttributeTable . " (`category_id` , `attribute_id`, `display_order`)
                                VALUES (" . (int) $row['category_id'] . ", " . (int) $row['attribute_id'] . ", " . (int) $row['sn'] . ")";
                        Yii::app()->db->createCommand($sql)->query();
                    }
                }
                $this->updateProductAttributeReferenceID();
                $this->buildAttributeColumn();
            }
        }
        //die;
        $this->render('index', array('model' => $model));
    }

    public function buildAttributeColumn() {
        $tableName = 'precicon_import_attributes';

        $sql = "SELECT * FROM " . $tableName . " WHERE category_id <> 0 GROUP BY category_id";
        $categoryList = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($categoryList as $cat) {
            $sql = "SELECT * FROM " . $tableName . " WHERE category_id = " . (int) $cat['category_id'];
            $attrList = Yii::app()->db->createCommand($sql)->queryAll();
            $i = 1;
            foreach ($attrList as $attr) {
                $sql = "UPDATE $tableName SET attr_colname = '" . 'att' . $i . "' WHERE sn = " . $attr['sn'];
                Yii::app()->db->createCommand($sql)->query();
                $i++;
            }
        }
    }

    private function updateProductAttributeReferenceID() {
        $tableName = 'precicon_import_attributes';
        $categoryTable = 'precicon_prec_categories';
        $brandTable = 'precicon_prec_brand';
        $attributeTable = 'precicon_prec_attributes';
        //update existing child category to temp table
        $sql = "Update " . $tableName . " a INNER JOIN " . $categoryTable . " c 
                ON c.name COLLATE utf8_unicode_ci = a.`category` COLLATE utf8_unicode_ci  
                set a.`category_id`  = c.id";
        Yii::app()->db->createCommand($sql)->query();

        //update existing brand to temp table
        $sql = "Update " . $tableName . " a INNER JOIN " . $brandTable . " b 
                ON b.name COLLATE utf8_unicode_ci = a.`brand` COLLATE utf8_unicode_ci  
                set a.`brand_id`  = b.id";
        Yii::app()->db->createCommand($sql)->query();

        //update existing attributes to temp table
        $sql = "Update " . $tableName . " a INNER JOIN  " . $attributeTable . " ma 
                ON ma.name COLLATE utf8_unicode_ci  = a.`attribute` COLLATE utf8_unicode_ci  
                set a.`attribute_id` = ma.id";
        Yii::app()->db->createCommand($sql)->query();
    }

    public function actionImportProductFamily() {
        $tableName = 'precicon_import_productfamily';
        $categoryTable = 'precicon_prec_categories';
        $brandTable = 'precicon_prec_brand';
        $productFamilyTable = 'precicon_prec_product_family';
        $categoryGroupTable = 'precicon_categories_group';
        //get import file path from session
        $documentFilename = $_SESSION['import_file_name'];
        //check if file exists
        if (file_exists($documentFilename)) {
            //read sheet product family with index 1
            $sheet1 = new ExcelReader($documentFilename, 1);
            //Clean up temporary product family
            Yii::app()->db->createCommand('truncate table ' . $tableName)->query();
            //remove unuse rows
            for ($i = 1; $i < 6; $i++)
                unset($sheet1->data[$i]);

            if (count($sheet1) > 0) {
                //building import query
                $sql = "INSERT INTO " . $tableName . " (`s_n`, `brand`, `category`, `product_name`, group_name, `pcm`, `image`, `brochure`, `att1`, `att2`, `att3`, `att4`, `att5`, `att6`, `description`) VALUES ";
                $columns = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O');
                foreach ($sheet1->data as $item) {
                    if ((int) $item['A'] > 0 && $item['B'] != '') {
                        $sql .= "(";
                        foreach ($columns as $col)
                            $sql .= "'" . $this->escapeValues($item[$col]) . "',";
                        //remove latest comma
                        $sql = trim($sql, ',');
                        $sql .= "),";
                    }
                }
                //remove latest comma
                $sql = trim($sql, ',');
                //do import 1 time to safe connect to database and improved loading speed
                Yii::app()->db->createCommand($sql)->query();

                //update existing id to temp table
                $this->updateProductFamilyReferenceID();

                //Insert new records to brand table
                $sql = "insert into " . $brandTable . " (`name`, `slug`, `status`)
                        SELECT `brand`, lower(replace(`brand`, ' ', '-')), 1 FROM  " . $tableName . " 
                         WHERE brand_id = 0 GROUP BY `brand`";
                Yii::app()->db->createCommand($sql)->query();

                //insert new group category records to category table
                $sql = "insert into " . $categoryGroupTable . " (`name`, `created_date`)
                        SELECT `group_name`, now() FROM " . $tableName . " 
                        WHERE group_id = 0 GROUP BY group_name";
                Yii::app()->db->createCommand($sql)->query();
                
                $sql = "insert into " . $categoryTable . " (`name`, `slug`, `parent_id`, `status`)
                        SELECT `pcm`, lower(replace(pcm, ' ', '-')), 0, 1 FROM " . $tableName . " 
                        WHERE parent_id = 0 GROUP BY pcm";
                Yii::app()->db->createCommand($sql)->query();

                //update existing id to temp table
                $this->updateProductFamilyReferenceID();

                //insert new child category records to category table
                $sql = "insert into " . $categoryTable . " (`name`, `slug`, `parent_id`, `status`, category_group_id)
                        SELECT `category`, lower(replace(category, ' ', '-')), parent_id, 1, group_id FROM " . $tableName . " 
                        WHERE category_id = 0 GROUP BY category";
                Yii::app()->db->createCommand($sql)->query();
                
                


                //update existing id to temp table
                $this->updateProductFamilyReferenceID();

                //insert new product family records
                $sql = "Insert Into " . $productFamilyTable . " (`category_id`, `brand_id`, `name`, `slug`, `keyword`, `image`, `brochure`, `whitepaper`, `description`, `created_date`, `status`)
                        SELECT `category_id`, `brand_id`, product_name, lower(replace(product_name, ' ', '-')), lower(product_name), 
                        `image`, `brochure`, '', `description`, now(), 1 FROM " . $tableName . " WHERE product_id = 0";
                Yii::app()->db->createCommand($sql)->query();

                //update existing id to temp table 
                $this->updateProductFamilyReferenceID();

                //update category image
                $sql = "UPDATE " . $categoryTable . " c INNER JOIN (SELECT p.image, p.category_id FROM 
                        " . $productFamilyTable . " p group by p.category_id) as m on m.category_id = c.id 
                        set c.`image` = m.`image`";
                Yii::app()->db->createCommand($sql)->query();
            }
        }
        //die;
        $this->render('index', array('model' => $model));
    }

    private function updateProductFamilyReferenceID() {
        $tableName = 'precicon_import_productfamily';
        $categoryTable = 'precicon_prec_categories';
        $brandTable = 'precicon_prec_brand';
        $productFamilyTable = 'precicon_prec_product_family';
        $categoryGroupTable = 'precicon_categories_group';
        
        //update existing parent category to temp table
        $sql = "Update " . $tableName . " a INNER JOIN " . $categoryTable . " c 
                ON c.name COLLATE utf8_unicode_ci = a.`pcm` COLLATE utf8_unicode_ci  
                set a.`parent_id`  = c.id";
        Yii::app()->db->createCommand($sql)->query();

        //update existing child category to temp table
        $sql = "Update " . $tableName . " a INNER JOIN " . $categoryTable . " c 
                ON c.name COLLATE utf8_unicode_ci = a.`category` COLLATE utf8_unicode_ci  
                set a.`category_id`  = c.id";
        Yii::app()->db->createCommand($sql)->query();

        $sql = "Update " . $tableName . " a INNER JOIN " . $brandTable . " b 
                ON b.name COLLATE utf8_unicode_ci = a.`brand` COLLATE utf8_unicode_ci  
                set a.`brand_id`  = b.id";
        Yii::app()->db->createCommand($sql)->query();

        $sql = "Update " . $tableName . " f INNER JOIN " . $productFamilyTable . " c 
                ON c.name COLLATE utf8_unicode_ci = f.product_name COLLATE utf8_unicode_ci 
                set f.product_id = c.id";
        Yii::app()->db->createCommand($sql)->query();
        
        $sql = "Update " . $tableName . " a INNER JOIN " . $categoryGroupTable . " c 
                ON c.name COLLATE utf8_unicode_ci = a.`group_name` COLLATE utf8_unicode_ci  
                set a.`group_id`  = c.id";
        Yii::app()->db->createCommand($sql)->query();
    }

    public function actionImportProductModel() {
        $tableName = 'precicon_import_productmodel';
        $categoryTable = 'precicon_prec_categories';
        $brandTable = 'precicon_prec_brand';
        $productFamilyTable = 'precicon_prec_product_family';
        $productModelTable = 'precicon_prec_product_model';
        $productType = "precicon_prec_type";
        //get import file path from session
        $documentFilename = $_SESSION['import_file_name'];
        //check if file exists
        if (file_exists($documentFilename)) {
            //read sheet product family with index 2
            $sheet1 = new ExcelReader($documentFilename, 2);
            //Clean up temporary product family
            Yii::app()->db->createCommand('truncate table ' . $tableName)->query();
            //remove unuse rows
            for ($i = 1; $i < 4; $i++)
                unset($sheet1->data[$i]);

            if (count($sheet1) > 0) {
                //building import query
                $sql = "INSERT INTO " . $tableName . " (`s_n`, `brand`, `category`, `product_name`, `type`, `model`, `description`) VALUES ";
                $columns = array('A', 'B', 'C', 'D', 'E', 'F', 'H');
                foreach ($sheet1->data as $item) {
                    if ((int) $item['A'] > 0 && $item['B'] != '') {
                        $sql .= "(";
                        foreach ($columns as $col)
                            $sql .= "'" . $this->escapeValues($item[$col]) . "',";
                        //remove latest comma
                        $sql = trim($sql, ',');
                        $sql .= "),";
                    }
                }
                //remove latest comma
                $sql = trim($sql, ',');
                //do import 1 time to safe connect to database and improved loading speed
                Yii::app()->db->createCommand($sql)->query();

                $this->updateProductModelReferenceID();

                //insert new type records
                $sql = "Insert Into " . $productType . "(`name`, `slug`, `status`) 
                        SELECT `type`, lower(replace(`type`, ' ', '-')), 1 FROM " . $tableName . " 
                         WHERE type_id = 0 GROUP BY `type`";
                Yii::app()->db->createCommand($sql)->query();
                

                $this->updateProductModelReferenceID();

                $this->importFamilyType();
                
                //insert new product model records
                $sql = "Insert  Into " . $productModelTable . " (`product_family_id`, `category_id`, `brand_id`, `family_type_id`, `name`, `description`, `is_featured`, `status`, `model`)
                        SELECT `product_id`,`category_id`, `brand_id`, `type_id`, `model` as name, `description`, 0, 1, `model`  
                        FROM " . $tableName . " WHERE model_id = 0";

                Yii::app()->db->createCommand($sql)->query();
                
            }
        }
        $this->render('index', array('model' => $model));
    }

    private function updateProductModelReferenceID() {
        $tableName = 'precicon_import_productmodel';
        $categoryTable = 'precicon_prec_categories';
        $brandTable = 'precicon_prec_brand';
        $productFamilyTable = 'precicon_prec_product_family';
        $productModelTable = 'precicon_prec_product_model';
        $typeTable = 'precicon_prec_type';
        //update existing parent category to temp table
        $sql = "Update " . $tableName . " a INNER JOIN " . $categoryTable . " c 
                ON c.name COLLATE utf8_unicode_ci = a.`category` COLLATE utf8_unicode_ci  
                set a.`category_id`  = c.id";
        Yii::app()->db->createCommand($sql)->query();


        $sql = "Update " . $tableName . " a INNER JOIN " . $brandTable . " b 
                ON b.name COLLATE utf8_unicode_ci = a.`brand` COLLATE utf8_unicode_ci  
                set a.`brand_id`  = b.id";
        Yii::app()->db->createCommand($sql)->query();

        $sql = "Update " . $tableName . " f INNER JOIN " . $productFamilyTable . " c 
                ON c.name COLLATE utf8_unicode_ci = f.product_name COLLATE utf8_unicode_ci 
                set f.product_id = c.id";
        Yii::app()->db->createCommand($sql)->query();

        $sql = "Update " . $tableName . " f INNER JOIN " . $typeTable . " c 
                ON c.name COLLATE utf8_unicode_ci = f.type COLLATE utf8_unicode_ci 
                set f.type_id = c.id";
        Yii::app()->db->createCommand($sql)->query();

        $sql = "Update " . $tableName . " f INNER JOIN " . $productModelTable . " c 
                ON c.name COLLATE utf8_unicode_ci = f.model COLLATE utf8_unicode_ci 
                set f.model_id = c.id";
        Yii::app()->db->createCommand($sql)->query();
    }

    

    public function productAttribute() {

        $templateProductFamilyTable = 'precicon_import_productfamily';
        $tableName = 'precicon_import_attributes';
        
        $sql = "SELECT * FROM " . $templateProductFamilyTable . " WHERE category_id > 0 ";
        $productList = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($productList as $product) {
            if ((int) $product['product_id'] > 0) {
                $sql = "SELECT * FROM " . $tableName . " WHERE category_id = " . $product["category_id"];
                $attributeList = Yii::app()->db->createCommand($sql)->queryAll();
                //echo $sql . "<br />";
                foreach ($attributeList as $attr) {
                    $colName = $attr['attr_colname'];
                    if ($colName != "") {
                        if ($product[$colName] != "") {
                            $criteria = new CDbCriteria;
                            $criteria->compare("attribute_id", $attr['attribute_id']);
                            $criteria->compare("category_id", $attr['attribute_id']);
                            $criteria->compare("value", $product[$colName]);
                            $criteria->order = "id asc";
                            $existValue = PrecProductAttributes::model()->find($criteria);
                            if ($existValue) {
                                $existValue->exists_value = 1;
                                $existValue->update();
                            }


                            $model = new PrecProductAttributes();
                            $model->attribute_id = $attr['attribute_id'];
                            $model->product_family_id = $product['product_id'];
                            $model->category_id = $product['category_id'];
                            $model->value = $product[$colName];
                            $model->slug = MyFunctionCustom::slugify($model->value);
                            if ($existValue) {
                                $model->exists_value = 0;
                            }
                            else
                                $model->exists_value = 1;
                            if (!$model->save())
                                var_dump ($model->getErrors());
                            else
                                echo "saved <br />";
                        }
                    }
                }
            }
        }
    }

    public function actionCategoryResize() {
        $root = Yii::getPathOfAlias('webroot') . '/upload/admin/category/';
        $rootOrg = Yii::getPathOfAlias('webroot') . '/upload/orgproduct/';
        $models = PrecCategories::model()->findAll('image <> ""');
        if (count($models) > 0) {
            $count = 0;
            foreach ($models as $item) {
                $dir = $root . $item->id;
                if (!file_exists($dir) and !is_dir($dir)) {
                    mkdir($dir);
                }

                echo $rootOrg . $item->image . "<br />";
                if (file_exists($rootOrg . $item->image)) {
                    copy($rootOrg . $item->image, $dir . '/' . $item->image);
                    if (trim($item->image) != '') {
                        PrecCategories::resizeImage($item);
                        $count++;
                    }
                }
            }
            echo "Resize success: $count image";
        } else {
            echo 'not have image';
        }
        die;
    }

    public function actionProductFamilyResize() {
        $root = Yii::getPathOfAlias('webroot') . '/upload/products/';
        $rootOrg = Yii::getPathOfAlias('webroot') . '/upload/orgproduct/';
        $models = PrecProductFamily::model()->findAll('image <> "" ');
        if (count($models) > 0) {
            $count = 0;
            foreach ($models as $item) {
                $dir = $root . $item->id;
                if (!file_exists($dir) and !is_dir($dir)) {
                    mkdir($dir);
                }
                if (!file_exists($dir . '/brochure/'))
                    mkdir($dir . '/brochure/');
                if (file_exists($rootOrg . $item->image)) {
                    copy($rootOrg . $item->image, $dir . '/' . $item->image);
                    
                    if (file_exists($rootOrg . $item->brochure)) 
                        copy($rootOrg . $item->brochure, $dir . '/brochure/' . $item->brochure);

                    if (trim($item->image) != '') {
                        PrecProductFamily::resizeImage($item);
                        $count++;
                    }
                }
            }
            echo "Resize success: $count image";
        } else {
            echo 'not have image found';
        }
        die;
    }

    private function importFamilyType()
    {
        $tableName = 'precicon_import_productmodel';
        $productFamilyType = 'precicon_prec_family_types';
        
        $sql = "SELECT * FROM " . $tableName . " WHERE product_id > 0 AND type_id > 0 GROUP BY product_id";
        $productList = Yii::app()->db->createCommand($sql)->queryAll();
        if (!empty($productList))
        {
            foreach($productList as $product)
            {
                $sql = "SELECT id FROM " . $productFamilyType . " WHERE product_family_id = " . $product['product_id'] . 
                        " AND  type_id = " . $product['type_id'];
                $existProductType = Yii::app()->db->createCommand($sql)->queryAll();
                if (count($existProductType) == 0)
                {
                    $sql = "INSERT INTO " . $productFamilyType . "(`product_family_id`, `type_id`, `display_order`) 
                            VALUES (" . $product['product_id'] . ", " . $product['type_id'] . "," . $product['s_n'] . ")";
                    Yii::app()->db->createCommand($sql)->query();
                }
            }
                
        }
        
    }
    
    public function actionDoSlugify()
    {
        $this->productAttribute();
        
        $models = PrecProductFamily::model()->findAll();
        foreach ($models as $item)
        {
            $item->slug = MyFunctionCustom::slugify($item->name);
            $item->update();
        }
        
        $models = PrecCategories::model()->findAll();
        foreach ($models as $item)
        {
            $item->slug = MyFunctionCustom::slugify($item->name);
            $item->update();
        }
    }

    private function escapeValues($value) {
        return str_replace("'", "''", $value);
    }

}

?>
