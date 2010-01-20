<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_a287ae4e452c41aa54f656e879fe5c58($t){
if(isset($t->_vars['form'])) { $t->_vars['form']->getBuilder('html')->outputMetaContent($t);}
if(isset($t->_vars['form'])) { $t->_vars['form']->getBuilder('html')->outputMetaContent($t);}

}
function template_a287ae4e452c41aa54f656e879fe5c58($t){
?><?php if($t->_vars['id'] === null):?>

<h1><?php echo jLocale::get('jelix~crud.title.create'); ?></h1>
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



<p><a href="<?php jtpl_function_html_jurl( $t,$t->_vars['listAction']);?>" class="crud-link"><?php echo jLocale::get('jelix~crud.link.return.to.list'); ?></a>.</p><?php 
}
?>