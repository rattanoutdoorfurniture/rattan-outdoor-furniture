<?php
class Locations_States_Block_List
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{

    /**
     * Internal constructor
     *
     */
    protected function _construct()
    {
        $this->setTemplate('states/state-list.phtml');
        parent::_construct();
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
                $this->_state = "Not Available";
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
            if ($this->getData('title')) {
                $this->_title = $this->getData('title');
            } else {
                $this->_title = $this->getState();
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
        if (!$this->_cities) {
            $this->_cities = $this->_getLocationPages($this->getState());
        }

        return $this->_cities;
    }

    protected function _getLocationPages($state = null) {
        // if(is_null($state)) $state = $this->getState(); // was going to make it default to the current state, but all should be an option if null
        $cmsPages = Mage::getModel('cms/page')->getCollection(); // ->toOptionArray() will give array of values
        $cmsPages->getSelect()->where("identifier LIKE ?", is_null($state) ? "locations/%" : "locations/$state/%");
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