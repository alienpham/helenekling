<h1>{@jelix~crud.title.list@}</h1>

<table class="records-list">
<thead>
<tr>
    {foreach $properties as $propname}
    {if isset($controls[$propname])}
    <th>{$controls[$propname]->label|eschtml}</th>
    {else}
    <th>{$propname|eschtml}</th>
    {/if}
    {/foreach}
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
{assign $lineparity = true}
{foreach $list as $record}
<tr class="{if $lineparity}odd{else}even{/if}">
    {foreach $properties as $propname}
    <td>{$record->$propname|eschtml}</td>
    {/foreach}
    <td>
        <a href="{jurl $viewAction,array($spkName=>$spk, $dpkName=>$record->$dpkName)}">{@jelix~crud.link.view.record@}</a>
    </td>
</tr>
{assign $lineparity = !$lineparity}
{/foreach}
</tbody>
</table>
{if $recordCount > $listPageSize}
<p class="crud-pages">Pages : {pagelinks $listAction, array($spkName=>$spk),  $recordCount, $page, $listPageSize, $offsetParameterName }</p>
{/if}
<p><a href="{jurl $createAction, array($spkName=>$spk)}" class="crud-link">{@jelix~crud.link.create.record@}</a>.</p>

