
{if $id != null}
	{zone 'viewevent' , array('id'=>$id)}
	<div class="option">
<ul>
    <li><a href="{jurl $listAction}" class="crud-link">{@events.events@}</a></li>
</ul>
</div>
{/if}
