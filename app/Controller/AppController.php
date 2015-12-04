<?php

App::uses('Controller', 'Controller');
App::import('Vendor', 'Facebook', array('file' => 'Facebook'.DS.'src'.DS.'facebook.php'));

class AppController extends Controller {

    public $components = array(
            'Acl',
            'Auth' => array(
                'authenticate' => array(
                    'Form' => array(
                     //login information
                        'fields' => array('username' => 'email'),
                        'scope'  => array('User.status' => 1)
                    )
                ),
                'authorize' => array(
                    'Actions' => array('actionPath' => 'controllers')
                )
            ),
            'Session',
            //'DebugKit.Toolbar',
        );

    public $helpers = array(
        'Session',
        'Form',
        'Html',
        'Cache',
        'Js',
        'Time',
    );
    var $facebook;
    var $uses = array('User');


    public function beforeFilter() {
        parent::beforeFilter();

        if(isset ($this->params->admin) && $this->params->admin){
            $this->layout = 'admin';
        }


        //Configure AuthComponent
        ////$this->Auth->allow("*");
        $this->Auth->flash = array("element"=>"error", "key"=>"auth", "params"=>array());
        $this->Auth->loginAction = '/users/login';
        $this->Auth->logoutRedirect = '/';
        //$this->Auth->loginRedirect = '/';
        //$this->Auth->loginRedirect = array('plugin'=>false, 'controller' => 'practicetests', 'action' => 'index');
    }

    /**
     * return previous URL
     *
     * @return string
     */
    function __getPreviousUrl() {
    	//adding to history
        return ($this->Session->check('HistoryComponent.current')) ? $this->Session->read('HistoryComponent.current') : false;
    }

    /**
     * add url
     */
    function __addUrl() {
        $current = FULL_BASE_URL.$this->here;//Router::url($this->here, true);
        if ($this->Session->read('HistoryComponent.current') != $current) {
            $this->Session->write('HistoryComponent.current', $current);
        }
    }
    
    //remove item = 0 or null
    public function array_filter_recursive($input) {
            if(empty($input)) return false;

            foreach ($input as &$value) {
                    if (is_array($value)) {
                            $value = $this->array_filter_recursive($value);
                    }
            }
            return array_filter($input);
    }
}

?>