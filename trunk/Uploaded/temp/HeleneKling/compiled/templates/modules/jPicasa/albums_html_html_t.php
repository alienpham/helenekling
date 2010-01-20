<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_2c4240f6b4d64a7da159e91e95a8315a($t){

}
function template_2c4240f6b4d64a7da159e91e95a8315a($t){
?><h1><?php echo jLocale::get('common.albums'); ?></h1>
<table>
<?php $t->_vars['i'] = 0; foreach($t->_vars['albums'] as $t->_vars['album']):?>
 <?php if($t->_vars['i']%4 == 0 ):?><tr><?php endif;?>
		<td style="padding:5px 5px 5px 5px;height:50px">
					<a href="<?php jtpl_function_html_jurl( $t,'basicGallery:images', Array('albumId' => $t->_vars['album']->id));?>albumId=<?php echo $t->_vars['album']->id; ?>">
						<img src="<?php echo $t->_vars['album']->thumbnailUrl; ?>" />
						<p style="text-align:center;font-size:80%"><?php echo $t->_vars['album']->name; ?></p>
					</a>
		</td>
<?php if($t->_vars['i']%4 == 3 ):?></tr><?php endif; $t->_vars['i'] = $t->_vars['i']+1;?>

<?php endforeach;?>
</table><?php 
}
?>