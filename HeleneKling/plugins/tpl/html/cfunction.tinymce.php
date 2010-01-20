<?php
 
/**
 * cfunction plugin :  init a tinymce environnement
 *    
 * @param jTplCompiler $compiler 
 */
function jtpl_cfunction_html_tinymce($compiler, $params=array()) {
 
    // on génère du code php qui sera intégré dans le template compilé
 
    $codesource = '$rep = $GLOBALS[\'gJCoord\']->response;
                   if($rep!=null) {
                       $rep->addJSLink(\'js/tinymce/tiny_mce.js\');
                       $rep->addJSCode(\'tinyMCE.init({ mode : "textareas", theme : "simple"});\');
                    } ';
 
    $compiler->addMetaContent($codesource);
}
 
?>