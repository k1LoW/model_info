<?php

class ModelInfoAppController extends AppController {

/**
 * beforeFilter
 * description
 *
 * @params
 * @return
 */
function beforeFilter(){
    //for AuthComponent
    $this->Auth->allow('*');
}

}

?>