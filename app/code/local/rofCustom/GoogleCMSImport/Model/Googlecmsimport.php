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
}