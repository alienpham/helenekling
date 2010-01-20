<?php 
function template_meta_b17239602e442ebfe89adc03b3c6b444($t){
if(isset($t->_vars['form'])) { $t->_vars['form']->getBuilder('html')->outputMetaContent($t);}

}
function template_b17239602e442ebfe89adc03b3c6b444($t){
?> <?php  $formfull = $t->_vars['form'];
    $formfullBuilder = $formfull->getBuilder('html');
    $formfullBuilder->setAction( 'default:savePage',array());
    $formfullBuilder->outputHeader(array());
    $formfullBuilder->outputAllControls();
    $formfullBuilder->outputFooter();?><?php 
}
?>