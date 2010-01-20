<?php 
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.ctrl_label.php');
 require_once('/homepages/5/d177360615/htdocs/lib/jelix/plugins/tpl/html/function.ctrl_control.php');
function template_meta_bf63ea73e3fe0fa0aeae54c7a85ee3d6($t){
if(isset($t->_vars['formulaire'])) { $t->_vars['formulaire']->getBuilder('html')->outputMetaContent($t);}

}
function template_bf63ea73e3fe0fa0aeae54c7a85ee3d6($t){
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="http://www.helenekling.com/favicon.ico" type="image/x-icon" /> 


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-7336483-1");
pageTracker._trackPageview();
} catch(err) 
{
	
}
</script>

<title>Helene Kling</title>
<script type="text/javascript">
 

        function onSilverlightError(sender, args) {
        
            var appSource = "";
            if (sender != null && sender != 0) {
                appSource = sender.getHost().Source;
            } 
            var errorType = args.ErrorType;
            var iErrorCode = args.ErrorCode;
            
            var errMsg = "Unhandled Error in Silverlight 2 Application " +  appSource + "\n" ;

            errMsg += "Code: "+ iErrorCode + "    \n";
            errMsg += "Category: " + errorType + "       \n";
            errMsg += "Message: " + args.ErrorMessage + "     \n";

            if (errorType == "ParserError")
            {
                errMsg += "File: " + args.xamlFile + "     \n";
                errMsg += "Line: " + args.lineNumber + "     \n";
                errMsg += "Position: " + args.charPosition + "     \n";
            }
            else if (errorType == "RuntimeError")
            {           
                if (args.lineNumber != 0)
                {
                    errMsg += "Line: " + args.lineNumber + "     \n";
                    errMsg += "Position: " +  args.charPosition + "     \n";
                }
                errMsg += "MethodName: " + args.methodName + "     \n";
            }

            throw new Error(errMsg);
        }
 
        
    </script>

</head>
<body>
<div id="wrap">
  
  <!-- start of container -->
  <div id="header">
  		<div id="header-title">Helene Kling</div>
  		<div id="quick-search">
  			<?php  $t->_privateVars['__form'] = $t->_vars['formulaire'];
$t->_privateVars['__formbuilder'] = $t->_privateVars['__form']->getBuilder('html');
$t->_privateVars['__formbuilder']->setAction( 'jPicasa~basicGallery:search',array());
$t->_privateVars['__formbuilder']->outputHeader(array());
$t->_privateVars['__displayed_ctrl'] = array();
?>
 			   <?php $ctrls_to_display=null;$ctrls_notto_display=null;
if (!isset($t->_privateVars['__displayed_ctrl'])) {
    $t->_privateVars['__displayed_ctrl'] = array();
}
$t->_privateVars['__ctrlref']='';

foreach($t->_privateVars['__form']->getRootControls() as $ctrlref=>$ctrl){
    if(!$t->_privateVars['__form']->isActivated($ctrlref)) continue;
    if($ctrl->type == 'reset' || $ctrl->type == 'hidden') continue;
if($ctrl->type == 'submit') continue;if(!isset($t->_privateVars['__displayed_ctrl'][$ctrlref])
       && (  ($ctrls_to_display===null && $ctrls_notto_display === null)
          || ($ctrls_to_display===null && !in_array($ctrlref, $ctrls_notto_display))
          || (is_array($ctrls_to_display) && in_array($ctrlref, $ctrls_to_display) ))) {
        $t->_privateVars['__ctrlref'] = $ctrlref;
        $t->_privateVars['__ctrl'] = $ctrl;
?>            
         			<?php  if(isset($t->_privateVars['__ctrlref'])&&($t->_privateVars['__ctrlref']=='name')):?>
         				 <?php jtpl_function_html_ctrl_label( $t);?> : <?php jtpl_function_html_ctrl_control( $t);?>
         			<?php  endif; ?>
      		<?php }} $t->_privateVars['__ctrlref']='';?>
      		<?php $t->_privateVars['__formbuilder']->outputFooter();
unset($t->_privateVars['__form']);
unset($t->_privateVars['__formbuilder']);
unset($t->_privateVars['__displayed_ctrl']);?>
   		</div>
	</form>
  		
  		
  </div>
  
<?php 
}
?>