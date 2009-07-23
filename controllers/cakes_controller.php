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
        $this->autoRender = false;
        $models = $this->Parse->getModel();
        $this->set('models', $models);
        header ("Content-disposition: attachment; filename = model_info.dot");
        header ("Content-type: text/plain; name = model_info.dot");
        $this->render();
    }

    /**
     * _dot
     * generate dot file
     *
     * @param
     * @return
     */
    function _dot(){
        Configure::write('debug',0);
        $this->autoRender = false;
        $models = $this->Parse->getModel();
        $dot = "graph G {
node [fontsize=12]";
        foreach ($models as $key => $model) {
            $dot .= "node" . $model['className'];
            $dot .= "[label=\"{<table>" . $model['className'];
            $dot .= "|<cols>";
            $first = true;
            foreach ($model['_schema'] as $f => $field) {
                $dot .= (!$first) ? "\l" : '';
                $dot .= $f . " : " . $field['type'];
                $dot .= (isset($field['key'])) ? ' [' . $field['key'] . ']': '';
                $first = false;
            }
            $dot .= "\l}\", shape=Mrecord];";

            if (!empty($model['belongsTo'])) {
                foreach ($model['belongsTo'] as $m => $mm){
                    $dot .= "node" . $model['className'] . " -- " . "node" . $mm['className'] . " [taillabel=\"" . $mm['foreignKey'] . "\", label=\"[belongsTo]\", arrowtail=crow, fontsize=10, color=\"#CECF63\"];";
                }
            }

            if (!empty($model['hasMany'])) {
                foreach ($model['hasMany'] as $m => $mm) {
                    $dot .= "node" . $model['className'] . " -- " . "node" . $mm['className'] . " [headlabel=\"" . $mm['foreignKey'] . "\", label=\"[hasMany]\", arrowhead=crow, fontsize=10, color=\"#EF3021\"];";
                }
            }

            if (!empty($model['hasAndBelongsToMany'])) {
                foreach ($model['hasAndBelongsToMany'] as $m => $mm) {
                    $dot .= "node" . $model['className'] . " -- " . "node" . $mm['className'] . " [label=\"[hasAndBelongsToMany]\", arrowhead=crow, arrowtail=crow, fontsize=10, color=\"#003D4C\"]";
                }
            }

        }
        return $dot;
    }

    /**
     * generate
     * generate png file
     *
     * @param
     * @return
     */
    function generate(){
        //$dot = $this->requestAction('/model_info/cakes/dot',array('return'));
        $dot = $this->_dot();
        $this->autoRender = true;
        $file = fopen(TMP . 'cache/model.dot','w');
        fwrite($file, $dot);
        fclose($file);
        if (system('dot -Kdot -Tpng ' . TMP . 'cache/model.dot -o ' . TMP . 'cache/model.png') === false) {
            $this->Session->setFlash(__('Invalid generate. Please install Graphviz.', true));
        }
    }

    /**
     * image
     * image
     *
     * @param
     * @return
     */
    function image(){
        header("Content-type: image/png");
        readfile(TMP . 'cache/model.png' );
    }

  }
?>