<?php

require_once 'Google/Client.php';
require_once 'Google/Service/Drive.php';

Class Rofcustom_Googlecmsimport_Model_Googlecmsimport {

    protected $_clientId     = null;
    protected $_clientSecret = null;
    protected $_client       = null;
    protected $_scope        = array("https://www.googleapis.com/auth/drive");
    protected $_requestUri   = null;
    protected $_service      = null;

    public function __call($name, $args) {
        $methodName = "get".ucfirst($name);
        if(method_exists($this,$methodName)) return $this->$methodName($args);
        throw new Exception("Google Import Model does not support the $methodName() method.");
        return null;
    }

    public function __get($name) {
        if(isset($this->$name)) return $this->$name;
        $methodName = "get".ucfirst($name);
        if(method_exists($this,$methodName)) return $this->$methodName();
        throw new Exception("Google Import Model does not support the $methodName() method.");
        return null;
    }

    public function getClientId() {
        if(is_null($this->_clientId)) {
            $this->_clientId = Mage::getStoreConfig("googlecmsimport/config/client_id");
        }
        return $this->_clientId;
    }

    public function getClientSecret() {
        if(is_null($this->_clientSecret)) {
            $this->_clientSecret = Mage::getStoreConfig("googlecmsimport/config/client_secret");
        }
        return $this->_clientSecret;
    }

    public function setScope($scope) {
        if(is_array($scope)) {
            $this->_scope = $scope;
        } else {
            $this->_scope = array($scope);
        }
        return $this;
    }

    public function addScope($scope) {
        if(is_array($scope)) {
            $this->_scope = array_merge($this->_scope, $scope);
        } else {
            $this->_scope[] = $scope;
        }
        return $this;
    }

    public function getScope() {
        return $this->_scope;
    }

    public function setRequestUri($uri) {
        $this->_requestUri = $uri;
        return $this;
    }

    public function getRequestUri() {
        if(is_null($this->_requestUri)) $this->_requestUri = $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'];
        return $this->_requestUri;
    }

    public function getClient() {
        if(is_null($this->_client)) {
            $this->_initClient();
        }
        return $this->_client;
    }

    protected function _initClient() {
        $client = new Google_Client();
        $client->setClientId($this->clientId);
        $client->setClientSecret($this->clientSecret);
        $client->addScope($this->scope);
        $client->setRedirectUri($this->requestUri);
        $this->_client = $client;
    }

    public function getService() {
        if(is_null($this->_service)) {
            $this->_service = new Google_Service_Drive($this->client);
        }
        return $this->_service;
    }

    public function parseWord($userDoc)
    {
        $fileHandle = fopen($userDoc, "r");
        $line = @fread($fileHandle, filesize($userDoc));
        $lines = explode(chr(0x0D),$line);
        $outtext = "";
        foreach($lines as $thisline)
        {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE)||(strlen($thisline)==0))
            {
            } else {
                $outtext .= $thisline." ";
            }
        }
        $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
        return $outtext;
    }

    public function procText($text) {
        preg_match_all('/\(2\d{2}\)/', $text, $matches, PREG_OFFSET_CAPTURE);
        $code       = $matches[0][0][0];
        $pos        = $matches[0][0][1];
        $meta       = substr($text,$pos+strlen($code));
        $cont       = trim(substr($text,0,$pos));
        $metaArr    = preg_split('/\s\d\.?\d?\s?/', $meta); array_pop($metaArr);
        for($i=0;$i<count($metaArr);$i++) {
            $metaArr[$i]=ucwords($metaArr[$i]);
        }
        $retval     = array(
            "cont"  => $cont,
            "code"  => $code,
            "meta"  => array(
                "city"      => ucwords($metaArr[0]),
                "state"     => ucwords($metaArr[1]),
                "keywords"  => array_slice($metaArr,2)
            )
        );
        return $retval;
    }
}