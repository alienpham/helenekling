<?php 
function template_meta_3bac3c5f05ec9a1d1b4bfeb07a8293e0($t){

}
function template_3bac3c5f05ec9a1d1b4bfeb07a8293e0($t){
?><?php echo $t->_vars['text']; ?>

<?php echo jZone::get('editButton', array('page'=>'school'));?>
<h1>[Extrait DVD] Cho Lo</h1>
<?php echo jZone::get('widgets~videoFLV', array('video'=>'ChoLo--Paintings.flv'));?>

<?php echo jZone::get('widgets~videoFLV', array('video'=>'ChoLo--Portrait.flv'));?>
<?php 
}
?>