<images>
{foreach $images as $image}
	<image>
		<name>{$image->name}</name>
		<id>{$image->id}</id>
		<url>{$image->url}</url>
		<height>{$image->height}</height>
		<width>{$image->width}</width>
	</image>
{/foreach}
</images>