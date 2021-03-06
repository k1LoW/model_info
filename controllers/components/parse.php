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
class ParseComponent{

    public function __construct(){
        $this->controllersPath = ROOT . '/' . APP_DIR . '/controllers/';
        $this->modelsPath = ROOT . '/' . APP_DIR . '/models/';
    }

    /**
     * getControllerAndAction
     * 全コントローラとアクション名を取得
     *
     * @params $
     * @return
     */
    function getControllerAndAction(){
        $files = scandir($this->controllersPath);
        $result = array();
        foreach ($files as $key => $value) {
            $filePath = $this->controllersPath . $value;
            if (preg_match('/_controller\.php$/',$value) && is_file($filePath)) {
                $fp = fopen($filePath,'r');
                $controllerName = Inflector::camelize(preg_replace('/_controller\.php$/','',$value));
                $result[$controllerName] = array();
                while (!feof($fp)) {
                    $actions = array();
                    if (preg_match('/function ?([^() ]+) ?\(/',fgets($fp,4096),$matches)) {
                        array_push($result[$controllerName],$matches[1]);
                    }
                }
                fclose($fp);
            } else {
                unset($files[$key]);
            }
        }
        return $result;
    }

    /**
     * getModel
     * モデル名を取得
     *
     * @params
     * @return
     */
    function getModel(){
        $files = scandir($this->modelsPath);
        $result = array();
        $i = 0;
        foreach ($files as $key => $value) {
            $filePath = $this->modelsPath . $value;
            if (preg_match('/.+\.php$/',$value) && is_file($filePath)) {
                $fp = fopen($filePath,'r');
                $fileName = preg_replace('/\.php$/','',$value);
                if ($fileName != 'app_model') {
                    $result[$i] = null;
                    $result[$i]['fileName'] = $fileName;
                    while (!feof($fp)) {
                        $actions = array();
                        $line = fgets($fp,4096);
                        if (preg_match('/class ?([^ ]+) extends AppModel/',$line,$matches)) {
                            $result[$i]['className'] = $matches[1];
                        }
                        if (preg_match('/useDbConfig ?= ?([^ ]+)/',$line,$matches)) {
                            $result[$i]['useDbConfig'] = $matches[1];
                        }
                    }
                    if (!isset($result[$i]['useDbConfig'])) {
                        $result[$i]['useDbConfig'] = 'default';
                    }

                    fclose($fp);
                }
            } else {
                unset($files[$key]);
            }
            $i++;
        }

        function __useDbConfigSort($a,$b) {
            if ($a['useDbConfig'] == $b['useDbConfig']) {
                return 0;
            }

            return ($a['useDbConfig']  >  $b['useDbConfig']) ? 1 : -1;
        }
        usort($result, '__useDbConfigSort');

        foreach ($result as $key => $value) {
            require_once($this->modelsPath . $value['fileName'] . '.php');
            $obj = new $value['className'];
            $result[$key]['hasMany'] = $obj->hasMany;
            $result[$key]['hasOne'] = $obj->hasOne;
            $result[$key]['hasAndBelongsToMany'] = $obj->hasAndBelongsToMany;
            $result[$key]['belongsTo'] = $obj->belongsTo;

            //for 1.1
            if (isset($obj->_tableInfo->value)) {
                $result[$key]['_schema'] = $obj->_tableInfo->value;
            } else {
                $result[$key]['_schema'] = array();
            }

            //for 1.2
            if (isset($obj->_schema)) {
                $result[$key]['_schema'] = $obj->_schema;
            } else {
                $result[$key]['_schema'] = array();
            }

        }

        return $result;
    }
  }
?>