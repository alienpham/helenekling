<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_0239d0b823243b5ed66125b29e6c8937($t){

}
function template_0239d0b823243b5ed66125b29e6c8937($t){
?><div id="navigation">
<h1>NewsLetter Tools</h1>
<ul>
<li>
<a href="<?php jtpl_function_html_jurl( $t,'newPaintingsLetter');?>"><?php echo jLocale::get('news.last.paintings'); ?></a>
</li>
<li>
<a href="<?php jtpl_function_html_jurl( $t,'newLetter');?>"><?php echo jLocale::get('news.custom'); ?></a>
</li>
<li>
	<a href="<?php jtpl_function_html_jurl( $t,'newsletters:index');?>">Lister les news letters</a>
</li>
<li>
<a href="<?php jtpl_function_html_jurl( $t,'emails:index');?>"><?php echo jLocale::get('news.view.edit.contacts'); ?></a>
</li>
<li>
	<a href="<?php jtpl_function_html_jurl( $t,'emails_logs:index');?>">Logs</a>
</li>
</ul>
</div><?php 
}
?>