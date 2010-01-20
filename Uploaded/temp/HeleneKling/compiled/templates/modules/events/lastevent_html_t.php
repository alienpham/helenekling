<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_29356549c4e38e1b87c94c26e0e931bc($t){

}
function template_29356549c4e38e1b87c94c26e0e931bc($t){
?>
<?php if($t->_vars['id'] != null):?>
	<?php echo jZone::get('viewevent' , array('id'=>$t->_vars['id']));?>
	<div class="option">
<ul>
    <li><a href="<?php jtpl_function_html_jurl( $t,$t->_vars['listAction']);?>" class="crud-link"><?php echo jLocale::get('events.events'); ?></a></li>
</ul>
</div>
<?php endif;?>
<?php 
}
?>