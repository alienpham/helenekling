<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_54c3a220f4717fd5a9383e8f2ba2aee0($t){
if(isset($t->_vars['formulaire'])) { $t->_vars['formulaire']->getBuilder('html')->outputMetaContent($t);}

}
function template_54c3a220f4717fd5a9383e8f2ba2aee0($t){
?><div id="navigation">
	<h1>Galleries</h1>
	<ul>
		<li><a href="../../PhotoGallery/PhotoGallery.html"><?php echo jLocale::get('common.view.cool.gallery'); ?></a></li>
		<li><a href="<?php jtpl_function_html_jurl( $t,'basicGallery:index');?>"><?php echo jLocale::get('common.view.basic.gallery'); ?></a></li>
	</ul>
</div>

<div id="contenu">
<div class="bloc">
<h1>Last paintings</h1>
	<table>
	
<?php $t->_vars['i'] = 0;?>
	<?php foreach($t->_vars['images'] as $t->_vars['image']):?>
	<?php if($t->_vars['i']%4 == 0 ):?><tr><?php endif;?>
		<td style="padding:5px 5px 5px 5px;height:50px;align:center">
				<h3><?php echo $t->_vars['image']->name; ?></h3>
				<img align="center" height="150px" src="<?php echo $t->_vars['image']->url; ?>"/>
				<p style="font-size:100%;text-align:center;padding:0px 0px 0px 0px;"><?php echo $t->_vars['image']->price; ?> | <?php echo $t->_vars['image']->size; ?></p>
				
		</td>
		<?php if($t->_vars['i']%4 == 3 ):?></tr><?php endif;?>
		<?php $t->_vars['i'] = $t->_vars['i']+1;?>
	<?php endforeach;?>
	</table>
</div>	
</div>

<div class="bloc">
<h1><?php echo jLocale::get('common.search'); ?></h1>
<?php  $formfull = $t->_vars['formulaire'];
    $formfullBuilder = $formfull->getBuilder('html');
    $formfullBuilder->setAction( 'jPicasa~basicGallery:search',array());
    $formfullBuilder->outputHeader(array());
    $formfullBuilder->outputAllControls();
    $formfullBuilder->outputFooter();?>
</div>
<div class="bloc">
<h1>Video : <?php echo $t->_vars['video']->name; ?></h1>
<div style="margin-left: 20px;
  margin-right: auto;
"><?php echo jZone::get('widgets~videoFLV', array('video'=>$t->_vars['video']->url));?></div>
<p><?php echo $t->_vars['video']->description; ?></p>
</div>
<?php 
}
?>