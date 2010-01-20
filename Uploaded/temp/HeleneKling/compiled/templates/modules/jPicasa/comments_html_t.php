<?php 
function template_meta_86397327cb560edfefd70569f8c24d62($t){

}
function template_86397327cb560edfefd70569f8c24d62($t){
?>
<div class="comentaire">
<?php foreach($t->_vars['coms'] as $t->_vars['com']):?>
<h1><?php echo $t->_vars['com'][0]; ?></h1>
<p>
<?php echo $t->_vars['com'][1]; ?>
</p>
<?php endforeach;?>
</div>
<?php 
}
?>