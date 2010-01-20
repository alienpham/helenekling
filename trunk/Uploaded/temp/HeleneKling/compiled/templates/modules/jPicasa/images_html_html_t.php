<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_6683987b065eaada7dd5997c4b29b819($t){
if(isset($t->_vars['form'])) { $t->_vars['form']->getBuilder('html')->outputMetaContent($t);}

}
function template_6683987b065eaada7dd5997c4b29b819($t){
?>
<script language="javascript">
var state = 'none';
function showhide(layer_ref) {
	if (state == 'block') {
		state = 'none';
	}
	else {
		state = 'block';
	}
	if (document.all) { //IS IE 4 or 5 (or 6 beta)
		eval( "document.all." + layer_ref + ".style.display = state");
	}
	if (document.layers) { //IS NETSCAPE 4 or below
		document.layers[layer_ref].display = state;
	}
	if (document.getElementById &&!document.all) {
		hza = document.getElementById(layer_ref);
		hza.style.display = state;
	}
}

function getAjax(id,url){
       	$.get(url,function(data){
       		alert(data);
					$("#"+id).html(data);
   	    });
 }
</script> 


<?php if($t->_vars['video'] != null):?>
<a  href="#" onclick="showhide('slideshow');"><?php echo jLocale::get('common.view.slideshow'); ?></a>
<div id="slideshow" style="display: none;">
<h1><?php echo jLocale::get('common.album.slideshow'); ?></h1>
<?php echo jZone::get('widgets~videoFLV', array('video'=>$t->_vars['video']->url));?>
</div>
<?php endif; if($t->_vars['images'] == null):?>
	<p>No Paintings</p>
<?php else:?>
	<?php if($t->_vars['commented']):?>
		<p>Commentaire ajouté</p>
	<?php endif;?>

	<?php foreach($t->_vars['images'] as $t->_vars['image']):?>
		<div class="bloc">
		<h1><?php echo $t->_vars['image']->name; ?></h1>
		<div style="position:relative;">
				<img width="50%" src="<?php echo $t->_vars['image']->url; ?>"/>
		
		<div style="position:absolute;top:1em;left:50%">
		<ul>
			<li style="font-size:150%;list-style-type:none"><?php echo $t->_vars['image']->price; ?></li>
			<li style="font-size:150%;list-style-type:none"><?php echo $t->_vars['image']->size; ?></li>
			<li style="font-size:80%;list-style-type:none">
				<!--
				<a href="<?php jtpl_function_html_jurl( $t,'basicGallery:addComment' , array('albumId'=>$t->_vars['albumId'],));?>&imageId=<?php echo $t->_vars['image']->id; ?>">Add Comment</a>
				-->
				<a href="#" onclick="showhide('com<?php echo $t->_vars['image']->id; ?>')">Add Comment</a>
				
			</li>
			<div id="com<?php echo $t->_vars['image']->id; ?>" style="max-width:330px;display:none;float:right">
				<li style="font-size:80%;list-style-type:none">
					<?php  $formfull = $t->_vars['form'];
    $formfullBuilder = $formfull->getBuilder('html');
    $formfullBuilder->setAction( 'basicGallery:addComment', array('imageId'=>$t->_vars['image']->id));
    $formfullBuilder->outputHeader(array());
    $formfullBuilder->outputAllControls();
    $formfullBuilder->outputFooter();?>
				</li>	
			</div>
			<li style="font-size:80%;list-style-type:none">
					<a href="#" onclick="window.open('<?php jtpl_function_html_jurl( $t,"basicGallery:viewComment" , array("albumId"=>$t->_vars['albumId'],));?>&imageId=<?php echo $t->_vars['image']->id; ?>','nom','toolbar=0,menubar=0,location=0,scrollbars=1,width=400,height=300')">View Comments</a>
					<!-- <a href="#" onclick='getAjax("coms<?php echo $t->_vars['image']->id; ?>","<?php jtpl_function_html_jurl( $t,"basicGallery:viewComment" , array("albumId"=>$t->_vars['albumId'],));?>&imageId=<?php echo $t->_vars['image']->id; ?>")'>View Comments</a>
					-->
			</li>
		</ul>
		</div>
		<div id="coms<?php echo $t->_vars['image']->id; ?>">
			<!-- AJAX -->
		</div>
		</div>
		</div>
	<?php endforeach;?>
	
<?php endif;?>
<br>
<a href="<?php jtpl_function_html_jurl( $t,'basicGallery:albums');?>"><?php echo jLocale::get('common.back.to.albums'); ?></a>
<?php 
}
?>