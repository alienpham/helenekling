{ifconnected}
<div class="option">
<ul>
<li>
<a href="{jurl $createAction}" class="crud-link">{@jelix~crud.link.create.record@}</a>
</li>
</ul>
</div>
{/ifconnected}
{foreach $list as $record}
	{zone 'viewevent' , array('id'=>$record->id)}
{/foreach}
{if $recordCount > $listPageSize}
<p class="record-pages-list">Pages : {pagelinks $listAction, array(),  $recordCount, $page, $listPageSize, $offsetParameterName }</p>
{/if}

