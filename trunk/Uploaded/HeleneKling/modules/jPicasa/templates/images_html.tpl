{literal}
<script language="javascript">
var state = 'none';
function showhide(layer_ref) {
	if (state == 'block') {
		state = 'none';
	}
	else {
		state = 'block';
	}
	if (document.all) { //IS IE 4 or 5 (or 6 beta)
		eval( "document.all." + layer_ref + ".style.display = state");
	}
	if (document.layers) { //IS NETSCAPE 4 or below
		document.layers[layer_ref].display = state;
	}
	if (document.getElementById &&!document.all) {
		hza = document.getElementById(layer_ref);
		hza.style.display = state;
	}
}

function getAjax(id,url){
       	$.get(url,function(data){
       		alert(data);
					$("#"+id).html(data);
   	    });
 }
</script> 
{/literal}

{if $video != null}
<a  href="#" onclick="showhide('slideshow');">{@common.view.slideshow@}</a>
<div id="slideshow" style="display: none;">
<h1>{@common.album.slideshow@}</h1>
{zone 'widgets~videoFLV', array('video'=>$video->url)}
</div>
{/if}
{if $images == null}
	<p>No Paintings</p>
{else}
	{if $commented}
		<p>Commentaire ajouté</p>
	{/if}

	{foreach $images as $image}
		<div class="bloc">
		<h1>{$image->name}</h1>
		<div style="position:relative;">
				<img width="50%" src="{$image->url}"/>
		
		<div style="position:absolute;top:1em;left:50%">
		<ul>
			<li style="font-size:150%;list-style-type:none">{$image->price}</li>
			<li style="font-size:150%;list-style-type:none">{$image->size}</li>
			<li style="font-size:80%;list-style-type:none">
				<!--
				<a href="{jurl 'basicGallery:addComment' , array('albumId'=>$albumId,)}&imageId={$image->id}">Add Comment</a>
				-->
				<a href="#" onclick="showhide('com{$image->id}')">Add Comment</a>
				
			</li>
			<div id="com{$image->id}" style="max-width:330px;display:none;float:right">
				<li style="font-size:80%;list-style-type:none">
					{formfull $form, 'basicGallery:addComment', array('imageId'=>$image->id)}
				</li>	
			</div>
			<li style="font-size:80%;list-style-type:none">
					<a href="#" onclick="window.open('{jurl "basicGallery:viewComment" , array("albumId"=>$albumId,)}&imageId={$image->id}','nom','toolbar=0,menubar=0,location=0,scrollbars=1,width=400,height=300')">View Comments</a>
					<!-- <a href="#" onclick='getAjax("coms{$image->id}","{jurl "basicGallery:viewComment" , array("albumId"=>$albumId,)}&imageId={$image->id}")'>View Comments</a>
					-->
			</li>
		</ul>
		</div>
		<div id="coms{$image->id}">
			<!-- AJAX -->
		</div>
		</div>
		</div>
	{/foreach}
	
{/if}
<br>
<a href="{jurl 'basicGallery:albums'}">{@common.back.to.albums@}</a>
