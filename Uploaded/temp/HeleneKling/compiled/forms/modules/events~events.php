<?php 
class cForm_events_Jx_events extends jFormsBase {
 public function __construct($sel, &$container, $reset = false){
          parent::__construct($sel, $container, $reset);
$ctrl= new jFormsControlinput('name');
$ctrl->label='Name : ';
$this->addControl($ctrl);
$ctrl= new jFormsControldate('date_debut');
$ctrl->label='Date de Debut';
$this->addControl($ctrl);
$ctrl= new jFormsControldate('date_fin');
$ctrl->label='Date de fin';
$this->addControl($ctrl);
$ctrl= new jFormsControlinput('horaires');
$ctrl->label='Horaires';
$this->addControl($ctrl);
$ctrl= new jFormsControlinput('adresse');
$ctrl->label='Adresse : ';
$this->addControl($ctrl);
$ctrl= new jFormsControlupload('flyer');
$ctrl->label='Flyer';
$ctrl->maxsize=20000000;
$this->addControl($ctrl);
$ctrl= new jFormsControlhtmleditor('description');
$ctrl->label='';
$ctrl->config='full';
$this->addControl($ctrl);
$ctrl= new jFormsControlsubmit('_submit');
$ctrl->label='ok';
$ctrl->datasource= new jFormsStaticDatasource();
$this->addControl($ctrl);
  }
} ?>