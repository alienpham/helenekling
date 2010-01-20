<albums>
{foreach $albums as $album}
	<album>
		<id>{$album->id}</id>
		<name>{$album->name}</name>
	</album>
{/foreach}
</albums>