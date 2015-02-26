<?php
class Locations_States_Block_List
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{

    protected $_cmsPage;

    /**
     * Internal constructor
     *
     */
    protected function _construct()
    {
        $this->_cmsPage = Mage::getSingleton("cms/page");
        if(!$this->getParent()) return false;
        if(count($this->getChildren())<1) return false;
        $this->setTemplate('locations/states/list.phtml');
        parent::_construct();
    }

    /**
     * @var bool $_showViewMoreLink Flag to determine whether to show the 'view more' link or not.
     */
    protected $_showViewMoreLink = false;

    public function showViewMoreLink() {
        return $this->_showViewMoreLink;
    }

    /**
     * Internal Parent CMS Page variable
     */
    protected $_parent;

    /**
     * Return the relative State
     * or retrieve such using passed page id.
     *
     * @return string
     */
    public function getParent() {
        if (!$this->_parent) {
            if ($this->getData('parent')) {
                $this->_parent = $this->getData('parent');
            } else {
                try {
                    $this->_parent = $this->_cmsPage->getIdentifier();
                } catch(Exception $e) {
                    $this->_parent = false;
                }
            }
        }
        return $this->_parent;
    }

    /**
     * Internal Title variable
     */
    protected $_title;

    /**
     * Return the relative Titile
     * or retrieve such parent page content heading.
     *
     * @return string
     */
    public function getTitle() {
        if (!$this->_title) {
            $this->_title = '';
            if ($this->getData('title')) {
                $this->_title = $this->getData('title');
            } else {
                try {
                    $this->_title = $this->_cmsPage->load($this->_parent,'identifier')->getContentHeading();
                } catch(Exception $e) {
                    $this->_title = ucwords(implode(" ",preg_split('/[\/\-]/',$this->_parent)));
                }
            }
        }

        return ucwords($this->_title);
    }

    /**
     * Internal Title variable
     */
    protected $_children;

    /**
     * Return an array of child title and link
     * for associated parent
     *
     * @return array
     */
    public function getChildren() {
        if (!$this->_children) {
            $this->_children = $this->_getPages($this->_parent);
        }
        return $this->_children;
    }

    protected function _getPages($state = null) {
        // if(is_null($state)) $state = $this->getState(); // was going to make it default to the current state, but all should be an option if null
        $cmsPages = $this->_cmsPage->getCollection(); // ->toOptionArray() will give array of values
        $cmsPages->getSelect()
            ->where("identifier LIKE ?", $this->_parent."/%")
            ->where("identifier NOT LIKE ?", $this->_parent."/%/%")
            ->where("is_active = 1");
        $subPages = $cmsPages->getData();
        $subPageTitles = array();
        foreach($subPages as $subPage) {
            $subPageTitles[] = $subPage['title'];
        }
        array_multisort($subPageTitles,SORT_ASC,SORT_STRING,$subPages);
        return $subPages;
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