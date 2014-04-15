<?php

require_once 'Google/Client.php';
require_once 'Google/Service/Drive.php';
require_once 'Google/Http/Request.php';

Class Rofcustom_Googlecmsimport_Model_Googlecmsimport {

    protected $_clientId     = null;
    protected $_clientSecret = null;
    protected $_client       = null;
    protected $_scope        = array("https://www.googleapis.com/auth/drive");
    protected $_requestUri   = null;
    protected $_service      = null;
    protected $_authCode     = null;
    protected $_request      = null;
    protected $_session      = array();
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
        if(is_null($this->_requestUri) || strlen($this->_requestUri)==0) {
            $uriOrg = "http" . (isset($_SERVER['HTTPS'])?"s":""). "://" . $_SERVER["HTTP_HOST"] . $_SERVER['REQUEST_URI'];
            $uriArr = parse_url($uriOrg);
            unset(
                $uriArr['user'],
                $uriArr['pass'],
                $uriArr['query'],
                $uriArr['fragment']
            );
            array_splice($uriArr,1,0,"://");
            $uri    = implode("",$uriArr);
            $this->_requestUri = rtrim($uri,"/");
        }
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
        return !(is_null($this->getAuthCode()) || (strlen($this->_authCode)==0));
    }

    public function updatePathArray($arr, $path, $val = null) {
        $arr[$path] = $val;
        return $arr;
    }

    protected function _setSesssion($path, $val) {
        $curSession = $this->getSession();
        $curSession = $this->updatePathArray($curSession,$path,$val);
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
        if(empty($this->_session)||$force) {
            $this->_session = Mage::getSingleton("adminhtml/session")->getGoogleImport();
        }
        return strlen($path) ? $this->_session[$path] : $this->_session;
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
        return $this;
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

    public function checkLogout($logout=null) {
        $logout_flag = is_bool($logout) ? $logout : !is_null($this->getRequest()->getParam("logout"));
        if($logout_flag) {
            $this->setSession('auth/access_token','');
        }
    }

    public function doAuth() {
        if($this->authCodeSet()) {
            try {
                $this->getClient()->authenticate($this->getAuthCode());
                $this->setAuthToken();
            } catch(Google_Auth_Exception $gaex) {
                $msg = $gaex->getMessage();
                if(strpos($msg,"invalid_grant")===false){
                    return $this->setAuthUrl()->doAuth();
                }
            }
            header('Location: ' . filter_var($this->getRequestUri(), FILTER_SANITIZE_URL));
        }
        $this->checkLogout();
        $accessToken = $this->getSession('auth/access_token');
        if(strlen($accessToken)>5&&$accessToken) {
            $this->client->setAccessToken($accessToken);
            $this->setAuthed(true);
        } else {
            $this->setAuthUrl();
            $this->setAuthed(false);
        }
    }

    /**
     * Download a file's content.
     *
     * @param Google_DriveService $service Drive API service instance.
     * @param File $file Drive File instance.
     * @return String The file's content if successful, null otherwise.
     */
    function downloadFile($downloadUrl) {
        //$downloadUrl = $file->getDownloadUrl();
        if ($downloadUrl) {
            $request = new Google_Http_Request($downloadUrl, 'GET', null, null);
            $httpRequest = $this->getClient()->getAuth()->authenticatedRequest($request);
            if ($httpRequest->getResponseHttpCode() == 200) {
                return $httpRequest->getResponseBody();
            } else {
                // An error occurred.
                return null;
            }
        } else {
            // The file doesn't have any content stored on Drive.
            return null;
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

    public function cleanWord($line) {
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