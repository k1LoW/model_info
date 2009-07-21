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

    /**
     * dot
     * dot
     *
     * @param
     * @return
     */
    function dot(){
        Configure::write('debug',0);
        $this->layout = false;
        $models = $this->Parse->getModel();
        //print_a($models);
        $this->set('models', $models);
    }

    /**
     * generate
     * 
     *
     * @param
     * @return
     */
    function generate(){
        $dot = $this->requestAction('/model_info/cakes/dot',array('return'));
        $file = fopen(TMP . 'cache/model.dot','w');
        fwrite($file, $dot);
        fclose($file);
        system('dot -Kdot -Tpng ' . TMP . 'cache/model.dot -o ' . TMP . 'cache/model.png');
        rename(TMP . 'cache/model.png' , APP . 'webroot/file/model.png');
    }

  }
?>