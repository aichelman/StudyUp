<?php

App::uses('AppModel', 'Model');

/**
 * PracticeTest Model
 *
 * @property Country $Country
 * @property User $User
 * @property Contribute $Contribute
 * @property Question $Question
 * @property UserScore $UserScore
 */
class PracticeTest extends AppModel {

    public $actsAs = array('Containable');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(        
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Title cannot be null.',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(       
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(    
        'Question' => array(
            'className' => 'Question',
            'foreignKey' => 'practice_test_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );
    
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        if(isset($this->data['PracticeTest']['title']) && !empty($this->data['PracticeTest']['title'])){
            $this->data['PracticeTest']['slug'] = Inflector::slug(strtolower($this->data['PracticeTest']['title']));
        }
        return true;
    }

    public function  afterSave($created) {
        parent::afterSave($created);

        if($this->id){
            Cache::delete('getPracticeTitleById'.$this->id);
        }
    }

    public function  afterDelete() {
        parent::afterDelete();

        if($this->id){
            Cache::delete('getPracticeTitleById'.$this->id);
        }
    }

    public function getPracticeTitleById($id){
        if (($practiceTest = Cache::read('getPracticeTitleById'.$id)) === false) {
                $practiceTest = $this->field('title', array('PracticeTest.id'=>$id));

            Cache::write('getPracticeTitleById'.$id, $practiceTest);
        }
        return $practiceTest;

    }
}
