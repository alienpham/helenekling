<?php  require_once ( JELIX_LIB_PATH .'dao/jDaoRecordBase.class.php');
 require_once ( JELIX_LIB_PATH .'dao/jDaoFactoryBase.class.php');

class cDaoRecord_NewsLetter_Jx_emails_Jx_mysql extends jDaoRecordBase {
 public $email;
   public function getProperties() { return cDao_NewsLetter_Jx_emails_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_NewsLetter_Jx_emails_Jx_mysql::$_pkFields; }
}

class cDao_NewsLetter_Jx_emails_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'emails' => 
  array (
    'name' => 'emails',
    'realname' => 'emails',
    'pk' => 
    array (
      0 => 'email',
    ),
    'fields' => 
    array (
      0 => 'email',
    ),
  ),
);
   protected $_primaryTable = 'emails';
   protected $_selectClause='SELECT `emails`.`email`';
   protected $_fromClause;
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_NewsLetter_Jx_emails_Jx_mysql';
   protected $_daoSelector = 'NewsLetter~emails';
   public static $_properties = array (
  'email' => 
  array (
    'name' => 'email',
    'fieldName' => 'email',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => true,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'emails',
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
   public static $_pkFields = array('email');
 
public function __construct($conn){
   parent::__construct($conn);
   $this->_fromClause = ' FROM `'.$this->_conn->prefixTable('emails').'` AS `emails`';
}
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `emails`.`email`'.'='.$this->_conn->quote($email).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `email`'.'='.$this->_conn->quote($email).'';
}
public function insert ($record){
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('emails').'` (
`email`
) VALUES (
'.($record->email === null ? 'NULL' : $this->_conn->quote($record->email,false)).'
)';
   $result = $this->_conn->exec ($query);
    return $result;
}
public function update ($record){
     throw new jException('jelix~dao.error.update.impossible',array('NewsLetter~emails','/homepages/5/d177360615/htdocs/HeleneKling/modules/NewsLetter/daos/emails.dao.xml'));
 }
}
?>