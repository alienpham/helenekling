<div id="navigation">
	<h1>Galleries</h1>
	<ul>
		<li><a href="../../PhotoGallery/PhotoGallery.html">{@common.view.cool.gallery@}</a></li>
		<li><a href="{jurl 'basicGallery:index'}">{@common.view.basic.gallery@}</a></li>
	</ul>
</div>

<div id="contenu">
<div class="bloc">
<h1>Last paintings</h1>
	<table>
	
{assign $i = 0}
	{foreach $images as $image}
	{if $i%4 == 0 }<tr>{/if}
		<td style="padding:5px 5px 5px 5px;height:50px;align:center">
				<h3>{$image->name}</h3>
				<img align="center" height="150px" src="{$image->url}"/>
				<p style="font-size:100%;text-align:center;padding:0px 0px 0px 0px;">{$image->price} | {$image->size}</p>
				
		</td>
		{if $i%4 == 3 }</tr>{/if}
		{assign $i = $i+1}
	{/foreach}
	</table>
</div>	
</div>

<div class="bloc">
<h1>{@common.search@}</h1>
{formfull $formulaire, 'jPicasa~basicGallery:search'}
</div>
<div class="bloc">
<h1>Video : {$video->name}</h1>
<div style="margin-left: 20px;
  margin-right: auto;
">{zone 'widgets~videoFLV', array('video'=>$video->url)}</div>
<p>{$video->description}</p>
</div>
