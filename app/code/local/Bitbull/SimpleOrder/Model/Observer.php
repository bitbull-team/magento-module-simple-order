<?php
class Bitbull_SimpleOrder_Model_Observer extends Varien_Object{
    const FLAG_SHOW_LAYOUT 			= 'showLayout';
    const HTTP_HEADER_HTML			= 'Content-Type: text/html';


    private function init() {
        $this->setLayout(Mage::app()->getFrontController()->getAction()->getLayout());
        $this->setUpdate($this->getLayout()->getUpdate());
    }

    public function checkForLayoutDisplayRequest($observer) {
        $this->init();
        /** @var Mage_Core_Controller_Varien_Action $controllerAction */
        $controllerAction = $observer->getEvent()->getData('controller_action');
        if ($controllerAction->getRequest()->isDispatched()) {
            $is_set = array_key_exists(self::FLAG_SHOW_LAYOUT, $_GET);
            if($is_set && 'itemsOrder'    == $_GET[self::FLAG_SHOW_LAYOUT]) {
                $this->outputItemsHeadOrderLayout();
            }else if($is_set && 'linksOrder' == $_GET[self::FLAG_SHOW_LAYOUT]) {
                $this->outputLinksHeadOrderLayout();
            }
        }
    }

    private function outputHeaders() {
        $header		= self::HTTP_HEADER_HTML;
        header($header);
    }

    private function outputItemsHeadOrderLayout() {
        $layout = $this->getLayout();
        $this->outputHeaders();
        var_dump($layout->getBlock('head')->getItems());
        die();
    }

    private function outputLinksHeadOrderLayout() {
        $layout = $this->getLayout();
        $this->outputHeaders();
        var_dump( $layout->getBlock('customer_account_navigation')->getLinks());
        die();
    }

}