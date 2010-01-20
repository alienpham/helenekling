<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.formurl.php');
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.formurlparam.php');
function template_meta_e867509d90cdadf5aa77293af075f3f6($t){

}
function template_e867509d90cdadf5aa77293af075f3f6($t){
?><div id="auth_login_zone">
<?php if($t->_vars['failed']):?>
<p><?php echo jLocale::get('jauth~auth.failedToLogin'); ?></p>
<?php endif;?>

<?php if(! $t->_vars['isLogged']):?>

<form action="<?php jtpl_function_html_formurl( $t,'jauth~login:in');?>" method="post" id="loginForm">
      <fieldset>
      <table>
       <tr>
           <th><label for="login"><?php echo jLocale::get('jauth~auth.login'); ?></label></th>
        <td><input type="text" name="login" id="login" size="9" value="<?php echo $t->_vars['login']; ?>" /></td>
       </tr>
       <tr>
           <th><label for="password"><?php echo jLocale::get('jauth~auth.password'); ?></label></th>
        <td><input type="password" name="password" id="password" size="9" /></td>
       </tr>
       <?php if($t->_vars['showRememberMe']):?>
       <tr>
           <th><label for="rememberMe"><?php echo jLocale::get('jauth~auth.rememberMe'); ?></label></th>
        <td><input type="checkbox" name="rememberMe" id="rememberMe" value="1" /></td>
       </tr>
       <?php endif;?>
       </table>
       <?php jtpl_function_html_formurlparam( $t,'jauth~login:in');?>
       <?php if(!empty($t->_vars['auth_url_return'])):?>
       <input type="hidden" name="auth_url_return" value="<?php echo htmlspecialchars($t->_vars['auth_url_return']); ?>" />
       <?php endif;?>
       <input type="submit" value="<?php echo jLocale::get('jauth~auth.buttons.login'); ?>"/>
       </fieldset>
   </form>
<?php else:?>
    <p><?php echo $t->_vars['user']->login; ?></p>
<?php endif;?>
</div>
<?php 
}
?>