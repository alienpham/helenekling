<?php
/**
* Initialize all defines and includes necessary files
*
* @package  jelix
* @subpackage core
* @author   Jouanneau Laurent
* @contributor Loic Mathaud, Julien Issler
* @copyright 2005-2007 Jouanneau laurent
* @copyright 2007 Julien Issler
* @link     http://www.jelix.org
* @licence  GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/


/**
 * Version number of Jelix
 * @name  JELIX_VERSION
 */
define ('JELIX_VERSION', '1.2b1pre.1310');

/**
 * base of namespace path used in xml files of jelix
 * @name  JELIX_NAMESPACE_BASE
 */
define ('JELIX_NAMESPACE_BASE' , 'http://jelix.org/ns/');

define ('JELIX_LIB_PATH',         dirname (__FILE__).'/');
define ('JELIX_LIB_CORE_PATH',    JELIX_LIB_PATH.'core/');
define ('JELIX_LIB_UTILS_PATH',   JELIX_LIB_PATH.'utils/');
define ('LIB_PATH',               dirname(JELIX_LIB_PATH).'/');

define ('BYTECODE_CACHE_EXISTS', function_exists('apc_cache_info') || function_exists('eaccelerator_info') || function_exists('xcache_info'));

if(!defined('E_DEPRECATED'))
    define ('E_DEPRECATED',8192);
error_reporting (E_ALL | E_STRICT);


require (JELIX_LIB_CORE_PATH . 'jICoordPlugin.iface.php');
require (JELIX_LIB_CORE_PATH . 'jISelector.iface.php');
require (JELIX_LIB_CORE_PATH . 'jIUrlEngine.iface.php');
require (JELIX_LIB_CORE_PATH . 'jErrorHandler.lib.php');
require (JELIX_LIB_CORE_PATH . 'jException.lib.php');
require (JELIX_LIB_CORE_PATH . 'jContext.class.php');
require (JELIX_LIB_CORE_PATH . 'jConfig.class.php');
require (JELIX_LIB_CORE_PATH . 'jSelector.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorModule.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorActFast.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorAct.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorClass.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorDao.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorForm.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorIface.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorLoc.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorTpl.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorZone.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorSimpleFile.class.php');
require (JELIX_LIB_CORE_PATH . 'selector/jSelectorFile.lib.php');
require (JELIX_LIB_CORE_PATH . 'jUrlBase.class.php');
require (JELIX_LIB_CORE_PATH . 'jUrlAction.class.php');
require (JELIX_LIB_CORE_PATH . 'jUrl.class.php');
require (JELIX_LIB_CORE_PATH . 'jCoordinator.class.php');
require (JELIX_LIB_CORE_PATH . 'jController.class.php');
require (JELIX_LIB_CORE_PATH . 'jRequest.class.php');
require (JELIX_LIB_CORE_PATH . 'jResponse.class.php');
require (JELIX_LIB_CORE_PATH . 'jBundle.class.php');
require (JELIX_LIB_CORE_PATH . 'jLocale.class.php');
require (JELIX_LIB_CORE_PATH . 'jIncluder.class.php');
require (JELIX_LIB_CORE_PATH . 'jSession.class.php');

/**
 * The main object of Jelix which process all things
 * @global jCoordinator $gJCoord
 * @name $gJCoord
 */
$gJCoord = null;

/**
 * Object that contains all configuration values
 * @global stdobject $gJConfig
 * @name $gJConfig
 */
$gJConfig = null;

/**
 * contains path for __autoload function
 * @global array $gLibPath
 * @name $gLibPath
 * @see __autoload()
 */
$gLibPath=array('Db'=>JELIX_LIB_PATH.'db/', 'Dao'=>JELIX_LIB_PATH.'dao/',
 'Forms'=>JELIX_LIB_PATH.'forms/', 'Event'=>JELIX_LIB_PATH.'events/',
 'Tpl'=>JELIX_LIB_PATH.'tpl/', 'Acl'=>JELIX_LIB_PATH.'acl/', 'Controller'=>JELIX_LIB_PATH.'controllers/',
 'Auth'=>JELIX_LIB_PATH.'auth/', 'Installer'=>JELIX_LIB_PATH.'installer/');

/**
 * function used by php to try to load an unknown class
 */
function jelix_autoload($class) {
    if(preg_match('/^j(Dao|Tpl|Acl|Event|Db|Controller|Forms|Auth|Installer).*/i', $class, $m)){
        $f=$GLOBALS['gLibPath'][$m[1]].$class.'.class.php';
    }elseif(preg_match('/^cDao(?:Record)?_(.+)_Jx_(.+)_Jx_(.+)$/', $class, $m)){
        // for DAO which are stored in sessions for example
        $s = new jSelectorDao($m[1].'~'.$m[2], $m[3], false);
        if($GLOBALS['gJConfig']->compilation['checkCacheFiletime']){
            // if it is needed to check the filetime, then we use jIncluder
            // because perhaps we will have to recompile the dao before the include
            jIncluder::inc($s);
        }else{
            $f = $s->getCompiledFilePath();
            // we should verify that the file is here and if not, we recompile
            // (case where the temp has been cleaned, see bug #6062 on berlios.de)
            if (!file_exists($f)) {
                jIncluder::inc($s);
            }
            else
                require($f);
        }
        return;
    }else{
        $f = JELIX_LIB_UTILS_PATH.$class.'.class.php';
    }

    if(file_exists($f)){
        require($f);
    }
}

spl_autoload_register("jelix_autoload");
