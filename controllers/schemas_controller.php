<?php

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