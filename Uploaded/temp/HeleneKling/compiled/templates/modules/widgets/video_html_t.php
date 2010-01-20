<?php 
function template_meta_ba4cfa628cc84d8269f607f706924de6($t){

}
function template_ba4cfa628cc84d8269f607f706924de6($t){
?><div id="<?php echo $t->_vars['video']; ?>">
	<a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</div>
	
	<script type="text/javascript" src="<?php  echo $t->_vars['path'];  ?>/swfobject.js"></script>

	<script type="text/javascript">
		var s2 = new SWFObject("<?php  echo $t->_vars['path'];  ?>/player.swf","toto","640","400","9","#FFFFFF");
		s2.addParam("allowfullscreen","true");
		s2.addParam("allowscriptaccess","always");
		s2.addParam("flashvars","file=videos/<?php  echo $t->_vars['video'];  ?>");
		s2.write("<?php  echo $t->_vars['video'];  ?>");
	</script>
	
<?php 
}
?>