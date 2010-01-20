<h1>{@jelix~crud.title.list@}</h1>

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
{assign $lineparity = true}
{foreach $list as $record}
<tr class="{if $lineparity}odd{else}even{/if}">
    {foreach $properties as $propname}
    <td>{$record->$propname}</td>
    {/foreach}
    <td>
        <a href="{jurl $viewAction,array('id'=>$record->$primarykey)}">{@jelix~crud.link.view.record@}</a>
    </td>
    <td>
        <a href="{jurl 'prepareToSave',array('id'=>$record->$primarykey)}">Envoyer</a>
    </td>
</tr>
{assign $lineparity = !$lineparity}
{/foreach}
</tbody>
</table>
{if $recordCount > $listPageSize}
<p class="record-pages-list">Pages : {pagelinks $listAction, array(),  $recordCount, $page, $listPageSize, $offsetParameterName }</p>
{/if}
<p><a href="{jurl 'newLetter'}" class="crud-link">{@jelix~crud.link.create.record@}</a>.</p>

