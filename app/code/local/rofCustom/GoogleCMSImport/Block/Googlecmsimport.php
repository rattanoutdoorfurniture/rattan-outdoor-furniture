<?php
class Rofcustom_Googlecmsimport_Block_Admin_Googlecmsimport extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('googlecmsimport/index.phtml');
    }

    /**
     * Retourne le model
     *
     * @return BusinessDecision_googlecmsimport_Model_googlecmsimport
     */
    public function getModel(){
        return Mage::getModel('googlecmsimport/googlecmsimport');
    }


    /**
     * Retourne la collection des slides
     *
     * @return array
     */
    public function getSlides(){
        return $this->getModel()->getSlides();
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