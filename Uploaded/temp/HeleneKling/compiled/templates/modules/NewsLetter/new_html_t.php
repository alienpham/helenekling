<?php 
function template_meta_96fdf2b69097b8496f7430698a139f6c($t){
if(isset($t->_vars['form'])) { $t->_vars['form']->getBuilder('html')->outputMetaContent($t);}

}
function template_96fdf2b69097b8496f7430698a139f6c($t){
?><h1>New NewsLetter</h1>
 
   <?php  $formfull = $t->_vars['form'];
    $formfullBuilder = $formfull->getBuilder('html');
    $formfullBuilder->setAction( 'default:prepareToSave',array());
    $formfullBuilder->outputHeader(array());
    $formfullBuilder->outputAllControls();
    $formfullBuilder->outputFooter();?><?php 
}
?>