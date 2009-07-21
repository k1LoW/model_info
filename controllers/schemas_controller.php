<?php
  /*
   * CakePHP DB Schema / Model Info Plugin
   * Copyright (c) 2009 101000code/101000LAB
   * http://code.101000lab.org/
   * http://github.com/k1LoW/model_info
   * @author Kenichirou Oyama <k1lowxb@gmail.com>
   * @license MIT
   *
   */
class SchemasController extends ModelInfoAppController{
    var $name = 'Schemas';
    var $uses = array('ModelInfo.Schema');

    /**
     * index
     * ER
     *
     * @params
     * @return
     */
    function index(){
        $tables = $this->Schema->getTables();
        $this->set('tables', $tables);
    }

    /**
     * er
     * ER
     *
     * @params
     * @return
     */
    function er(){
        $tables = $this->Schema->getTables();
        $this->set('tables', $tables);
    }

  }

?>