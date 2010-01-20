<?php  require_once ( JELIX_LIB_PATH .'dao/jDaoRecordBase.class.php');
 require_once ( JELIX_LIB_PATH .'dao/jDaoFactoryBase.class.php');

class cDaoRecord_HeleneKling_Jx_pages_Jx_mysql extends jDaoRecordBase {
 public $id;
 public $name;
 public $language;
 public $text;
   public function getProperties() { return cDao_HeleneKling_Jx_pages_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_HeleneKling_Jx_pages_Jx_mysql::$_pkFields; }
}

class cDao_HeleneKling_Jx_pages_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'pages' => 
  array (
    'name' => 'pages',
    'realname' => 'pages',
    'pk' => 
    array (
      0 => 'id',
    ),
    'fields' => 
    array (
      0 => 'id',
      1 => 'name',
      2 => 'language',
      3 => 'text',
    ),
  ),
);
   protected $_primaryTable = 'pages';
   protected $_selectClause='SELECT `pages`.`id`, `pages`.`name`, `pages`.`language`, `pages`.`text`';
   protected $_fromClause;
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_HeleneKling_Jx_pages_Jx_mysql';
   protected $_daoSelector = 'HeleneKling~pages';
   public static $_properties = array (
  'id' => 
  array (
    'name' => 'id',
    'fieldName' => 'id',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'autoincrement',
    'table' => 'pages',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'defaultValue' => NULL,
    'needsQuotes' => false,
  ),
  'name' => 
  array (
    'name' => 'name',
    'fieldName' => 'name',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'pages',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => 255,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'defaultValue' => NULL,
    'needsQuotes' => true,
  ),
  'language' => 
  array (
    'name' => 'language',
    'fieldName' => 'language',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'pages',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => 255,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'defaultValue' => NULL,
    'needsQuotes' => true,
  ),
  'text' => 
  array (
    'name' => 'text',
    'fieldName' => 'text',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'text',
    'table' => 'pages',
    'updatePattern' => '%s',
    'insertPattern' => '%s',
    'selectPattern' => '%s',
    'sequenceName' => '',
    'maxlength' => NULL,
    'minlength' => NULL,
    'ofPrimaryTable' => true,
    'defaultValue' => NULL,
    'needsQuotes' => true,
  ),
);
   public static $_pkFields = array('id');
 
public function __construct($conn){
   parent::__construct($conn);
   $this->_fromClause = ' FROM `'.$this->_conn->prefixTable('pages').'` AS `pages`';
}
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `pages`.`id`'.'='.intval($id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `id`'.'='.intval($id).'';
}
public function insert ($record){
 if($record->id > 0 ){
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('pages').'` (
`id`,`name`,`language`,`text`
) VALUES (
'.intval($record->id).', '.($record->name === null ? 'NULL' : $this->_conn->quote($record->name,false)).', '.($record->language === null ? 'NULL' : $this->_conn->quote($record->language,false)).', '.($record->text === null ? 'NULL' : $this->_conn->quote($record->text,false)).'
)';
}else{
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('pages').'` (
`name`,`language`,`text`
) VALUES (
'.($record->name === null ? 'NULL' : $this->_conn->quote($record->name,false)).', '.($record->language === null ? 'NULL' : $this->_conn->quote($record->language,false)).', '.($record->text === null ? 'NULL' : $this->_conn->quote($record->text,false)).'
)';
}
   $result = $this->_conn->exec ($query);
   if(!$result)
       return false;
   if($record->id < 1 ) 
       $record->id= $this->_conn->lastInsertId();
    return $result;
}
public function update ($record){
   $query = 'UPDATE `'.$this->_conn->prefixTable('pages').'` SET 
 `name`= '.($record->name === null ? 'NULL' : $this->_conn->quote($record->name,false)).', `language`= '.($record->language === null ? 'NULL' : $this->_conn->quote($record->language,false)).', `text`= '.($record->text === null ? 'NULL' : $this->_conn->quote($record->text,false)).'
 where  `id`'.'='.intval($record->id).'
';
   $result = $this->_conn->exec ($query);
   return $result;
 }
}
?>