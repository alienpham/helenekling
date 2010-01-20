<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.jurl.php');
function template_meta_c261e67fad08751a1009b749ecc25ea1($t){

}
function template_c261e67fad08751a1009b749ecc25ea1($t){
?>
    <!-- left column, contains navigation and photos -->
    <div id="column1">
      <div id="nav">
        <ul>
          <li>
            <li><a href="#" accesskey="a">Catégories</a></li>
            <li>
               <ul>
					<li><a href="<?php jtpl_function_html_jurl( $t,'index');?>"><?php echo jLocale::get('menu.index'); ?></a></li>
					<li><a href="<?php jtpl_function_html_jurl( $t,'jPicasa~index');?>"><?php echo jLocale::get('menu.paintings'); ?><b style="color:red"> <?php echo jLocale::get('menu.new'); ?> </b></a></li>
					<li><a href="<?php jtpl_function_html_jurl( $t,'viewPage' , array('page'=>'school'));?>"><?php echo jLocale::get('menu.school'); ?></a></li>
					<!-- <li><a href="<?php jtpl_function_html_jurl( $t,'viewPage' , array('page'=>'expo'));?>"><?php echo jLocale::get('menu.expo'); ?></a></li> !-->
					<li><a href="<?php jtpl_function_html_jurl( $t,'events~events:index');?>"><?php echo jLocale::get('menu.events'); ?></a></li>
					<li><a href="<?php jtpl_function_html_jurl( $t,'NewsLetter~emails:precreate');?>"><?php echo jLocale::get('menu.keep.update'); ?><b style="color:red"> <?php echo jLocale::get('menu.new'); ?> </b></a></li>
					<li><a href="<?php jtpl_function_html_jurl( $t,'viewPage' , array('page'=>'contacts'));?>"><?php echo jLocale::get('menu.contacts'); ?></a></li>
					<?php  if(!jAuth::isConnected()){?><li><a href="<?php jtpl_function_html_jurl( $t,'login');?>"><?php echo jLocale::get('menu.login'); ?></a></li><?php  } ?>
               </ul>
            </li>
            <?php  if(jAuth::isConnected()){?>
            <li><a href="#" accesskey="a">Administration</a></li>
            <li>
               <ul>
					<li><a href="<?php jtpl_function_html_jurl( $t,'NewsLetter~default:index');?>"><?php echo jLocale::get('menu.newsletter'); ?></a></li>
               		<li><a href="<?php jtpl_function_html_jurl( $t,'events~files:index');?>"><?php echo jLocale::get('menu.files'); ?></a></li>
               
               </ul>
            </li>
            <?php  } ?>
            
	     </ul>
	     <div style="padding-left : 50%; padding-top: 20px;">
			<a href="<?php jtpl_function_html_jurl( $t,'index' ,array('lang'=>'fr_FR'));?>" hreflang="fr" ></a>
	     	<a href="<?php jtpl_function_html_jurl( $t,'index' ,array('lang'=>'en_US'));?>" hreflang="en" ></a>
	     </div>		     
      </div>
    </div>

    <?php 
}
?>