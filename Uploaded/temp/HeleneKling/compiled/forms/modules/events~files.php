<?php 
class cForm_events_Jx_files extends jFormsBase {
 public function __construct($sel, &$container, $reset = false){
          parent::__construct($sel, $container, $reset);
$ctrl= new jFormsControlinput('name');
$ctrl->label='Name : ';
$this->addControl($ctrl);
$ctrl= new jFormsControlupload('file');
$ctrl->label='Fichier';
$ctrl->maxsize=20000000;
$this->addControl($ctrl);
$ctrl= new jFormsControlsubmit('_submit');
$ctrl->label='ok';
$ctrl->datasource= new jFormsStaticDatasource();
$this->addControl($ctrl);
  }
} ?>