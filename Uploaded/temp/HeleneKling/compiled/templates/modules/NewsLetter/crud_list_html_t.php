<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.pagelinks.php');
function template_meta_31b9b44a33309d480e7f3683318bbb47($t){

}
function template_31b9b44a33309d480e7f3683318bbb47($t){
?><h1><?php echo jLocale::get('jelix~crud.title.list'); ?></h1>

<table class="records-list">
<thead>
<tr>
  	<th>Id</th>
  	<th>Date de Creation</th>
  	<th>Lettre</th>
  	<th></th>
  	<th></th>
</tr>
</thead>
<tbody>
<?php $t->_vars['lineparity'] = true; foreach($t->_vars['list'] as $t->_vars['record']):?>
<tr class="<?php if($t->_vars['lineparity']):?>odd<?php else:?>even<?php endif;?>">
    <?php foreach($t->_vars['properties'] as $t->_vars['propname']):?>
    <td><?php echo $t->_vars['record']->{$t->_vars['propname']}; ?></td>
    <?php endforeach;?>
    <td>
        <a href="<?php jtpl_function_html_jurl( $t,$t->_vars['viewAction'],array('id'=>$t->_vars['record']->{$t->_vars['primarykey']}));?>"><?php echo jLocale::get('jelix~crud.link.view.record'); ?></a>
    </td>
    <td>
        <a href="<?php jtpl_function_html_jurl( $t,'prepareToSave',array('id'=>$t->_vars['record']->{$t->_vars['primarykey']}));?>">Envoyer</a>
    </td>
</tr>
<?php $t->_vars['lineparity'] = !$t->_vars['lineparity']; endforeach;?>
</tbody>
</table>
<?php if($t->_vars['recordCount'] > $t->_vars['listPageSize']):?>
<p class="record-pages-list">Pages : <?php jtpl_function_html_pagelinks( $t,$t->_vars['listAction'], array(), $t->_vars['recordCount'], $t->_vars['page'], $t->_vars['listPageSize'], $t->_vars['offsetParameterName'] );?></p>
<?php endif;?>
<p><a href="<?php jtpl_function_html_jurl( $t,'newLetter');?>" class="crud-link"><?php echo jLocale::get('jelix~crud.link.create.record'); ?></a>.</p>

<?php 
}
?>