<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 15/05/16
 * Time: 8.22
 */
class Bitbull_SimpleOrder_Helper_Data extends Mage_Core_Helper_Abstract {

    public function sortElementsByPosition($elements){
        if( is_array(reset($elements))){
            usort($elements, array($this, 'cmpArrayPositions'));
        }elseif(is_object(reset($elements))){
            usort($elements, array($this, 'cmpObjectPositions'));
        }
        return $elements;
    }

    private function cmpArrayPositions($a,$b){
        return $a['position'] > $b['position'];
    }

    private function cmpObjectPositions($a,$b){
        return $a->position > $b->position;
    }


}