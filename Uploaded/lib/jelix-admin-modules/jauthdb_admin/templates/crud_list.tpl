<h1>{@jauthdb_admin~crud.title.list@}</h1>

<table class="records-list">
<thead>
<tr>
    <th>{@jauthdb_admin~crud.list.col.login@}</th>
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
{assign $lineparity = true}
{foreach $list as $record}
<tr class="{if $lineparity}odd{else}even{/if}">
    <td>{$record->login|eschtml}</td>
    <td>
        {if $canview}
        <a href="{jurl 'jauthdb_admin~default:view',array('id'=>$record->$primarykey)}">{@jauthdb_admin~crud.link.view.record@}</a>
        {/if}
    </td>
</tr>
{assign $lineparity = !$lineparity}
{/foreach}
</tbody>
</table>
{if $recordCount > $listPageSize}
<div class="record-pages-list">Pages : {pagelinks 'jauthdb_admin~default:index', array(),  $recordCount, $page, $listPageSize, 'offset' }</div>
{/if}
{if $cancreate}
<p><a href="{jurl 'jauthdb_admin~default:precreate'}" class="crud-link">{@jauthdb_admin~crud.link.create.record@}</a>.</p>
{/if}

