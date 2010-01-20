<?php  require_once ( JELIX_LIB_PATH .'dao/jDaoRecordBase.class.php');
 require_once ( JELIX_LIB_PATH .'dao/jDaoFactoryBase.class.php');

class cDaoRecord_events_Jx_events_Jx_mysql extends jDaoRecordBase {
 public $id;
 public $name;
 public $date_debut;
 public $date_fin;
 public $horaires;
 public $adresse;
 public $description;
 public $flyer;
 public $language;
   public function getProperties() { return cDao_events_Jx_events_Jx_mysql::$_properties; }
   public function getPrimaryKeyNames() { return cDao_events_Jx_events_Jx_mysql::$_pkFields; }
}

class cDao_events_Jx_events_Jx_mysql extends jDaoFactoryBase {
   protected $_tables = array (
  'events' => 
  array (
    'name' => 'events',
    'realname' => 'events',
    'pk' => 
    array (
      0 => 'id',
    ),
    'fields' => 
    array (
      0 => 'id',
      1 => 'name',
      2 => 'date_debut',
      3 => 'date_fin',
      4 => 'horaires',
      5 => 'adresse',
      6 => 'description',
      7 => 'flyer',
      8 => 'language',
    ),
  ),
);
   protected $_primaryTable = 'events';
   protected $_selectClause='SELECT `events`.`id`, `events`.`name`, `events`.`date_debut`, `events`.`date_fin`, `events`.`horaires`, `events`.`adresse`, `events`.`description`, `events`.`flyer`, `events`.`language`';
   protected $_fromClause;
   protected $_whereClause='';
   protected $_DaoRecordClassName='cDaoRecord_events_Jx_events_Jx_mysql';
   protected $_daoSelector = 'events~events';
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
    'table' => 'events',
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
    'table' => 'events',
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
  'date_debut' => 
  array (
    'name' => 'date_debut',
    'fieldName' => 'date_debut',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'events',
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
  'date_fin' => 
  array (
    'name' => 'date_fin',
    'fieldName' => 'date_fin',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'date',
    'table' => 'events',
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
  'horaires' => 
  array (
    'name' => 'horaires',
    'fieldName' => 'horaires',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'events',
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
  'adresse' => 
  array (
    'name' => 'adresse',
    'fieldName' => 'adresse',
    'regExp' => NULL,
    'required' => true,
    'requiredInConditions' => true,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'events',
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
  'description' => 
  array (
    'name' => 'description',
    'fieldName' => 'description',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => false,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'text',
    'table' => 'events',
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
  'flyer' => 
  array (
    'name' => 'flyer',
    'fieldName' => 'flyer',
    'regExp' => NULL,
    'required' => false,
    'requiredInConditions' => false,
    'isPK' => false,
    'isFK' => false,
    'datatype' => 'string',
    'table' => 'events',
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
    'table' => 'events',
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
   $this->_fromClause = ' FROM `'.$this->_conn->prefixTable('events').'` AS `events`';
}
   public function getProperties() { return self::$_properties; }
   public function getPrimaryKeyNames() { return self::$_pkFields;}
 
 protected function _getPkWhereClauseForSelect($pk){
   extract($pk);
 return ' WHERE  `events`.`id`'.'='.intval($id).'';
}
 
protected function _getPkWhereClauseForNonSelect($pk){
   extract($pk);
   return ' where  `id`'.'='.intval($id).'';
}
public function insert ($record){
 if($record->id > 0 ){
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('events').'` (
`id`,`name`,`date_debut`,`date_fin`,`horaires`,`adresse`,`description`,`flyer`,`language`
) VALUES (
'.intval($record->id).', '.($record->name === null ? 'NULL' : $this->_conn->quote($record->name,false)).', '.($record->date_debut === null ? 'NULL' : $this->_conn->quote($record->date_debut,false)).', '.($record->date_fin === null ? 'NULL' : $this->_conn->quote($record->date_fin,false)).', '.($record->horaires === null ? 'NULL' : $this->_conn->quote($record->horaires,false)).', '.($record->adresse === null ? 'NULL' : $this->_conn->quote($record->adresse,false)).', '.($record->description === null ? 'NULL' : $this->_conn->quote($record->description,false)).', '.($record->flyer === null ? 'NULL' : $this->_conn->quote($record->flyer,false)).', '.($record->language === null ? 'NULL' : $this->_conn->quote($record->language,false)).'
)';
}else{
    $query = 'INSERT INTO `'.$this->_conn->prefixTable('events').'` (
`name`,`date_debut`,`date_fin`,`horaires`,`adresse`,`description`,`flyer`,`language`
) VALUES (
'.($record->name === null ? 'NULL' : $this->_conn->quote($record->name,false)).', '.($record->date_debut === null ? 'NULL' : $this->_conn->quote($record->date_debut,false)).', '.($record->date_fin === null ? 'NULL' : $this->_conn->quote($record->date_fin,false)).', '.($record->horaires === null ? 'NULL' : $this->_conn->quote($record->horaires,false)).', '.($record->adresse === null ? 'NULL' : $this->_conn->quote($record->adresse,false)).', '.($record->description === null ? 'NULL' : $this->_conn->quote($record->description,false)).', '.($record->flyer === null ? 'NULL' : $this->_conn->quote($record->flyer,false)).', '.($record->language === null ? 'NULL' : $this->_conn->quote($record->language,false)).'
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
   $query = 'UPDATE `'.$this->_conn->prefixTable('events').'` SET 
 `name`= '.($record->name === null ? 'NULL' : $this->_conn->quote($record->name,false)).', `date_debut`= '.($record->date_debut === null ? 'NULL' : $this->_conn->quote($record->date_debut,false)).', `date_fin`= '.($record->date_fin === null ? 'NULL' : $this->_conn->quote($record->date_fin,false)).', `horaires`= '.($record->horaires === null ? 'NULL' : $this->_conn->quote($record->horaires,false)).', `adresse`= '.($record->adresse === null ? 'NULL' : $this->_conn->quote($record->adresse,false)).', `description`= '.($record->description === null ? 'NULL' : $this->_conn->quote($record->description,false)).', `flyer`= '.($record->flyer === null ? 'NULL' : $this->_conn->quote($record->flyer,false)).', `language`= '.($record->language === null ? 'NULL' : $this->_conn->quote($record->language,false)).'
 where  `id`'.'='.intval($record->id).'
';
   $result = $this->_conn->exec ($query);
   return $result;
 }
}
?>