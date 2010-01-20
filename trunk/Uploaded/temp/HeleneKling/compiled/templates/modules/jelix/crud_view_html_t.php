<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.formdatafull.php');
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_d0875a3f1ed36a19a196c25b7063be8a($t){

}
function template_d0875a3f1ed36a19a196c25b7063be8a($t){
?><h1><?php echo jLocale::get('jelix~crud.title.view'); ?></h1>
<?php jtpl_function_html_formdatafull( $t,$t->_vars['form']);?>


<ul class="crud-links-list">
    <li><a href="<?php jtpl_function_html_jurl( $t,$t->_vars['editAction'], array('id'=>$t->_vars['id']));?>" class="crud-link"><?php echo jLocale::get('jelix~crud.link.edit.record'); ?></a></li>
    <li><a href="<?php jtpl_function_html_jurl( $t,$t->_vars['deleteAction'], array('id'=>$t->_vars['id']));?>" class="crud-link" onclick="return confirm('<?php echo jLocale::get('jelix~crud.confirm.deletion'); ?>')"><?php echo jLocale::get('jelix~crud.link.delete.record'); ?></a></li>
    <li><a href="<?php jtpl_function_html_jurl( $t,$t->_vars['listAction']);?>" class="crud-link"><?php echo jLocale::get('jelix~crud.link.return.to.list'); ?></a></li>
</ul>

<?php 
}
?>