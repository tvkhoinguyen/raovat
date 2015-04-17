<?php

/**
 * @property user_id
 * @property readonly
 * @property prefix
 */
Yii::import('zii.widgets.grid.CGridView');
class CheckboxTableWidget extends CGridView
{
    public $user_id = 0;
    public $readonly = true;
    public $prefix = 'table';

    public function init()
    {
        $m = new Admin();
        $this->dataProvider = $m->search();
        parent::init();
    }

    public function run()
    {
        $output = '<div class="grid-view">
            <table class="items">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>View</th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>';
        $roles = Yii::app()->authManager->getRoles($this->user_id);
        $table = AdminAcl::getAllAclName();
        $count = 0;
        foreach($table as $key=>$types)
        {
            $count++;
            if($count % 2 == 1)
                $output .= '<tr class="odd">';
            else
                $output .= '<tr class="even">';

            $output .= '<td style="text-align:left;">' . $key . '</td>';

            $output .= $this->appendRow(
                array_search('view', $types) !== false ?
                CHtml::checkBox(
                    $this->prefix.'[view_'.$key.']',
                    isset($roles['view_'.$key]),
                    array('disabled'=>$this->readonly)
                ) : ''
            );
            $output .= $this->appendRow(
                array_search('create', $types) !== false ?
                    CHtml::checkBox(
                        $this->prefix.'[create_'.$key.']',
                        isset($roles['create_'.$key]),
                        array('disabled'=>$this->readonly)
                    ) : ''
            );
            $output .= $this->appendRow(
                array_search('update', $types) !== false ?
                    CHtml::checkBox(
                        $this->prefix.'[update_'.$key.']',
                        isset($roles['update_'.$key]),
                        array('disabled'=>$this->readonly)
                    ) : ''
            );
            $output .= $this->appendRow(
                array_search('delete', $types) !== false ?
                    CHtml::checkBox(
                        $this->prefix.'[delete_'.$key.']',
                        isset($roles['delete_'.$key]),
                        array('disabled'=>$this->readonly)
                    ) : ''
            );

            $output .= '</tr>';
        }
        $output .= '</tbody></table></div>';
        echo $output;
    }

    protected function appendRow($data)
    {
        return "<td>$data</td>";
    }
}