<?php
/**
* @package     jelix
* @subpackage  core_response
* @author      Laurent Jouanneau
* @contributor Nicolas Lassalle <nicolas@beroot.org> (ticket #188)
* @copyright   2005-2007 Laurent Jouanneau
* @copyright   2007 Nicolas Lassalle
* @link        http://www.jelix.org
* @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/


/**
* Response use to send a binary file to the browser
* @package  jelix
* @subpackage core_response
*/

final class jResponseBinary  extends jResponse {
    /**
    * @var string
    */
    protected $_type = 'binary';

    /**
     * The path of the file you want to send. Keep empty if you provide the content
     * @var string
     */
    public $fileName ='';
    /**
     * name of the file under which the content will be send to the user
     * @var string
     */
    public $outputFileName ='';

    /**
     * the content you want to send. Keep empty if you indicate a filename
     * @var string
     */
    public $content = null;

    /**
     * Says if the "save as" dialog appear or not to the user.
     * if false, specify the mime type in $mimetype
     * @var boolean
     */
    public $doDownload = true;

    /**
    * The mimeType of the current binary file.
    * It will be sent in the header "Content-Type".
    * @var string
    */
    public $mimeType = 'application/octet-stream';

    /**
     * send the content or the file to the browser.
     * @return boolean    true it it's ok
     */
    public function output(){

        if($this->doDownload){
            $this->mimeType = 'application/forcedownload';
            if (!strlen($this->outputFileName)){
                $f = explode ('/', str_replace ('\\', '/', $this->fileName));
                $this->outputFileName = $f[count ($f)-1];
            }
        }

        if($this->hasErrors()) return false;

        $this->addHttpHeader("Content-Type",$this->mimeType, $this->doDownload);

        if($this->doDownload)
              $this->_downloadHeader();

        if($this->content === null){
            if (is_readable ($this->fileName) && is_file ($this->fileName)){
                $this->_httpHeaders['Content-Length']=filesize ($this->fileName);
                $this->sendHttpHeaders();
                readfile ($this->fileName);
                flush();
                return true;
            }else{
                throw new jException('jelix~errors.repbin.unknow.file' , $this->fileName);
                return false;
            }
        }else{
            $this->_httpHeaders['Content-Length']=strlen ($this->content);
            $this->sendHttpHeaders();
            echo $this->content;
            flush();
            return true;
        }
    }

    /**
     * set all headers to force download
     */
    protected function _downloadHeader(){
        $this->addHttpHeader('Content-Disposition','attachment; filename="'.$this->outputFileName.'"', false);
        $this->addHttpHeader('Content-Description','File Transfert', false);
        $this->addHttpHeader('Content-Transfer-Encoding','binary', false);
        $this->addHttpHeader('Pragma','public', false);
        $this->addHttpHeader('Cache-Control','maxage=3600', false);
        //$this->addHttpHeader('Cache-Control','no-store, no-cache, must-revalidate, post-check=0, pre-check=0', false);
        //$this->addHttpHeader('Expires','0', false);
    }

    /**
     *
     */
    public function outputErrors(){
        $this->clearHttpHeaders();
        $this->_httpStatusCode ='500';
        $this->_httpStatusMsg ='Internal Server Error';
        $this->_httpHeaders["Content-Type"]='text/plain';
        $this->sendHttpHeaders();
        if($this->hasErrors()){
            foreach( $GLOBALS['gJCoord']->errorMessages  as $e){
               echo '['.$e[0].' '.$e[1].'] '.$e[2]." \t".$e[3]." \t".$e[4]."\n";
            }
        }else{
            echo "[unknow error]\n";
        }
    }
}
