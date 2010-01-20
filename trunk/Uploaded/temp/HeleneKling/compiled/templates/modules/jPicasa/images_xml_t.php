<?php 
function template_meta_b759145ec74890bae9078bd661c4a164($t){

}
function template_b759145ec74890bae9078bd661c4a164($t){
?><images>
<?php foreach($t->_vars['images'] as $t->_vars['image']):?>
	<image>
		<name><?php echo $t->_vars['image']->name; ?></name>
		<id><?php echo $t->_vars['image']->id; ?></id>
		<url><?php echo $t->_vars['image']->url; ?></url>
		<height><?php echo $t->_vars['image']->height; ?></height>
		<width><?php echo $t->_vars['image']->width; ?></width>
	</image>
<?php endforeach;?>
</images><?php 
}
?>