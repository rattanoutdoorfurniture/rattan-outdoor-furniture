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
    protected $_authCode     = null;
    protected $_request      = null;
    protected $_session      = null;
    protected $_authed       = false;
    protected $_authUrl      = null;
    protected $_authToken    = null;

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

    public function getRequest() {
        if(is_null($this->_request)) {
            $this->_request = Mage::getSingleton('core/app')->getRequest();
        }
        return $this->_request;
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
        if(is_null($this->_requestUri)) $this->_requestUri =(isset($_SERVER['HTTPS'])?"https://":"http://"). $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'];
        $this->_requestUri = strstr($this->_requestUri, "/key",true);
        return $this->_requestUri;
    }

    public function getClient() {
        if(is_null($this->_client)) {
            $this->_initClient();
        }
        return $this->_client;
    }

    protected function _initClient() {
        $this->_client = new Google_Client();
        $this->_client->setClientId($this->getClientId());
        $this->_client->setClientSecret($this->getClientSecret());
        $this->_client->addScope($this->getScope());
        $this->_client->setRedirectUri($this->getRequestUri());
    }

    public function getService() {
        if(is_null($this->_service)) {
            $this->_service = new Google_Service_Drive($this->getClient());
        }
        return $this->_service;
    }

    public function setAuthCode($authCode) {
        if(is_string($authCode)) {
            $this->_authCode = $authCode;
        }
        return $this;
    }

    public function getAuthCode() {
        if(is_null($this->_authCode)) {
            $this->_authCode = $this->getRequest()->getParam("code");
        }
        return $this->_authCode;
    }

    public function authCodeSet() {
        return !is_null($this->getAuthCode());
    }

    protected function updatePathArray(&$arr, $path, $val = null) {
        $layers = preg_split("/\/",$path);
        $layers = array_reverse($layers);
        $tree   = "[".implode("][",$layers)."]";
        ${"arr".$tree} = $val;
    }

    protected function _setSesssion($path, $val) {
        $curSession = $this->getSession();
        $this->updatePathArry($curSession,$path,$val);
        Mage::getSingleton("adminhtml/session")->setGoogleImport($curSession);
    }

    public function setSession($path, $val) {
        $this->_setSesssion($path, $val);
        $this->updateSession();
        return $this;
    }

    public function updateSession() {
        $this->getSession('',true);
    }

    public function getSession($path='',$force=FALSE) {
        if(is_null($this->_session)||$force) {
            $this->_session = Mage::getSingleton("adminhtml/session")->getGoogleImport($path);
        }
        return $this->_session;
    }

    public function setAuthToken($token = null) {
        $this->_authToken = !is_null($token) ? $token : $this->client->getAccessToken();
        $this->setSession("auth/access_token", $this->_authToken);
        return $this;
    }

    public function getAuthToken($force=false) {
        if(is_null($this->_authToken)||$force) {
            $this->_authToken = $this->getSession("auth/access_token");
            if(!$this->_authToken || strlen($this->_authToken)<5){
                $this->setAuthToken();
            }
        }
        return $this->_authToken;
    }

    public function setAuthUrl($url=null) {
        $this->_authUrl = !is_null($url) ? $url : $this->client->createAuthUrl();
    }

    public function getAuthUrl() {
        if(is_null($this->_authUrl)) {
            $this->_authUrl = $this->client->createAuthUrl();
        }
        return $this->_authUrl;
    }

    public function setAuthed($authed) {
        $this->_authed = ($authed===true);
    }

    public function getAuthed() {
        return ($this->_authed===true);
    }

    public function doAuth() {
        if($this->authCodeSet()) {
            $this->getClient()->authenticate($this->authCode);
            $this->setAuthToken();
            header('Location: ' . filter_var($this->requestUri, FILTER_SANITIZE_URL));
        }
        $accessToken = $this->session('auth/access');
        if(strlen($accessToken)>5&&$accessToken) {
            $this->client->setAccessToken($accessToken);
            $this->setAuthed(true);
        } else {
            $this->setAuthUrl();
            $this->setAuthed(false);
        }
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