<?php 
function template_meta_4fe7fcaf0ba816c4dbab8a88fc29ef52($t){
if(isset($t->_vars['form'])) { $t->_vars['form']->getBuilder('html')->outputMetaContent($t);}
if(isset($t->_vars['form'])) { $t->_vars['form']->getBuilder('html')->outputMetaContent($t);}

}
function template_4fe7fcaf0ba816c4dbab8a88fc29ef52($t){
?><?php if($t->_vars['id'] === null):?>

<h1><?php echo jLocale::get('NewsLetter~news.signup'); ?></h1>
<?php  $formfull = $t->_vars['form'];
    $formfullBuilder = $formfull->getBuilder('html');
    $formfullBuilder->setAction( $t->_vars['submitAction'],array());
    $formfullBuilder->outputHeader(array());
    $formfullBuilder->outputAllControls();
    $formfullBuilder->outputFooter();?>

<?php else:?>

<h1><?php echo jLocale::get('jelix~crud.title.update'); ?></h1>
<?php  $formfull = $t->_vars['form'];
    $formfullBuilder = $formfull->getBuilder('html');
    $formfullBuilder->setAction( $t->_vars['submitAction'], array('id'=>$t->_vars['id']));
    $formfullBuilder->outputHeader(array());
    $formfullBuilder->outputAllControls();
    $formfullBuilder->outputFooter();?>

<?php endif;?>
<?php 
}
?>