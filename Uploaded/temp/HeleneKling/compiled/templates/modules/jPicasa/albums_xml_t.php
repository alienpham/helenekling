<?php 
function template_meta_f7632d076ecb827139645a914d81c79e($t){

}
function template_f7632d076ecb827139645a914d81c79e($t){
?><albums>
<?php foreach($t->_vars['albums'] as $t->_vars['album']):?>
	<album>
		<id><?php echo $t->_vars['album']->id; ?></id>
		<name><?php echo $t->_vars['album']->name; ?></name>
	</album>
<?php endforeach;?>
</albums><?php 
}
?>