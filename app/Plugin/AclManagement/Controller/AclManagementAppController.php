<?php

class AclManagementAppController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->layout = "admin";
    }
}
?>