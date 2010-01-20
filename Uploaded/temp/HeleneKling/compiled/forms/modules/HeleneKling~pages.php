<?php 
class cForm_HeleneKling_Jx_pages extends jFormsBase {
 public function __construct($sel, &$container, $reset = false){
          parent::__construct($sel, $container, $reset);
$ctrl= new jFormsControlhtmleditor('text');
$ctrl->label='';
$ctrl->config='full';
$this->addControl($ctrl);
$ctrl= new jFormsControlhidden('name');
$this->addControl($ctrl);
$ctrl= new jFormsControlsubmit('_submit');
$ctrl->label='ok';
$ctrl->datasource= new jFormsStaticDatasource();
$this->addControl($ctrl);
  }
} ?>