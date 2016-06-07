<?php

class Bitbull_SimpleOrder_Block_Customer_Account_Navigation extends Mage_Customer_Block_Account_Navigation {

    protected $_currentPosition = 0;


    public function getLinks()
    {
        if(count($this->_links)){
            $this->_links = Mage::helper('bitbull_simpleorder')->sortElementsByPosition($this->_links);
        }

        return parent::getLinks();
    }

    public function addLink($name, $path, $label, $urlParams = array(), $position = null)
    {
        if (!$position) {
            $this->_currentPosition += 10 + $this->_currentPosition;
            $position = $this->_currentPosition;
        }
        $this->_links[$name] = new Varien_Object(array(
            'name' => $name,
            'path' => $path,
            'label' => $label,
            'url' => $this->getUrl($path, $urlParams),
            'position' => $position
        ));
        return $this;
    }
}

?>
