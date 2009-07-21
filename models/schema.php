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
class Schema extends ModelInfoAppModel {
    var $name = 'Schema';
    var $useTable = false;

    /**
     * getTables
     *
     *
     * @params
     * @return
     */
    function getTables(){
        $db =& ConnectionManager::getDataSource($this->useDbConfig);
        $usePrefix = empty($db->config['prefix']) ? '' : $db->config['prefix'];
        if ($usePrefix) {
            $tables = array();
            foreach ($db->listSources() as $table) {
                if (!strncmp($table, $usePrefix, strlen($usePrefix))) {
                    $tables[]  =  substr($table, strlen($usePrefix));
                }
            }
        } else {
            $tables = $db->listSources();
        }

        $schema = array();
        foreach ($tables as $key => $value) {
            $tempModel = new Model(array('table' => $value, 'ds' => $this->useDbConfig));
            $fields = $tempModel->schema();
            $schema[$value]['fields'] = $fields;
        }

        return $schema;
    }

  }
?>