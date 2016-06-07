<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 15/05/16
 * Time: 14.58
 */
class Bitbull_SimpleOrder_Block_Page_Html_Head extends Mage_Page_Block_Html_Head {
    
    protected $_currentPosition = 0;
    

    public function addItem($type, $name, $params=null, $if=null, $cond=null,$position = null)
    {
        if(empty($if)){
            $if = null;
        }
        if(empty($cond)){
            $cond = null;
        }

        if (!$position) {
            $this->_currentPosition = 10 + $this->_currentPosition;
            $position = $this->_currentPosition;
        }
        if ($type==='skin_css' && empty($params)) {
            $params = 'media="all"';
        }
        $this->_data['items'][$type.'/'.$name] = array(
            'type'     => $type,
            'name'     => $name,
            'params'   => $params,
            'if'       => $if,
            'cond'     => $cond,
            'position' => $position
       );
        return $this;
    }

    public function getCssJsHtml(){
        $this->_data['items']= Mage::helper('bitbull_simpleorder')->sortElementsByPosition($this->_data['items']);
        return parent::getCssJsHtml();
    }

}