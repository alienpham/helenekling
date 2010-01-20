<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.pagelinks.php');
function template_meta_c6c3209f21a9d1f4126c529d5d56c118($t){

}
function template_c6c3209f21a9d1f4126c529d5d56c118($t){
?><?php  if(jAuth::isConnected()){?>
<div class="option">
<ul>
<li>
<a href="<?php jtpl_function_html_jurl( $t,$t->_vars['createAction']);?>" class="crud-link"><?php echo jLocale::get('jelix~crud.link.create.record'); ?></a>
</li>
</ul>
</div>
<?php  }  foreach($t->_vars['list'] as $t->_vars['record']):?>
	<?php echo jZone::get('viewevent' , array('id'=>$t->_vars['record']->id)); endforeach; if($t->_vars['recordCount'] > $t->_vars['listPageSize']):?>
<p class="record-pages-list">Pages : <?php jtpl_function_html_pagelinks( $t,$t->_vars['listAction'], array(), $t->_vars['recordCount'], $t->_vars['page'], $t->_vars['listPageSize'], $t->_vars['offsetParameterName'] );?></p>
<?php endif;?>

<?php 
}
?>