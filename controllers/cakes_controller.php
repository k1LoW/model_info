<?php
  /**
   * CakePHP DB Schema / Model Info Plugin
   * Copyright (c) 2009 101000code/101000LAB
   * http://code.101000lab.org/
   * http://github.com/k1LoW/model_info
   * @author Kenichirou Oyama <k1lowxb@gmail.com>
   * @license MIT
   *
   */
class CakesController extends ModelInfoAppController{
    var $name = 'Cakes';
    var $uses = false;
    var $components = array('Parse');
    var $helpers = array('Html','Form','Javascript');

    /**
     * index
     * CakePHP Model ER
     *
     * @params
     * @return
     */
    function index(){
        $models = $this->Parse->getModel();
        $this->set('models', $models);
    }

    /**
     * dot
     * generate dot file
     *
     * @param
     * @return
     */
    function dot(){
        Configure::write('debug',0);
        $this->layout = false;
        $models = $this->Parse->getModel();
        $this->set('models', $models);
    }

    /**
     * generate
     * generate png file
     *
     * @param
     * @return
     */
    function generate(){
        $dot = $this->requestAction('/model_info/cakes/dot',array('return'));
        $file = fopen(TMP . 'cache/model.dot','w');
        fwrite($file, $dot);
        fclose($file);
        if (system('dot -Kdot -Tpng ' . TMP . 'cache/model.dot -o ' . TMP . 'cache/model.png') === false) {
            $this->Session->setFlash(__('Invalid generate. Please install Graphviz.', true));
        } else {
            rename(TMP . 'cache/model.png' , APP . 'webroot/file/model.png');
        }
    }

  }
?>