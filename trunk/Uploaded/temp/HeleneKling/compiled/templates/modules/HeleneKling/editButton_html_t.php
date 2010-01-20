<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_4870c643ce0f402d15b20aff5d50fb00($t){

}
function template_4870c643ce0f402d15b20aff5d50fb00($t){
?><?php  if(jAuth::isConnected()){?>
<div class="option">
<ul>
<li><a href="<?php jtpl_function_html_jurl( $t,'editPage', array('page'=>$t->_vars['page']));?>"><?php echo jLocale::get('jelix~crud.link.edit.record'); ?></a></li>
</ul>
</div>
<?php  } ?><?php 
}
?>