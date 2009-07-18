<?php

class CakesController extends ModelInfoAppController{
    var $name = 'Cakes';
    var $uses = false;
    var $components = array('Parse');
    var $helpers = array('Html','Form','Javascript');

    /**
     * index
     * description
     *
     * @params
     * @return
     */
    function index(){
        $actions = $this->Parse->getControllerAndAction();
        $models = $this->Parse->getModel();
    }

    /**
     * er
     * CakePHP Model ER
     *
     * @params
     * @return
     */
    function er(){
        $models = $this->Parse->getModel();
        $this->set('models', $models);
    }


  }
?>