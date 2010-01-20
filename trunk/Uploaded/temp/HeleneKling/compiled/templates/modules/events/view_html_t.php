<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_124e5a7a278c192a967422a1d4e8dba9($t){

}
function template_124e5a7a278c192a967422a1d4e8dba9($t){
?><div class="event">
<div style="min-height:160px;margin: 20px 0px 0px 0px">
		<h1><?php echo $t->_vars['record']->name; ?></h1>
		<div style="float:right;margin: 20px 0px 0px 0px;border:1px solid #ccc;max-width:200px">
			<table style="padding:5px 5px 5px 5px;">
				<tr>
					<td><b><?php echo jLocale::get('events.opening'); ?></b></td>
					<td>:</td> 
					<td><?php echo $t->_vars['record']->date_debut; ?></td>
				</tr>
				<tr>
					<td><b><?php echo jLocale::get('events.closing'); ?></b></td>
					<td>:</td>
					<td><?php echo $t->_vars['record']->date_fin; ?></td>
				</tr>
				<tr>
					<td><b><?php echo jLocale::get('events.horaires'); ?></b></td>
					<td>:</td> 
					<td><?php echo $t->_vars['record']->horaires; ?></td>
				</tr>
				<tr>
					<td><b><?php echo jLocale::get('events.adresse'); ?></b></td> 
					<td>:</td>
					<td><a href="http://maps.google.fr/?q=<?php echo $t->_vars['record']->adresse; ?>"><?php echo $t->_vars['record']->adresse; ?></a></td>
				</tr>
				<tr>
					<td><b><?php echo jLocale::get('events.else'); ?></b></td> 
					<td>:</td>
					<td><a href="../../../flyers/<?php echo $t->_vars['record']->flyer; ?>"><?php echo jLocale::get('events.flyer'); ?></a></td>
				</tr>
			</table>
		</div>
		<div>
			<?php echo $t->_vars['record']->description; ?>
		</div>
	</div>
	<?php  if(jAuth::isConnected()){?>
			<div class="option"><ul>
				<li>
					<a href="<?php jtpl_function_html_jurl( $t,$t->_vars['editAction'],array('id'=>$t->_vars['record']->id));?>"><?php echo jLocale::get('jelix~crud.link.edit.record'); ?></a>
				</li>
				<li>
					<a href="<?php jtpl_function_html_jurl( $t,$t->_vars['deleteAction'], array('id'=>$t->_vars['record']->id));?>" class="crud-link" onclick="return confirm('<?php echo jLocale::get('jelix~crud.confirm.deletion'); ?>')"><?php echo jLocale::get('jelix~crud.link.delete.record'); ?></a>
				</li>
				
			</ul></div>	
	<?php  } ?>
</div><?php 
}
?>