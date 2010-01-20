<?php  require_once ( JELIX_LIB_PATH .'dao/jDaoRecordBase.class.php');
 require_once ( JELIX_LIB_PATH .'dao/jDaoFactoryBase.class.php');

class cDaoRecord_NewsLetter_Jx_emails_logs_Jx_mysql extends jDaoRecordBase {
 public $id;
 public $id_newsLetter;
 public $email;
 public $time;
 public $sent;
 public $server;
   public function getProperties() { return cDao_NewsLetter_Jx_emails_logs_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_NewsLetter_Jx_emails_logs_Jx_mysql::$_pkFields; }
}

class cDao_NewsLetter_Jx_emails_logs_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'emails_logs' => 
  array (
    'name' => 'emails_logs',
    'realname' => 'emails_logs',
    'pk' => 
    array (
      0 => 'id',
    ),
    'fields' => 
    array (
      0 => 'id',
      1 => 'id_newsLetter',
      2 => 'email',
      3 => 'time',
      4 => 'sent',
      5 => 'server',
    ),
  ),
);
   protected $_primaryTable = 'emails_logs';
   protected $_selectClause='SELECT `emails_logs`.`id`, `emails_logs`.`id_newsLetter`, `emails_logs`.`email`, `emails_logs`.`time`, `emails_logs`.`sent`, `emails_logs`.`server`';
   protected $_fromClause;
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_NewsLetter_Jx_emails_logs_Jx_mysql';
   protected $_daoSelector = 'NewsLetter~emails_logs';
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
    'table' => 'emails_logs',
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
  'id_newsLetter' => 
  array (
    'name' => 'id_newsLetter',
    'fieldName' => 'id_newsLetter',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'integer',
    'table' => 'emails_logs',
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
  'email' => 
  array (
    'name' => 'email',
    'fieldName' => 'email',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'emails_logs',
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
  'time' => 
  array (
    'name' => 'time',
    'fieldName' => 'time',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'emails_logs',
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
  'sent' => 
  array (
    'name' => 'sent',
    'fieldName' => 'sent',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'emails_logs',
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
  'server' => 
  array (
    'name' => 'server',
    'fieldName' => 'server',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'emails_logs',
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
   $this->_fromClause = ' FROM `'.$this->_conn->prefixTable('emails_logs').'` AS `emails_logs`';
}
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `emails_logs`.`id`'.'='.intval($id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `id`'.'='.intval($id).'';
}
public function insert ($record){
 if($record->id > 0 ){
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('emails_logs').'` (
`id`,`id_newsLetter`,`email`,`time`,`sent`,`server`
) VALUES (
'.intval($record->id).', '.($record->id_newsLetter === null ? 'NULL' : intval($record->id_newsLetter)).', '.($record->email === null ? 'NULL' : $this->_conn->quote($record->email,false)).', '.($record->time === null ? 'NULL' : $this->_conn->quote($record->time,false)).', '.($record->sent === null ? 'NULL' : $this->_conn->quote($record->sent,false)).', '.($record->server === null ? 'NULL' : $this->_conn->quote($record->server,false)).'
)';
}else{
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('emails_logs').'` (
`id_newsLetter`,`email`,`time`,`sent`,`server`
) VALUES (
'.($record->id_newsLetter === null ? 'NULL' : intval($record->id_newsLetter)).', '.($record->email === null ? 'NULL' : $this->_conn->quote($record->email,false)).', '.($record->time === null ? 'NULL' : $this->_conn->quote($record->time,false)).', '.($record->sent === null ? 'NULL' : $this->_conn->quote($record->sent,false)).', '.($record->server === null ? 'NULL' : $this->_conn->quote($record->server,false)).'
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
   $query = 'UPDATE `'.$this->_conn->prefixTable('emails_logs').'` SET 
 `id_newsLetter`= '.($record->id_newsLetter === null ? 'NULL' : intval($record->id_newsLetter)).', `email`= '.($record->email === null ? 'NULL' : $this->_conn->quote($record->email,false)).', `time`= '.($record->time === null ? 'NULL' : $this->_conn->quote($record->time,false)).', `sent`= '.($record->sent === null ? 'NULL' : $this->_conn->quote($record->sent,false)).', `server`= '.($record->server === null ? 'NULL' : $this->_conn->quote($record->server,false)).'
 where  `id`'.'='.intval($record->id).'
';
   $result = $this->_conn->exec ($query);
   return $result;
 }
}
?>