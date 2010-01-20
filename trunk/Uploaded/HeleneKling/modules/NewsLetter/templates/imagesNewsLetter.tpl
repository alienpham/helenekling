<h1 style="
border-bottom: 1px solid #ccc;
	border-top: 1px solid #ccc;
	border-right: 20px solid #b48181;
	color: #b38b84;
	font-size: 140%;
	font-weight: normal;
	margin: 5px 0;
">{@news.last.paintings.title@}</h1>
{foreach $images as $image}
		<h2 style="color: #b38b84;
		font-size: 120%;
		font-weight: normal;
		margin: 5px 10px;"
		>{$image->name}</h2>
		<ul style="float:right">
			<li style="font-size:100%;list-style-type:none">{$image->price}</li>
			<li style="font-size:100%;list-style-type:none">{$image->size}</li>
		</ul>
		<img width="150" src="{$image->url}"/>
{/foreach}
