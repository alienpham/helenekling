<h1>{@common.albums@}</h1>
<table>
{assign $i = 0}
{foreach $albums as $album}
 {if $i%4 == 0 }<tr>{/if}
		<td style="padding:5px 5px 5px 5px;height:50px">
					<a href="{jurl 'basicGallery:images', Array('albumId' => $album->id)}albumId={$album->id}">
						<img src="{$album->thumbnailUrl}" />
						<p style="text-align:center;font-size:80%">{$album->name}</p>
					</a>
		</td>
{if $i%4 == 3 }</tr>{/if}
{assign $i = $i+1}

{/foreach}
</table>