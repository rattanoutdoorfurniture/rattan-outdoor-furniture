<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 4/2/14
 * Time: 7:40 PM
 */

class Rofcustom_Googlecmsimport_Block_Import extends Mage_Core_Block_Template {

    protected $_model = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('googlecmsimport/import.phtml');
    }

    public function __get($name) {
        $methodName = "get".ucfirst($name);
        if(method_exists($this,$methodName)) return $this->$methodName();
        if(method_exists($this->getModel(), $name)) return $this->getModel()->$name;
        if(method_exists($this->getModel(), $methodName)) return $this->getModel()->$methodName;
        throw new Exception("Neither Google Import Block nor Model supports the $methodName() method.");
    }

    protected function _prepareLayout() {
        $this->getLayout()->getBlock('head')->addJs('googlecmsimport/googlecmsimport.js');
        parent::_prepareLayout();
    }

    protected function getErrorArr(Exception $e) {
        return array(
            "error" => array(
                "message"   => $e->getMessage(),
                "code"      => $e->getCode(),
                "file"      => $e->getFile(),
                "line"      => $e->getLine(),
                "trace"     => $e->getTraceAsString()
            )
        );
    }

    /**
     * Return the model
     *
     * @return Rofcustom_Googlecmsimport_Model_Googlecmsimport
     */
    public function getModel(){
        if(is_null($this->_model)) {
            $this->_model = Mage::getSingleton('googlecmsimport/googlecmsimport');
        }
        return $this->_model;
    }


    /**
     * Return the Client ID
     *
     * @return string
     */
    public function getClientId() {
        $retval = null;
        try {
            $retval = $this->getModel()->getClientId();
        } catch(Exception $e) {
            $retval = $this->getErrorArr($e);
        }
        return $retval;
    }

    public function getClientSecret() {
        $retval = null;
        try {
            $retval = $this->getModel()->getClientSecret();
        } catch(Exception $e) {
            $retval = $this->getErrorArr($e);
        }
        return $retval;
    }

    public function getRequestUri() {
        return $this->getModel()->getRequestUri();
        $retval = null;
        try {

        } catch(Exception $e) {
            $retval = $this->getErrorArr($e);
        }
        return $retval;
    }

    public function getAuthed() {
        return $this->getModel()->getAuthed();
    }

    public function getAuthUrl() {
        return $this->getModel()->getAuthUrl();
    }



    /**
     * Code d'ajout du fichier Js de l'Interakting Slider
     *
     * @return code HTML
     */
    public function addJs(){
        return '<script type="text/javascript" src="'.Mage::getBaseUrl('js').'googlecmsimport/googlecmsimport.js"></script>';

    }

    /**
     * Chargement et lancement du JS de l'Interakting slider
     *
     * @return unknown
     */
    public function startJs(){


        $vs_Js = "

			var googlecmsimport = new Googlecmsimport();

			googlecmsimport.setDelay(".$this->getModel()->getDelay().");
			googlecmsimport.setTransition('".$this->getModel()->getTransition()."');
			googlecmsimport.setSpeed(".$this->getModel()->getSpeed().");
			googlecmsimport.setMode('".$this->getModel()->getMode()."');

		";

        $va_Slides = $this->getSlides();

        if($va_Slides){
            foreach ($va_Slides as $vo_Slide){
                $vs_Js .= 'googlecmsimport.addSlide("'.$vo_Slide->getFormatedContent().'"); ';
            }
        }
        $vs_Js .= "
			googlecmsimport.show();
		";


        return $vs_Js;

    }



    /**
     * Retourne le style d'affichage défini pour le skin courant
     *
     * @return unknown
     */
    public function getSkinCss(){

        $vs_File =Mage::getBaseDir('skin').DS.'googlecmsimport'.DS.$this->getModel()->getSkin().'/style.css';

        try{
            $vs_Skin = file_get_contents($vs_File);
            $vs_Skin = str_replace("[[IMAGES_FOLDER]]", Mage::getBaseUrl('skin').'googlecmsimport/'.$this->getModel()->getSkin().'/images', $vs_Skin);
            /**
             * Réduction taille du code retourné
             */

            // suppression commentaires
            $vs_Skin = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $vs_Skin);

            // suppresion retour chariot et tabulation
            $vs_Skin = str_replace(array("\t","\n","\r"), '', $vs_Skin);
        }
        catch(Exception $e){
            $vs_Skin = "/*Skin file: $vs_File could not be read*/";
        }



        return trim($vs_Skin);
    }
}