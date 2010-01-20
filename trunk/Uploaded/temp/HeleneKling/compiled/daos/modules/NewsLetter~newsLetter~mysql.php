<?php  require_once ( JELIX_LIB_PATH .'dao/jDaoRecordBase.class.php');
 require_once ( JELIX_LIB_PATH .'dao/jDaoFactoryBase.class.php');

class cDaoRecord_NewsLetter_Jx_newsLetter_Jx_mysql extends jDaoRecordBase {
 public $id;
 public $date_create;
 public $text;
   public function getProperties() { return cDao_NewsLetter_Jx_newsLetter_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_NewsLetter_Jx_newsLetter_Jx_mysql::$_pkFields; }
}

class cDao_NewsLetter_Jx_newsLetter_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'newsletters' => 
  array (
    'name' => 'newsletters',
    'realname' => 'newsletters',
    'pk' => 
    array (
      0 => 'id',
    ),
    'fields' => 
    array (
      0 => 'id',
      1 => 'date_create',
      2 => 'text',
    ),
  ),
);
   protected $_primaryTable = 'newsletters';
   protected $_selectClause='SELECT `newsletters`.`id`, `newsletters`.`date_create`, `newsletters`.`text`';
   protected $_fromClause;
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_NewsLetter_Jx_newsLetter_Jx_mysql';
   protected $_daoSelector = 'NewsLetter~newsLetter';
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
    'table' => 'newsletters',
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
  'date_create' => 
  array (
    'name' => 'date_create',
    'fieldName' => 'date_create',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'newsletters',
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
    'required' => false,
    'requiredInConditions' => false,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'text',
    'table' => 'newsletters',
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
   $this->_fromClause = ' FROM `'.$this->_conn->prefixTable('newsletters').'` AS `newsletters`';
}
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `newsletters`.`id`'.'='.intval($id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `id`'.'='.intval($id).'';
}
public function insert ($record){
 if($record->id > 0 ){
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('newsletters').'` (
`id`,`date_create`,`text`
) VALUES (
'.intval($record->id).', '.($record->date_create === null ? 'NULL' : $this->_conn->quote($record->date_create,false)).', '.($record->text === null ? 'NULL' : $this->_conn->quote($record->text,false)).'
)';
}else{
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('newsletters').'` (
`date_create`,`text`
) VALUES (
'.($record->date_create === null ? 'NULL' : $this->_conn->quote($record->date_create,false)).', '.($record->text === null ? 'NULL' : $this->_conn->quote($record->text,false)).'
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
   $query = 'UPDATE `'.$this->_conn->prefixTable('newsletters').'` SET 
 `date_create`= '.($record->date_create === null ? 'NULL' : $this->_conn->quote($record->date_create,false)).', `text`= '.($record->text === null ? 'NULL' : $this->_conn->quote($record->text,false)).'
 where  `id`'.'='.intval($record->id).'
';
   $result = $this->_conn->exec ($query);
   return $result;
 }
}
?>