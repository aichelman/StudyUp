<?php

App::uses('AppController', 'Controller');

/**
 * Questions Controller
 *
 * @property Question $Question
 */
class QuestionsController extends AppController {
    public $helpers = array('Text');
    public $components = array('Security');

    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Security->blackHoleCallback = '__blackhole';
        $this->Security->disabledFields = array('SaveAnswer', '_wysihtml5_mode');
        if ($this->request->is('ajax') || (isset($this->params->params['admin']) && $this->params->params['admin'] == 1)) {
            $this->Security->csrfCheck = false;
            $this->Security->validatePost = false;
        }
    }
//    public function __blackhole($type){
//        pr($this->Question->invalidFields());
//        pr($type);
//        pr($this->request->data);
//        exit;
//    }
    /**
     * member_index method
     *
     * @return void
     */
    public function member_index($practice_test_id=null) {
        $this->admin_index($practice_test_id);
    }
    /**
     * member_add method
     *
     * @return void
     */
    public function member_add($practice_test_id=null) {
        $this->admin_add($practice_test_id);
    }
    /**
     * member_edit method
     *
     * @param string $id
     * @return void
     */
    public function member_edit($practice_test_id = null, $id = null) {
//        if(!empty($this->request->data)){
//            pr($this->request->data);exit;
//        }
        $this->admin_edit($practice_test_id, $id);
    }
    /**
     * member_edit method
     *
     * @param string $id
     * @return void
     */
    public function member_delete($practice_test_id = null, $id = null) {
        $this->admin_delete($practice_test_id, $id);
    }
    /**
     *  Order question
     *
     */
    public function member_ordered() {
        $this->admin_ordered();
    }
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index($practice_test_id=null) {
        if (!$practice_test_id) {
            throw new NotFoundException(__('Invalid question'));
        }
        $this->__addUrl();
        $this->set('title', __('Question'));
        $this->set('description', __('Manage Question'));
        $this->set('practice_test_id', $practice_test_id);
        $this->set('practice_test_name', $this->Question->PracticeTest->getPracticeTitleById($practice_test_id));

        $this->Question->recursive = 0;
        $conditions = array('Question.practice_test_id' => $practice_test_id);

        $this->paginate = array('conditions' => $conditions,
            'contain'=>false,
            'order' => array('Question.ordered' => 'ASC'));
        $this->set('questions', $this->paginate());
    }


    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add($practice_test_id=null) {
        if(!$practice_test_id){
            throw new NotFoundException(__('Invalid question'));
        }

        $this->set('title', __('Questions & Answers'));
        $this->set('description', __('New Question'));

        if ($this->request->is('post')) {
            $this->Question->create();
            $this->request->data['SaveAnswer']['content'] = $this->array_filter_recursive($this->request->data['SaveAnswer']['content']);
            if(empty($this->request->data['Question']['content'])){
                $this->Question->invalidate('content', 'Please input question content');
            }elseif(empty($this->request->data['SaveAnswer']) || empty($this->request->data['SaveAnswer']['content']) || empty($this->request->data['SaveAnswer']['right_answer'])){
                $this->Session->setFlash(__('The question must be supplied answer options. Please, try again.'), 'error');
            }else{
                if ($this->Question->save($this->request->data)) {
                    $this->Session->setFlash(__('The question has been saved'), 'success');
                    if(!$this->__getPreviousUrl()){
                        $this->redirect(array('action' => 'edit', $practice_test_id, $this->Question->getLastInsertID()));
                    }
                    $this->redirect($this->__getPreviousUrl());
                } else {
                    $this->Session->setFlash(__('The question could not be saved. Please, try again.'), 'error');
                }
            }           
        }
        
        $practiceTests = $this->Question->PracticeTest->find('list', array('conditions' => array(),
                    'order' => array('PracticeTest.ordered' => 'ASC')));
        $this->set(compact('practiceTests', 'practice_test_id'));
        $this->set('practice_test_name', $this->Question->PracticeTest->getPracticeTitleById($practice_test_id));
    }

 /**
     *  Get list of question to next, prev
     *
     * @param <type> $practice_test_id
     */
    private function __getQuestionList($practice_test_id=null){        
        $questionList = $this->Question->find('list', array(
            'conditions'=>array('Question.practice_test_id'=>$practice_test_id),
            'fields'=>array('id', 'id'),
            'order'=>array('Question.ordered'=>'ASC')
        ));
        return $questionList;
    }    
    /**
     * admin_edit method
     *
     * @param string $id
     * @return void
     */
    public function admin_edit($practice_test_id = null, $id = null) {
        $this->Question->id = $id;
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }

        $this->set('title', __('Questions & Answers'));
        $this->set('description', __('Update Question'));

        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->request->data;
            $this->request->data['SaveAnswer']['content'] = $this->array_filter_recursive($this->request->data['SaveAnswer']['content']);
            if(empty($this->request->data['Question']['content'])){
                $this->Question->invalidate('content', 'Please input question content');
            }elseif(empty($this->request->data['SaveAnswer']) || empty($this->request->data['SaveAnswer']['content']) || empty($this->request->data['SaveAnswer']['right_answer'])){
                $this->Session->setFlash(__('The question must be supplied answer options. Please, try again.'), 'error');
            }else{
                if ($this->Question->save($this->request->data)) {
                    $this->Session->setFlash(__('The question has been saved'), 'success');
                    if(!$this->__getPreviousUrl()){
                        $this->redirect(array('action' => 'edit', $practice_test_id, $id));
                    }
                    $this->redirect($this->__getPreviousUrl());
                } else {
                    if(empty($this->request->data['Answer'])){
                        $answers = $this->Question->find('first', array('conditions'=>array('Question.id'=>$id)));
                        $this->request->data['Answer'] = $answers['Answer'];
                    }
                    $this->Session->setFlash(__('The question could not be saved. Please, try again.'), 'error');
                }
            }
        } else {
            $this->request->data = $this->Question->read(null, $id);
        }

        $practiceTests = $this->Question->PracticeTest->find('list', array('conditions' => array(),
                    'order' => array('PracticeTest.ordered' => 'ASC')));
        $questionList = array_values($this->__getQuestionList($practice_test_id));
        $this->set(compact('practiceTests', 'practice_test_id', 'questionList'));
        $this->set('practice_test_name', $this->Question->PracticeTest->getPracticeTitleById($practice_test_id));
        $this->set('current_id',$id);
    }

    /**
     * admin_delete method
     *
     * @param string $id
     * @return void
     */
    public function admin_delete($practice_test_id = null, $id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Question->id = $id;
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid question'));
        }
        if ($this->Question->delete()) {
            $this->Question->Answer->deleteAll(array('Answer.question_id'=>$id));
            
            $this->Session->setFlash(__('Question deleted'), 'success');
            $this->redirect(array('action' => 'index', $practice_test_id));
        }
        $this->Session->setFlash(__('Question was not deleted'), 'error');
        $this->redirect(array('action' => 'index'));
    }
    /**
     * admin_delete_image method
     *
     * @param string $id
     * @return void
     */
    public function admin_delete_image() {
        $this->autoRender = false;
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        if(!empty($this->request->data)){
            $this->Question->id = $this->request->data['Question']['id'];
            if (!$this->Question->exists()) {
                throw new NotFoundException(__('Invalid question'));
            }

            $this->request->data['Question']['photo'] = null;
            $this->request->data['Question']['photo_dir'] = null;
            if ($this->Question->save($this->request->data, false)) {
                return true;
            }
        }
        return false;
    }

    /**
     *  Order question
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
            $orderLists = json_decode($this->request->data['Question']['ordered']);
            $queryStr = 'UPDATE '.$prefix.'questions SET ordered = CASE id ';
            foreach($orderLists as $order => $id):
                if(!$id) continue;
                $queryStr .= 'WHEN '.$id.' THEN '.$order.' ';
            endforeach;
            $queryStr .= 'END WHERE id IN ('.  implode(", ", $orderLists).');';
            
            Cache::clear();
            clearCache();
            
            $this->Question->query($queryStr);
            return true;
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
            $data['Question'] = array('id' => $id, $field => $status);
            if ($this->Question->saveAll($data['Question'], array('validate' => false))) {
                $url = FULL_BASE_URL.$this->base.'/admin/' . Inflector::tableize($this->name) . '/toggle/' . $id . '/' . $status . '/' . $field;
                $src = FULL_BASE_URL.$this->base.'/img/icons/allow-' . $status . '.png';

                return "<img id=\"status-{$id}\" onclick=\"published.toggle('status-{$id}', '{$url}');\" src=\"{$src}\">";
            }
        }

        return false;
    }

}