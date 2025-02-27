<?php
/**
* @package     jelix
* @subpackage  jtpl
* @author      Laurent Jouanneau
* @contributor Mathaud Loic (standalone version), Dominique Papin
* @copyright   2005-2008 Laurent Jouanneau
* @copyright   2006 Mathaud Loic, 2007 Dominique Papin
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/

/**
 * This is the compiler of templates: it converts a template into a php file.
 * @package     jelix
 * @subpackage  jtpl
 */
class jTplCompiler
    implements jISimpleCompiler {
    private $_literals;

    private  $_vartype = array(T_CHARACTER, T_CONSTANT_ENCAPSED_STRING, T_DNUMBER,
            T_ENCAPSED_AND_WHITESPACE, T_LNUMBER, T_OBJECT_OPERATOR, T_STRING,
            T_WHITESPACE, T_ARRAY);

    private  $_assignOp = array(T_AND_EQUAL, T_DIV_EQUAL, T_MINUS_EQUAL,
            T_MOD_EQUAL, T_MUL_EQUAL, T_OR_EQUAL, T_PLUS_EQUAL, T_PLUS_EQUAL,
            T_SL_EQUAL, T_SR_EQUAL, T_XOR_EQUAL);

    private  $_op = array(T_BOOLEAN_AND, T_BOOLEAN_OR, T_EMPTY, T_INC, T_DEC,
            T_ISSET, T_IS_EQUAL, T_IS_GREATER_OR_EQUAL, T_IS_IDENTICAL,
            T_IS_NOT_EQUAL, T_IS_NOT_IDENTICAL, T_IS_SMALLER_OR_EQUAL,
            T_LOGICAL_AND, T_LOGICAL_OR, T_LOGICAL_XOR, T_SR, T_SL,
            T_DOUBLE_ARROW);

    private $_inLocaleOk = array(T_STRING, T_ABSTRACT, T_AS, T_BREAK, T_CASE,
            T_CATCH, T_CLASS, T_CLONE, T_CONST, T_CONTINUE, T_DECLARE, T_DEFAULT,
            T_DO, T_ECHO, T_ELSE, T_ELSEIF, T_EMPTY, T_EXIT, T_FINAL, T_FOR,
            T_FOREACH, T_FUNCTION, T_GLOBAL, T_IF, T_IMPLEMENTS, T_INSTANCEOF,
            T_INTERFACE, T_LIST, T_LOGICAL_AND, T_LOGICAL_OR, T_LOGICAL_XOR,
            T_NEW, T_PRIVATE, T_PUBLIC, T_PROTECTED, T_RETURN, T_STATIC,
            T_SWITCH, T_THROW, T_TRY, T_USE, T_VAR, T_WHILE, T_DNUMBER,
            T_LNUMBER, T_EVAL);

    protected $_allowedInVar;
    protected $_allowedInExpr;
    protected $_allowedAssign;
    protected $_allowedInForeach;
    protected $_excludedInVar = array(';','=');

    protected $_allowedConstants = array('TRUE','FALSE','NULL', 'M_1_PI',
            'M_2_PI', 'M_2_SQRTPI', 'M_E', 'M_LN10', 'M_LN2', 'M_LOG10E',
            'M_LOG2E', 'M_PI','M_PI_2','M_PI_4','M_SQRT1_2','M_SQRT2');

    private $_pluginPath=array();
    private $_metaBody = '';

    protected $_modifier = array('upper'=>'strtoupper', 'lower'=>'strtolower',
            'escxml'=>'htmlspecialchars', 'eschtml'=>'htmlspecialchars',
            'strip_tags'=>'strip_tags', 'escurl'=>'rawurlencode',
            'capitalize'=>'ucwords', 'stripslashes'=>'stripslashes');

    private $_blockStack=array();

    private $_sourceFile;
    private $_currentTag;
    public $outputType='';
    public $trusted=true;

    protected $_userFunctions = array();

    /**
     * Initialize some properties
     */
    function __construct(){
        $this->_allowedInVar = array_merge($this->_vartype, array(T_INC, T_DEC, T_DOUBLE_ARROW));
        $this->_allowedInExpr = array_merge($this->_vartype, $this->_op);
        $this->_allowedAssign = array_merge($this->_vartype, $this->_assignOp, $this->_op);
        $this->_allowedInForeach = array_merge($this->_vartype, array(T_AS, T_DOUBLE_ARROW));

    }


    /**
     * Launch the compilation of a template
     *
     * Store the result (a php content) into a cache file given by the selector.
     * @param jSelectorTpl $selector the template selector
     * @return boolean true if ok
     */
    public function compile($selector){
        $this->_sourceFile = $selector->getPath();
        $cachefile = $selector->getCompiledFilePath();
        $this->outputType = $selector->outputType;
        $this->trusted = $selector->trusted;
        $this->_modifier = array_merge($this->_modifier, $selector->userModifiers);
        $this->_userFunctions = $selector->userFunctions;

        jContext::push($selector->module);

        if(!file_exists($this->_sourceFile)){
            $this->doError0('errors.tpl.not.found');
        }

        $result = $this->compileContent(file_get_contents ($this->_sourceFile));

        $header ="<?php \n";
        foreach($this->_pluginPath as $path=>$ok){
            $header.=' require_once(\''.$path."');\n";
        }
        $header.='function template_meta_'.md5($selector->module.'_'.$selector->resource.'_'.$this->outputType.($this->trusted?'_t':'')).'($t){';
        $header .="\n".$this->_metaBody."\n}\n";

        $header.='function template_'.md5($selector->module.'_'.$selector->resource.'_'.$this->outputType.($this->trusted?'_t':'')).'($t){'."\n?>";
        $result = $header.$result."<?php \n}\n?>";

        jFile::write($cachefile, $result);

        jContext::pop();
        return true;
    }

    protected function compileContent($tplcontent){
        // we remove all php tags 
        $tplcontent = preg_replace("!<\?(.*?)\?>!s", '', $tplcontent);
        // we remove all template comments
        $tplcontent = preg_replace("!{\*(.*?)\*}!s", '', $tplcontent);

        preg_match_all("!{literal}(.*?){/literal}!s", $tplcontent, $_match);

        $this->_literals = $_match[1];

        $tplcontent = preg_replace("!{literal}(.*?){/literal}!s", '{literal}', $tplcontent);

        $tplcontent = preg_replace_callback("/{((.).*?)}/sm", array($this,'_callback'), $tplcontent);

        $tplcontent = preg_replace('/\?>\n?<\?php/', '', $tplcontent);
        $tplcontent = preg_replace('/<\?php\\s+\?>/', '', $tplcontent);

        if(count($this->_blockStack))
            $this->doError1('errors.tpl.tag.block.end.missing', end($this->_blockStack));

        return $tplcontent;
    }

    /**
     * function called during the parsing of the template by a preg_replace_callback function
     * It is called on each template tag {xxxx }
     * @param array $matches a matched item
     * @return string the corresponding php code of the tag (with php tag).
     */
    public function _callback($matches){
        list(,$tag, $firstcar) = $matches;

        // check the first character
        if (!preg_match('/^\$|@|=|[a-zA-Z\/]$/',$firstcar)) {
            throw new jException('jelix~errors.tpl.tag.syntax.invalid',array($tag,$this->_sourceFile));
        }
        $this->_currentTag = $tag;
        if ($firstcar == '=') {
            return  '<?php echo '.$this->_parseVariable(substr($tag,1)).'; ?>';
        } else if ($firstcar == '$' || $firstcar == '@') {
            return  '<?php echo '.$this->_parseVariable($tag).'; ?>';
        } else {
            if (!preg_match('/^(\/?[a-zA-Z0-9_]+)(?:(?:\s+(.*))|(?:\((.*)\)))?$/ms',$tag,$m)) {
                throw new jException('jelix~errors.tpl.tag.function.invalid',array($tag,$this->_sourceFile));
            }
            if(count($m) == 4){
                $m[2] = $m[3];
            }
            if(!isset($m[2])) $m[2]='';
            if($m[1] == 'ldelim') return '{';
            if($m[1] == 'rdelim') return '}';
            return '<?php '.$this->_parseFunction($m[1],$m[2]).'?>';
        }
    }

    /**
    * analyse an "echo" tag : {$..} or {@..}
    * @param string $expr the content of the tag
    * @return string the corresponding php instruction
    */
    protected function _parseVariable($expr){
        $tok = explode('|',$expr);
        $res = $this->_parseFinal(array_shift($tok),$this->_allowedInVar, $this->_excludedInVar);

        foreach($tok as $modifier){
            if(!preg_match('/^(\w+)(?:\:(.*))?$/',$modifier,$m)){
                $this->doError2('errors.tpl.tag.modifier.invalid',$this->_currentTag, $modifier);
            }

            if(isset($m[2])){
                $targs = $this->_parseFinal($m[2],$this->_allowedInVar, $this->_excludedInVar, true, ',',':');
                array_unshift($targs, $res);
            }else{
                $targs = array($res);
            }

            if( $path = $this->_getPlugin('cmodifier',$m[1])){
                require_once($path[0]);
                $fct = $path[1];
                $res = $fct($this,$targs);

            } else if( $path = $this->_getPlugin('modifier',$m[1])){
                $res = $path[1].'('.implode(',',$targs).')';
                $this->_pluginPath[$path[0]] = true;

            } else {
                if(isset($this->_modifier[$m[1]])){
                    $res = $this->_modifier[$m[1]].'('.$res.')';
                } else {
                    $this->doError2('errors.tpl.tag.modifier.unknow',$this->_currentTag, $m[1]);
                }
            }
        }
        return $res;
    }

    /**
     * analyse the tag which have a name
     * @param string $name the name of the tag
     * @param string $args the content that follow the name in the tag
     * @return string the corresponding php instructions
     */
    protected function _parseFunction($name,$args){
        $res='';
        switch($name) {
            case 'if':
                $res = 'if('.$this->_parseFinal($args,$this->_allowedInExpr).'):';
                array_push($this->_blockStack,'if');
                break;
            case 'else':
                if (substr(end($this->_blockStack),0,2) !='if') {
                    $this->doError1('errors.tpl.tag.block.end.missing', end($this->_blockStack));
                }else
                    $res = 'else:';
                break;
            case 'elseif':
                if (end($this->_blockStack) !='if') {
                    $this->doError1('errors.tpl.tag.block.end.missing', end($this->_blockStack));
                }else
                    $res = 'elseif('.$this->_parseFinal($args,$this->_allowedInExpr).'):';
                break;
            case 'foreach':
                $res = 'foreach('.$this->_parseFinal($args,$this->_allowedInForeach, array(';','!','(')).'):';
                array_push($this->_blockStack,'foreach');
                break;
            case 'while':
                $res = 'while('.$this->_parseFinal($args,$this->_allowedInExpr).'):';
                array_push($this->_blockStack,'while');
                break;
            case 'for':
                if($this->trusted)
                    $notallowed = array();
                else
                    $notallowed = array('(');
                if(preg_match("/^\s*\((.*)\)\s*$/",$args, $m))
                   $args = $m[1];
                $res = 'for('. $this->_parseFinal($args, $this->_allowedInExpr, $notallowed) .'):';
                array_push($this->_blockStack,'for');
                break;

            case '/foreach':
            case '/for':
            case '/if':
            case '/while':
                $short = substr($name,1);
                if (end($this->_blockStack) !=$short) {
                    $this->doError1('errors.tpl.tag.block.end.missing', end($this->_blockStack));
                 }else{
                    array_pop($this->_blockStack);
                    $res='end'.$short.';';
                 }
                break;

            case 'assign':
            case 'eval':
                $res = $this->_parseFinal($args,$this->_allowedAssign).';';
                break;
            case 'literal':
                if (count($this->_literals)) {
                    $res = '?>'.array_shift($this->_literals).'<?php ';
                } else {
                    $this->doError1('errors.tpl.tag.block.end.missing','literal');
                }
                break;
            case '/literal':
                $this->doError1('errors.tpl.tag.block.begin.missing','literal');
                break;
            case 'meta':
                $this->_parseMeta($args);
                $res='';
                break;
            default:
                if (preg_match('!^/(\w+)$!',$name,$m)) {
                    if (end($this->_blockStack) !=$m[1]) {
                        $this->doError1('errors.tpl.tag.block.end.missing',end($this->_blockStack));
                    }else{
                        array_pop($this->_blockStack);
                        if(function_exists($fct = 'jtpl_block_'.$this->outputType.'_'.$m[1])){
                            $res = $fct($this,false,null);
                        }else if(function_exists($fct = 'jtpl_block_common_'.$m[1])){
                            $res = $fct($this,false,null);
                        }else
                            $this->doError1('errors.tpl.tag.block.begin.missing',$m[1]);
                    }
                } else if(preg_match('/^meta_(\w+)$/',$name,$m)) {
                     if ($path = $this->_getPlugin('meta',$m[1])) {
                        $this->_parseMeta($args,$path[1]);
                        $this->_pluginPath[$path[0]] = true;
                    }else{
                        $this->doError1('errors.tpl.tag.meta.unknow',$m[1]);
                    }
                    $res='';

                } else if ( $path = $this->_getPlugin('block',$name)) {
                    require_once($path[0]);
                    $argfct=$this->_parseFinal($args,$this->_allowedAssign, array(';'),true);
                    $fct = $path[1];
                    $res = $fct($this,true,$argfct);
                    array_push($this->_blockStack,$name);

                } else if ( $path = $this->_getPlugin('cfunction',$name)) {
                    require_once($path[0]);
                    $argfct=$this->_parseFinal($args,$this->_allowedAssign, array(';'),true);
                    $fct = $path[1];
                    $res = $fct($this,$argfct);

                } else if ( $path = $this->_getPlugin('function',$name)) {
                    $argfct=$this->_parseFinal($args,$this->_allowedAssign);
                    $res = $path[1].'( $t'.(trim($argfct)!=''?','.$argfct:'').');';
                    $this->_pluginPath[$path[0]] = true;

                } else if ( isset($this->_userFunctions[$name])) {
                    $argfct=$this->_parseFinal($args,$this->_allowedAssign);
                    $res = $this->_userFunctions[$name].'( $t'.(trim($argfct)!=''?','.$argfct:'').');';

                } else {
                    $this->doError1('errors.tpl.tag.function.unknow',$name);
                }
        }
        return $res;
    }

    /**
     * for plugins, it says if the plugin is inside the given block
     * @param string $blockName the block to search
     * @param boolean $onlyUpper check only the upper block
     * @return boolean  true if it is inside the block
     */
    public function isInsideBlock($blockName, $onlyUpper=false) {
        if($onlyUpper)
            return (end($this->_blockStack) == $blockName);
        for($i=count($this->_blockStack) -1; $i>=0; $i--) {
            if($this->_blockStack[$i] == $blockName)
                return true;
        }
        return false;
    }

    /**
     * sub-function which analyse an expression
     * @param string $string the expression
     * @param array $allowed list of allowed php token
     * @param array $exceptchar list of forbidden characters
     * @param boolean $splitArgIntoArray true: split the results on coma
     * @return array|string
     */
    protected function _parseFinal($string, $allowed=array(), $exceptchar=array(';'), $splitArgIntoArray=false, $sep1=',', $sep2=','){
        $tokens = token_get_all('<?php '.$string.'?>');

        $results=array();
        $result ='';
        $first = true;
        $inLocale = false;
        $locale='';
        $bracketcount = $sqbracketcount = 0;
        $firstok = array_shift($tokens);

        // il y a un bug, parfois le premier token n'est pas T_OPEN_TAG...
        if ($firstok== '<' && $tokens[0] == '?' && is_array($tokens[1])
            && $tokens[1][0] == T_STRING && $tokens[1][1] == 'php') {
            array_shift($tokens);
            array_shift($tokens);
        }

        $previousTok=null;

        foreach($tokens as $tok) {
            if (is_array($tok)) {
                list($type,$str)= $tok;
                $first=false;
                if ($type== T_CLOSE_TAG) {
                    $previousTok = $tok;
                    continue;
                }
                if($inLocale && in_array($type,$this->_inLocaleOk)){
                    $locale.=$str;
                }elseif($type == T_VARIABLE && $inLocale){
                    $locale.='\'.$t->_vars[\''.substr($str,1).'\'].\'';
                }elseif($type == T_VARIABLE){
                    if(is_array($previousTok) && $previousTok[0] == T_OBJECT_OPERATOR)
                        $result.='{$t->_vars[\''.substr($str,1).'\']}';
                    else
                        $result.='$t->_vars[\''.substr($str,1).'\']';
                }elseif($type == T_WHITESPACE || in_array($type, $allowed)){
                    if(!$this->trusted && $type == T_STRING && defined($str) && !in_array(strtoupper($str),$this->_allowedConstants)){
                        $this->doError2('errors.tpl.tag.constant.notallowed', $this->_currentTag, $str);
                    }
                    if($type == T_WHITESPACE)
                        $str = preg_replace("/(\s+)/ms"," ",$str);
                    $result.=$str;
                }else{
                    $this->doError2('errors.tpl.tag.phpsyntax.invalid', $this->_currentTag, $str);
                }
            } else {
                if ($tok == '@') {
                    if ($inLocale) {
                        $inLocale = false;
                        if ($locale=='') {
                            $this->doError1('errors.tpl.tag.locale.invalid', $this->_currentTag);
                        } else {
                            $result.='jLocale::get(\''.$locale.'\')';
                            $locale='';
                        }
                    } else {
                        $inLocale=true;
                    }
                } elseif ($inLocale && ($tok=='.' || $tok =='~') ) {
                    $locale.=$tok;
                } elseif ($inLocale || in_array($tok,$exceptchar) || ($first && $tok != '!' && $tok != '(')) {
                    $this->doError2('errors.tpl.tag.character.invalid', $this->_currentTag, $tok);
                } elseif ($tok =='(') {
                    $bracketcount++;$result.=$tok;
                } elseif ($tok ==')') {
                    $bracketcount--;$result.=$tok;
                } elseif ($tok =='[') {
                    $sqbracketcount++;$result.=$tok;
                } elseif ($tok ==']') {
                    $sqbracketcount--;$result.=$tok;
                } elseif( $splitArgIntoArray && ($tok == $sep1 || $tok == $sep2) && $bracketcount==0 && $sqbracketcount==0){
                   $results[]=$result;
                   $result='';
                } else {
                    $result.=$tok;
                }
                $first=false;
            }
            $previousTok = $tok;
        }

        if ($inLocale) {
            $this->doError1('errors.tpl.tag.locale.end.missing', $this->_currentTag);
        }

        if ($bracketcount != 0 || $sqbracketcount !=0) {
            $this->doError1('errors.tpl.tag.bracket.error', $this->_currentTag);
        }

        if( $splitArgIntoArray){
            if($result !='') $results[]=$result;
            return $results;
        }else{
            return $result;
        }
    }

    protected function _parseMeta($args, $fct=''){
        if(preg_match("/^(\w+)\s+(.*)$/",$args,$m)){
            $argfct=$this->_parseFinal($m[2],$this->_allowedInExpr);
            if($fct!=''){
                $this->_metaBody.= $fct.'( $t,'."'".$m[1]."',".$argfct.");\n";
            }else{
                $this->_metaBody.= "\$t->_meta['".$m[1]."']=".$argfct.";\n";
            }
        }else{
            $this->doError1('errors.tpl.tag.meta.invalid', $this->_currentTag);
        }
    }

    public function addMetaContent($content){
        $this->_metaBody.= $content."\n";
    }

    /**
     * try to find a plugin
     * @param string $type type of plugin (function, modifier...)
     * @param string $name the plugin name
     * @return array|boolean an array containing the path of the plugin
     *                      and the name of the plugin function, or false if not found
     */
    protected function _getPlugin($type, $name){
        $foundPath='';

        global $gJConfig;
        if(isset($gJConfig->{'_tplpluginsPathList_'.$this->outputType})){
            foreach($gJConfig->{'_tplpluginsPathList_'.$this->outputType} as $path){
                $foundPath=$path.$type.'.'.$name.'.php';

                if(file_exists($foundPath)){
                    return array($foundPath, 'jtpl_'.$type.'_'.$this->outputType.'_'.$name);
                }
            }
        }
        if(isset($gJConfig->_tplpluginsPathList_common)){
            foreach($gJConfig->_tplpluginsPathList_common as $path){
                $foundPath=$path.$type.'.'.$name.'.php';
                if(file_exists($foundPath)){
                    return array($foundPath, 'jtpl_'.$type.'_common_'.$name) ;
                }
            }
        }
        return false;
    }

    public function doError0($err){
        throw new jException('jelix~'.$err,array($this->_sourceFile));
    }

    public function doError1($err, $arg){
        throw new jException('jelix~'.$err,array($arg, $this->_sourceFile));
    }

    public function doError2($err, $arg1, $arg2){
        throw new jException('jelix~'.$err,array($arg1, $arg2, $this->_sourceFile));
    }

}
