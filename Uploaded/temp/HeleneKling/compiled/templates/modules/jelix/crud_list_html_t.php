<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.pagelinks.php');
function template_meta_db7ca66f6ed1c8c65b9872ef562338bd($t){

}
function template_db7ca66f6ed1c8c65b9872ef562338bd($t){
?><h1><?php echo jLocale::get('jelix~crud.title.list'); ?></h1>

<table class="records-list">
<thead>
<tr>
    <?php foreach($t->_vars['properties'] as $t->_vars['propname']):?>
    <?php if(isset($t->_vars['controls'][$t->_vars['propname']])):?>
    <th><?php echo htmlspecialchars($t->_vars['controls'][$t->_vars['propname']]->label); ?></th>
    <?php else:?>
    <th><?php echo htmlspecialchars($t->_vars['propname']); ?></th>
    <?php endif;?>
    <?php endforeach;?>
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php $t->_vars['lineparity'] = true; foreach($t->_vars['list'] as $t->_vars['record']):?>
<tr class="<?php if($t->_vars['lineparity']):?>odd<?php else:?>even<?php endif;?>">
    <?php foreach($t->_vars['properties'] as $t->_vars['propname']):?>
    <td><?php echo htmlspecialchars($t->_vars['record']->{$t->_vars['propname']}); ?></td>
    <?php endforeach;?>
    <td>
        <a href="<?php jtpl_function_html_jurl( $t,$t->_vars['viewAction'],array('id'=>$t->_vars['record']->{$t->_vars['primarykey']}));?>"><?php echo jLocale::get('jelix~crud.link.view.record'); ?></a>
    </td>
</tr>
<?php $t->_vars['lineparity'] = !$t->_vars['lineparity']; endforeach;?>
</tbody>
</table>
<?php if($t->_vars['recordCount'] > $t->_vars['listPageSize']):?>
<p class="record-pages-list">Pages : <?php jtpl_function_html_pagelinks( $t,$t->_vars['listAction'], array(), $t->_vars['recordCount'], $t->_vars['page'], $t->_vars['listPageSize'], $t->_vars['offsetParameterName'] );?></p>
<?php endif;?>
<p><a href="<?php jtpl_function_html_jurl( $t,$t->_vars['createAction']);?>" class="crud-link"><?php echo jLocale::get('jelix~crud.link.create.record'); ?></a>.</p>

<?php 
}
?>