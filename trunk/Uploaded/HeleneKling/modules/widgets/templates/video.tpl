<div id="{$video}">
	<a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</div>
	{literal}
	<script type="text/javascript" src="{/literal}{$path}{literal}/swfobject.js"></script>

	<script type="text/javascript">
		var s2 = new SWFObject("{/literal}{$path}{literal}/player.swf","toto","640","400","9","#FFFFFF");
		s2.addParam("allowfullscreen","true");
		s2.addParam("allowscriptaccess","always");
		s2.addParam("flashvars","file=videos/{/literal}{$video}{literal}");
		s2.write("{/literal}{$video}{literal}");
	</script>
	{/literal}
