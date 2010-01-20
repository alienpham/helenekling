<?php
/*
 * Created on 23 fŽvr. 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
function jtpl_block_html_ifconnected($compiler, $begin, $params=array())
{
    if($begin){
        if(count($params)){
            $content='';
            $compiler->doError1('errors.tplplugin.block.too.many.arguments','ifuserconnected');
        }else{
            $content = ' if(jAuth::isConnected()){';
        }
    }else{
        $content = ' } ';
    }
    return $content;
}
 
?>
