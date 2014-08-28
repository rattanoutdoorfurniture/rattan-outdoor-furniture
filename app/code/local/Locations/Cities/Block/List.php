<?php
class Locations_Cities_Block_List
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{

    /**
     * Internal constructor
     *
     */
    protected function _construct()
    {
        if(!$this->getState()) return false;
        $this->setTemplate('locations/cities/list.phtml');
        parent::_construct();
    }

    protected $_titleValue = array(
        "alabama"	            => "Local Areas in",
        "alaska"	            => "Servicing Areas in",
        "arizona"	            => "Regional Cities in",
        "arkansas"	            => "Local Service Zones in",
        "california"	        => "Service Destinations in",
        "colorado"	            => "Cities in",
        "connecticut"	        => "Areas Serviced in",
        "delaware"	            => "Service Districts in",
        "district-of-columbia"	=> "Serving the",
        "florida"	            => "Regional Cities in",
        "georgia"	            => "Local Cities in",
        "hawaii"	            => "Servicing Areas of",
        "idaho"	                => "Regions Served in",
        "illinois"	            => "Local Areas of",
        "indiana"	            => "Destination Districts of",
        "iowa"	                => "Regions Serviced in",
        "kansas"	            => "Areas in",
        "kentucky"	            => "Surrounding Cities in",
        "louisiana"	            => "Destination Zones in",
        "maine"	                => "Local Areas in",
        "maryland"	            => "Areas Served in",
        "massachusetts"	        => "Cities Served in",
        "michigan"	            => "Local Cities Served in",
        "minnesota"	            => "Local Districts of",
        "mississippi"	        => "Servicing Local Cities in"
    );

    protected function _getTitleValue() {
        $state = $this->getState();
        if(array_key_exists($state,$this->_titleValue)) {
            return "Rattan Outdoor Furniture " . $this->_titleValue[$state] . " " . ucwords(str_replace("-", " ", $state));
        } else {
            return "Rattan Outdoor Furniture Local Areas in $state";
        }
    }


    /**
     * @var bool $_showViewMoreLink Flag to determine whether to show the 'view more' link or not.
     */
    protected $_showViewMoreLink = false;

    public function showViewMoreLink() {
        return $this->_showViewMoreLink;
    }

    protected $_pageIdentifier;

    public function getPageIdentifier() {
        if(!$this->_pageIdentifier) {
            $this->_pageIdentifier = Mage::getSingleton("cms/page")->getIdentifier();
        }
        return $this->_pageIdentifier;
    }

    /**
     * @var bool $_isState Internal boolean whether the current page is the state page
     */
    protected $_isState;

    public function isState() {
        if(!isset($this->_isState)) {
            $this->_isState = (basename(Mage::app()->getRequest()->getRequestString()) == $this->getState());
        }
        return $this->_isState;
    }

    /**
     * Internal State variable
     */
    protected $_state;

    /**
     * Return the relative State
     * or retrieve such using passed page id.
     *
     * @return string
     */
    public function getState() {
        if (!$this->_state) {
            $this->_state = '';
            if ($this->getData('state')) {
                $this->_state = $this->getData('state');
            } else {
                $identifier = Mage::getSingleton("cms/page")->getIdentifier();
                $idParts    = explode("/",$identifier);
                $pageLevel  = count($idParts);
                if($pageLevel < 2) return ($this->_state = false);
                $topDir  = array_shift($idParts);
                // die(var_dump($identifier, $idParts,$pageLevel,$topDir));
                if(strcasecmp($topDir,"locations")==0) {
                    $this->_state = array_shift($idParts);
                } else {
                    $this->_state = false;
                }
            }
        }

        return $this->_state;
    }

    /**
     * Internal Title variable
     */
    protected $_title;

    /**
     * Return the relative State
     * or retrieve such using passed page id.
     *
     * @return string
     */
    public function getTitle() {
        if (!$this->_title) {
            $this->_title = '';
            if (strlen($this->getData('title'))) {
                $this->_title = $this->getData('title');
            } else {
                $this->_title = $this->_getTitleValue();
            }
        }

        return ucwords($this->_title);
    }

    /**
     * Internal Title variable
     */
    protected $_cities;

    /**
     * Return an array of city's titles and link
     * for associated state
     *
     * @return array
     */
    public function getCities() {
//        if (!$this->_cities) {
//            $this->_cities = $this->_getLocationPages($this->getState());
//        }
//
//        return $this->_cities;
        return $this->getAllCities();
    }

    public function getAllCities() {
        if(!$this->_cities) {
            $this->_cities = array_merge(
                $this->getActiveCities(),
                $this->getInactiveCities()
            );
        }
        return $this->_cities;
    }

    public function getActiveCities() {
        return $this->_getLocationPages($this->getState(), 1);
    }

    public function getInactiveCities() {
        return $this->_getLocationPages($this->getState(), 0);
    }

    protected function _getLocationPages($state = null, $active = 1) {
        // if(is_null($state)) $state = $this->getState(); // was going to make it default to the current state, but all should be an option if null
        $cmsPages = Mage::getModel('cms/page')->getCollection(); // ->toOptionArray() will give array of values
        $cmsPages->getSelect()
            ->where("identifier LIKE ?", is_null($state) ? "locations/%" : "locations/$state/%")
            ->where("is_active = ?", $active);
        return $cmsPages->getData();
    }



    /**
     * Produces HTML
     *
     * @return string
     */
//    protected function _toHtml() {
//        $cmsPages = Mage::getModel('cms/page')->getCollection(); // ->toOptionArray() will give array of values
//        $cmsPages->getSelect()->where("identifier LIKE ?", "locations/%");
//        $html = var_export($cmsPages->toArray(), true);
//        $states = array(
//            'AL'=>'Alabama',
//            'AK'=>'Alaska',
//            'AZ'=>'Arizona',
//            'AR'=>'Arkansas',
//            'CA'=>'California',
//            'CO'=>'Colorado',
//            'CT'=>'Connecticut',
//            'DE'=>'Delaware',
//            'DC'=>'District of Columbia',
//            'FL'=>'Florida',
//            'GA'=>'Georgia',
//            'HI'=>'Hawaii',
//            'ID'=>'Idaho',
//            'IL'=>'Illinois',
//            'IN'=>'Indiana',
//            'IA'=>'Iowa',
//            'KS'=>'Kansas',
//            'KY'=>'Kentucky',
//            'LA'=>'Louisiana',
//            'ME'=>'Maine',
//            'MD'=>'Maryland',
//            'MA'=>'Massachusetts',
//            'MI'=>'Michigan',
//            'MN'=>'Minnesota',
//            'MS'=>'Mississippi',
//            'MO'=>'Missouri',
//            'MT'=>'Montana',
//            'NE'=>'Nebraska',
//            'NV'=>'Nevada',
//            'NH'=>'New Hampshire',
//            'NJ'=>'New Jersey',
//            'NM'=>'New Mexico',
//            'NY'=>'New York',
//            'NC'=>'North Carolina',
//            'ND'=>'North Dakota',
//            'OH'=>'Ohio',
//            'OK'=>'Oklahoma',
//            'OR'=>'Oregon',
//            'PA'=>'Pennsylvania',
//            'RI'=>'Rhode Island',
//            'SC'=>'South Carolina',
//            'SD'=>'South Dakota',
//            'TN'=>'Tennessee',
//            'TX'=>'Texas',
//            'UT'=>'Utah',
//            'VT'=>'Vermont',
//            'VA'=>'Virginia',
//            'WA'=>'Washington',
//            'WV'=>'West Virginia',
//            'WI'=>'Wisconsin',
//            'WY'=>'Wyoming',
//        );
//        $html = '';
//        foreach($states as $state) {
//            $dashState = str_replace(" ", "-", strtolower($state));
//            $htm  = "<$dashState translate=\"label\">" . "\n";
//            $htm .= "<value>$dashState</value>" . "\n";
//            $htm .= "<label>$state</label>" . "\n";
//            $htm .= "</$dashState>" . "\n";
//            $html.= htmlspecialchars($htm);
//        }
//        // $html = '...';
//        $pre  = "<script type='text/javascript'>" .
//                "(function($)" . '{' . "$('body').wrapInner('<pre>');" . '}' . ")(jQuery);" .
//                "</script>";
//        return $html . $pre;
//    }

}