<?php 
class cForm_jPicasa_Jx_coment extends jFormsBase {
 public function __construct($sel, &$container, $reset = false){
          parent::__construct($sel, $container, $reset);
$ctrl= new jFormsControlhidden('albumId');
$this->addControl($ctrl);
$ctrl= new jFormsControlinput('name');
$ctrl->label='Your name';
$this->addControl($ctrl);
$ctrl= new jFormsControltextarea('comment');
$ctrl->label='';
$ctrl->cols=30;
$this->addControl($ctrl);
$ctrl= new jFormsControlsubmit('_submit');
$ctrl->label='Ok';
$ctrl->datasource= new jFormsStaticDatasource();
$this->addControl($ctrl);
  }
} ?>