<?php

App::uses('AppController', 'Controller');

/**
 * PracticeTests Controller
 *
 * @property PracticeTest $PracticeTest
 */
class PracticeTestsController extends AppController {

    public $components = array('Security');
    public $helpers = array('Text', 'Time', 'Cache');
    
    public $cacheAction = array(
        'openquiz' => 36000
    );

    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Security->blackHoleCallback = '__blackhole';
        if ($this->request->is('ajax') || (isset($this->params->params['admin']) && $this->params->params['admin'] == 1)) {
            $this->Security->csrfCheck = false;
            $this->Security->validatePost = false;
        }

        $this->Auth->allow("index", "view", "vote", "topten", "openquiz");
    }    
//    public function __blackhole($type){
//        pr($type);exit;
//    }
    /**
     * index method
     *
     * @return void
     */
    public function index(){
        $this->paginate = array('conditions'=>array('PracticeTest.published'=>1), 'order'=>array('PracticeTest.created'=>'DESC'));
        $this->PracticeTest->recursive = 0;
        $this->set('posts', $this->paginate());
    }
    /**
     * view method
     *
     * @return void
     */
    public function view($id, $slug=null){        
        $this->PracticeTest->id = $id;
        if (!$this->PracticeTest->exists()) {
            throw new NotFoundException(__('Invalid quiz'));
        }
        $this->PracticeTest->recursive = 0;
        $post = $this->PracticeTest->find('first', array(
            'conditions' => array('PracticeTest.id'=>$id),
            'contain' => array('User'=>array('fields'=>array('User.name')))
        ));
        
        if(!empty ($post)){
            if(!empty($post['PracticeTest']['title'])){
                $this->set('title_for_layout', $post['PracticeTest']['title']);
                $this->set('quiz_title', $post['PracticeTest']['title']);
            }
        }
        
        $this->set(compact('id', 'post'));

       
        /**
         * load quiz rate
         */
        $this->loadModel('Rate');
        $user_id = $this->Session->read('Auth.User.id');        
        $user_rate = $this->Rate->find('first', array('conditions'=>array('practice_test_id'=>$id, 'user_id'=>$user_id)));
        $likes = (!empty($user_rate)) ? $user_rate['Rate']['likes'] : 0;
        $dislikes = (!empty($user_rate)) ? $user_rate['Rate']['dislikes'] : 0;
        $this->set(compact('likes', 'dislikes'));
    }

    /**
     * Dynamic create js for embed code
     * 
     * @return void 
     */
    function openquiz(){
        $this->layout = "ajax";

        $id = (isset($this->request->query['id'])) ? $this->request->query['id'] : false;
        if(!$id){
            return false;
        }
        
        $this->PracticeTest->id = $id;
        if (!$this->PracticeTest->exists()) {
            return false;
        }
        
        $this->PracticeTest->recursive = 0;
        if (($post = Cache::read('getQuizById'.$id)) === false) {
            $post = $this->PracticeTest->find('first', array(
                'conditions' => array('PracticeTest.id'=>$id),
                'fields' => array('PracticeTest.id'),
                'contain' => array(
                    'Question'=>array('Answer'=>array('conditions'=>array('Answer.published'=>1)),
                        'conditions'=>array('Question.published'=>1),
                        'order' => array('Question.ordered' => 'ASC')
                    ))
            ));
            Cache::write('getQuizById'.$id, $post);
        }
        $this->set('post', $post);
        header("Content-type: text/javascript");
    }

    /**
     *get top ten voted 
     */
    public function topten(){
        $this->layout="ajax";
        /**
         * Top 10 quiz
         */
        $FavouritePracticeTests = $this->PracticeTest->find('all', array('order'=>array('PracticeTest.avg'=>'DESC'), 
            'conditions'=>array('published'=>1),
            'limit'=>10));
        $this->set(compact('FavouritePracticeTests'));
    }
    /**
     * vote method
     *
     * @return void
     */
    public function vote($id){
        $this->autoRender = false;

        if (!$this->request->is('post')) {
            return false;
        }

        if (!$this->Session->check('Auth.User.id')) {
            return 'auth';
        }       

        $this->PracticeTest->id = $id;
        if (!$this->PracticeTest->exists()) {
            return false;
        }
        
        if(!empty($this->request->data)){            
            $this->loadModel('Rate');
            $user_id = $this->Session->read('Auth.User.id');
            $rate = $this->Rate->find('first', array('conditions'=>array('practice_test_id'=>$id, 'user_id'=>$user_id)));

            $method = $this->request->data['PracticeTest']['method'];
            if(in_array($method, array('likes', 'dislikes'))){
                //already vote this
                if($rate['Rate'][$method]){
                    return $method;
                }

                /**
                 * Reset vote and update new user rate
                 */
                $resetUpdate = '';
                if(!empty($rate)){
                    if($rate['Rate']['likes']){
                        $resetUpdate .= ", likes = likes - 1 ";
                    }
                    if($rate['Rate']['dislikes']){
                        $resetUpdate .= ", dislikes = dislikes - 1 ";
                    }                    
                }
                $resetUpdate .= ", $method = $method + 1 ";
                $resetUpdate  = substr($resetUpdate, 1);

                /**
                 * Update practice like
                 */
                $this->PracticeTest->query("UPDATE ".$this->PracticeTest->table." SET $resetUpdate, avg=likes - dislikes WHERE id=$id");
                
                /**
                 * save rate
                 */
                $rateData['Rate']['practice_test_id'] = $id;
                $rateData['Rate']['user_id'] = $user_id;
                if($method == 'likes'){
                    $rateData['Rate']['likes'] = 1;
                    $rateData['Rate']['dislikes'] = 0;
                }else{
                    $rateData['Rate']['likes'] = 0;
                    $rateData['Rate']['dislikes'] = 1;
                }
                if(!empty($rate)){
                    $rateData['Rate']['id'] = $rate['Rate']['id'];
                }
                $this->Rate->save($rateData['Rate']);

                return $method;
            }
        }

        return false;
    }
    /**
     * member_index method
     *
     * @return void
     */
    public function member_index() {
        $this->set('title', __('Quiz'));
        $this->set('description', __('Manage Quiz'));

        $this->PracticeTest->recursive = 0;
        $this->paginate = array(
                'conditions'=>array('PracticeTest.user_id'=>$this->Auth->user('id')),
                'order'=>array('PracticeTest.created'=>'DESC')
            );
        $this->set('practiceTests', $this->paginate());
    }
    /**
     * member_add method
     *
     * @return void
     */
    public function member_add() {
        if ($this->request->is('post')) {
            $this->PracticeTest->create();
            $this->request->data['PracticeTest']['user_id'] = $this->Auth->user('id');
            $this->request->data['PracticeTest']['published'] = 2;
            if ($this->PracticeTest->save($this->request->data)) {
                $this->Session->setFlash(__('Quiz has been saved. Please create questions for your quiz.'), 'success');
                $this->redirect(array('controller'=>'questions', 'action' => 'index', $this->PracticeTest->getLastInsertID()));
            } else {
                $this->Session->setFlash(__('Quiz could not be saved. Please, try again.'), 'error');
            }
        }
    }

    /**
     * member_edit method
     *
     * @param string $id
     * @return void
     */
    public function member_edit($id = null) {
        $this->PracticeTest->id = $id;
        if (!$this->PracticeTest->exists()) {
            throw new NotFoundException(__('Invalid Quiz'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['PracticeTest']['user_id'] = $this->Auth->user('id');
            $this->request->data['PracticeTest']['published'] = 2;
            if ($this->PracticeTest->save($this->request->data)) {
                $this->Session->setFlash(__('Quiz has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Quiz could not be saved. Please, try again.'), 'error');
            }
        } else {
            $this->request->data = $this->PracticeTest->read(null, $id);
        }
    }
    /**
     * member_delete method
     *
     * @param string $id
     * @return void
     */
    public function member_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->PracticeTest->id = $id;
        if (!$this->PracticeTest->exists()) {
            throw new NotFoundException(__('Invalid Quiz'));
        }
        if ($this->PracticeTest->deleteAll( array('PracticeTest.id'=>$id, 'PracticeTest.user_id'=>  $this->Auth->user('id')))) {
            $this->Session->setFlash(__('Quiz deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Quiz was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }   
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->set('title', __('Quiz'));
        $this->set('description', __('Manage Quiz'));

        $this->PracticeTest->recursive = 0;
        $this->paginate = array('order'=>array('PracticeTest.created'=>'DESC'));
        $this->set('practiceTests', $this->paginate());
    }


    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->PracticeTest->create();
            $this->request->data['PracticeTest']['user_id'] = $this->Auth->user('id');
            if ($this->PracticeTest->save($this->request->data)) {
                $this->Session->setFlash(__('Quiz has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Quiz could not be saved. Please, try again.'), 'error');
            }
        }
    }

    /**
     * admin_edit method
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->PracticeTest->id = $id;
        if (!$this->PracticeTest->exists()) {
            throw new NotFoundException(__('Invalid Quiz'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['PracticeTest']['user_id'] = $this->Auth->user('id');
            if ($this->PracticeTest->save($this->request->data)) {
                $this->Session->setFlash(__('Quiz has been saved'), 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Quiz could not be saved. Please, try again.'), 'error');
            }
        } else {
            $this->request->data = $this->PracticeTest->read(null, $id);
        }
    }

    /**
     * admin_delete method
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->PracticeTest->id = $id;
        if (!$this->PracticeTest->exists()) {
            throw new NotFoundException(__('Invalid Quiz'));
        }
        if ($this->PracticeTest->delete()) {
            $this->Session->setFlash(__('Quiz deleted'), 'success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Quiz was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     *  Order practice
     *
     */
    public function admin_ordered() {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->autoRender = false;
        
        App::import('Core', 'ConnectionManager');
        $dataSource = ConnectionManager::getDataSource('default');
        $prefix = $dataSource->config['prefix'];
        if(!empty($this->request->data)){
            $orderLists = json_decode($this->request->data['PracticeTest']['ordered']);
            $queryStr = 'UPDATE '.$prefix.'practice_tests SET ordered = CASE id ';
            foreach($orderLists as $order => $id):
                if(!$id) continue;
                $queryStr .= 'WHEN '.$id.' THEN '.$order.' ';
            endforeach;
            $queryStr .= 'END WHERE id IN ('.  implode(", ", $orderLists).');';
        
            Cache::clear();
            clearCache();
   
            return $this->PracticeTest->query($queryStr);
        }
        return false;
    }
    /**
     *  Active/Inactive
     *
     * @param int $id
     * @param int $status
     */
    public function admin_toggle($id, $status, $field='published') {
        $this->autoRender = false;

        if ($id) {
            $status = ($status) ? 0 : 1;
            $data['PracticeTest'] = array('id' => $id, $field => $status);
            if ($this->PracticeTest->saveAll($data['PracticeTest'], array('validate' => false))) {
                $url = FULL_BASE_URL.$this->base.'/admin/' . Inflector::tableize($this->name) . '/toggle/' . $id . '/' . $status . '/' . $field;
                $src = FULL_BASE_URL.$this->base.'/img/icons/allow-' . $status . '.png';

                return "<img id=\"status-{$id}\" onclick=\"published.toggle('status-{$id}', '{$url}');\" src=\"{$src}\">";
            }
        }

        return false;
    }
}
