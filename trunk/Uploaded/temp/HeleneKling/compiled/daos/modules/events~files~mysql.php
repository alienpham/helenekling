<?php  require_once ( JELIX_LIB_PATH .'dao/jDaoRecordBase.class.php');
 require_once ( JELIX_LIB_PATH .'dao/jDaoFactoryBase.class.php');

class cDaoRecord_events_Jx_files_Jx_mysql extends jDaoRecordBase {
 public $id;
 public $name;
 public $url;
   public function getProperties() { return cDao_events_Jx_files_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_events_Jx_files_Jx_mysql::$_pkFields; }
}

class cDao_events_Jx_files_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'files' => 
  array (
    'name' => 'files',
    'realname' => 'files',
    'pk' => 
    array (
      0 => 'id',
    ),
    'fields' => 
    array (
      0 => 'id',
      1 => 'name',
      2 => 'url',
    ),
  ),
);
   protected $_primaryTable = 'files';
   protected $_selectClause='SELECT `files`.`id`, `files`.`name`, `files`.`url`';
   protected $_fromClause;
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_events_Jx_files_Jx_mysql';
   protected $_daoSelector = 'events~files';
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
    'table' => 'files',
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
    'table' => 'files',
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
  'url' => 
  array (
    'name' => 'url',
    'fieldName' => 'url',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'files',
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
);
   public static $_pkFields = array('id');
 
public function __construct($conn){
   parent::__construct($conn);
   $this->_fromClause = ' FROM `'.$this->_conn->prefixTable('files').'` AS `files`';
}
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `files`.`id`'.'='.intval($id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `id`'.'='.intval($id).'';
}
public function insert ($record){
 if($record->id > 0 ){
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('files').'` (
`id`,`name`,`url`
) VALUES (
'.intval($record->id).', '.($record->name === null ? 'NULL' : $this->_conn->quote($record->name,false)).', '.($record->url === null ? 'NULL' : $this->_conn->quote($record->url,false)).'
)';
}else{
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('files').'` (
`name`,`url`
) VALUES (
'.($record->name === null ? 'NULL' : $this->_conn->quote($record->name,false)).', '.($record->url === null ? 'NULL' : $this->_conn->quote($record->url,false)).'
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
   $query = 'UPDATE `'.$this->_conn->prefixTable('files').'` SET 
 `name`= '.($record->name === null ? 'NULL' : $this->_conn->quote($record->name,false)).', `url`= '.($record->url === null ? 'NULL' : $this->_conn->quote($record->url,false)).'
 where  `id`'.'='.intval($record->id).'
';
   $result = $this->_conn->exec ($query);
   return $result;
 }
}
?>