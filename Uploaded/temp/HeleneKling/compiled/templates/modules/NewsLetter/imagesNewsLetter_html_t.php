<?php 
function template_meta_8318f7791f17123f41398238bd693c37($t){

}
function template_8318f7791f17123f41398238bd693c37($t){
?><h1 style="
border-bottom: 1px solid #ccc;
	border-top: 1px solid #ccc;
	border-right: 20px solid #b48181;
	color: #b38b84;
	font-size: 140%;
	font-weight: normal;
	margin: 5px 0;
"><?php echo jLocale::get('news.last.paintings.title'); ?></h1>
<?php foreach($t->_vars['images'] as $t->_vars['image']):?>
		<h2 style="color: #b38b84;
		font-size: 120%;
		font-weight: normal;
		margin: 5px 10px;"
		><?php echo $t->_vars['image']->name; ?></h2>
		<ul style="float:right">
			<li style="font-size:100%;list-style-type:none"><?php echo $t->_vars['image']->price; ?></li>
			<li style="font-size:100%;list-style-type:none"><?php echo $t->_vars['image']->size; ?></li>
		</ul>
		<img width="150" src="<?php echo $t->_vars['image']->url; ?>"/>
<?php endforeach;?>
<?php 
}
?>