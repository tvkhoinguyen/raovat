/**
 * MyConfig
 * 
 * @package Yii Extensions
 * @author Twisted1919
 * @copyright 2011
 * @version 1.0
 * @access public
 */
 
 This component allows you to manage your website various config items via database or files.
 In my case, i created this component because my projects require an area in the admin panel where the clients can set various 
 config items for the website(Website keywords/description | admin theme | website theme | maintenance theme | contact emails | etc)
 and i also have some classes that needs to have their params set dynamically from the admin panel.
 
 Basically, you can save your custom config to database, you can load custom config items from files|database and you can cache them if you like.
 
 The component accepts following params:
 1) 'cacheId'=> (string) If you decide to cache your items, you need to provide a cache key here(else it will use the default one)
 
 2) 'useCache'=> (bool) If set to true, it will cache the items using the above cacheId. 
 Note that you need to have a cache component provided by Yii active

 3) 'cacheTime'=>(int) If you use the cache, set here the number of seconds to keep the cache.
 Note that the cache is flushed automatically when you add/remove items from database.
 
 4) 'tableName'=>(string) If you decide to use use the database to store the items, provide the table name here.
 
 5) 'createTable'=> (bool) Whether the component should create the table if it doesn't exists.
 Note, set this to false after your table has been created.
 
 6) 'loadDbItems'=> (bool) If you set this to true, at init the items from database are loaded.
 
 7) 'serializeValues'=>(bool) Storing items in database usually means that you use their type (i.e: true becomes 1).
	Setting this to true, will serialize the values before saving them (and unserialize when loading them) so you can keep their type.
 
 8) 'configFile'=>(mixed) At runtime, you can load items from files located under /protected/config folder.
	You can pass something like:
	A) 'configFile'=>array('countries', 'cities'), //will load countries.php and cities.php files
	B) 'configFile'=>'countries,cities', // the same
	C) 'configFile'=>'countries', // load only countries.php
	Note that you don't need to append .php extension 
	
In it's most simple configuration, the component can be set like:
'components'=>array(
		[...]
        'cfg'=>array(
            'class' =>  'application.components.MyConfig',
            'cacheId'=>null,
            'useCache'=>false,
            'cacheTime'=>0,
            'tableName'=>'',
            'createTable'=>false,
            'loadDbItems'=>false,
            'serializeValues'=>true,
            'configFile'=>'',
        ),
		[...]

//Store config items in memory and retrive them

The above configuration won't do many things, will only allow you to store and retrive items during runtime, like:
Yii::app()->cfg->setItem('key','value');
echo Yii::app()->cfg->getItem('key'); // prints 'value';

//Loading config files at init
However, if for example you have a file named example.php in your /protected/config folder and it contains something like:
[...]
return array(
	'key1'	=>	'value1',
	'key2'	=>	'value2'
);
[...]
You can load it at runtime, by passing it to 'configFile' property.
'components'=>array(
		[...]
        'cfg'=>array(
			[...]
            'configFile'=>'example',
        ),
		[...]
Now, accessing Yii::app()->cfg->getItem('key1') will return 'value1' from the config file, and accessing Yii::app()->cfg->getItem('key2') will
return 'value2'.

//Loading config files during runtime.
There are many cases, where you need some config file(s) loaded just in certain parts of the website.
In this case it wouldn't be wise to load the files at init so we can do it during runtime in the areas we need them:
We can do this as follows:
1) Yii::app()->cfg->loadConfigFile('example');
echo Yii::app()->cfg->getItem('key1');// returns 'value1'
2) Yii::app()->cfg->loadConfigFile(array('KEY'=>'example'));// OR loadConfigFile('example','KEY');
$fileArray=Yii::app()->cfg->getItem('KEY');
echo $fileArray['KEY']['key1'];//returns 'value1';
3) $fileArray=Yii::app()->cfg->loadConfigFile(array('KEY'=>'example'))->getArray();//OR loadConfigFile('example','KEY')->getArray();
echo $fileArray['KEY']['key1'];//returns 'value1';

// Storing and retriving items in/from database
Well, this is simple :
'components'=>array(
		[...]
        'cfg'=>array(
            'class' =>  'application.components.MyConfig',
            'cacheId'=>null,
            'useCache'=>false,
            'cacheTime'=>0,
            'tableName'=>'MY_TABLE_NAME',
            'createTable'=>true,
            'loadDbItems'=>true,
            'serializeValues'=>true,
            'configFile'=>'',
        ),
		[...]
- Saving items to database is simple as writing:
Yii::app()->cfg->setDbItem('itemName','itemValue');
- Accessing database items is also simple:
echo Yii::app()->getItem('itemName');
NOTE: The item is available to be accessed right after you saved it, so there is no need to reload the items to retrieve it.


//From config file(s) to database.
Well, i am a lazy person, and i faced the situation where i had a large config file and i needed it saved to database, so i needed a method to do that for me:
You can do it using the method called fromConfigToDb() which relies on loadConfigFile() method;
So you can do: 
1) Yii::app()->cfg->fromConfigToDb('example');
 It will save the contents of the example.php file into database and you can access them like:
 echo Yii::app()->cfg->getItem('key1'); // prints 'value1'
2) Yii::app()->cfg->fromConfigToDb(array('KEY'=>'example')); //OR fromConfigToDb('example','KEY');
$array=Yii::app()->cfg->getItem('KEY');
echo $array['key1']; // prints 'value1'

For better userstanding, try something like:
1)Yii::app()->cfg->fromConfigToDb('main','main-config');
2)Yii::app()->cfg->fromConfigToDb('main');
Then take a look into your database.

AVAILABLE METHODS:
1) public function setItem($key, $value='')
$key can be a string or an associative array ('key'=>'value');
Saves an item in memory during runtime.

2) public function setDbItem($key, $value='')
It saves the item in database, then calls setItem() to make the item available

3) public function getItem($key)
Retrieves an item. Note that the retrieved item can be a string or array or even object so you need to do additional checks yourself.

4) public function deleteItem($key)
$key can be a string or an array of keys to be removed
Remove item

5) public function deleteDbItem($key)
$key can be a string or an array of keys to be removed
Removes items from database, then calls deleteItem()

6) public function deleteItems()
Removes all items

7) public function deleteDbItems()
Removes all the items from database, then calls deleteItems();

8) public function loadDbItems()
Loads the items from database during runtime, and it saves them to cache it it's the case.
Note, that if the 'loadDbItems' property is set to true, the items are loaded at init, so you don't have to do it manually.

9)public function loadConfigFile($fileArray,$keyName=null)
$fileArray can be a string or an associative array('keyName'=>'fileName');
It will load a config file and make it's contents available via getItem('keyName');
The file needs to return an associative array.

10)public function toArray()
Returns all the stored items

11)public function fromConfigToDb($fileName, $fileKey='')
Almost the same behaviour as loadConfigFile() only it saves the items to database and then calls setDbItem();
