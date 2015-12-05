<?php

App::uses('AppModel', 'Model');

class Question extends AppModel {
    //Containable is a CakePHP behavior that optimizes what's retrieved from DB
    var $actsAs = array(
           'Containable'
	);

    //Requires that the question have content
    public $validate = array(
        'content' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please input question content',
                'allowEmpty' => false,
                //'required' => true,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );

    //Associates question with a specific PT
    public $belongsTo = array(
        'PracticeTest' => array(
            'className' => 'PracticeTest',
            'foreignKey' => 'practice_test_id',
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
        'Answer' => array(
            'className' => 'Answer',
            'foreignKey' => 'question_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        return true;
    }

    public function afterSave($created) {
        $question_id = ($this->getLastInsertID()) ? $this->getLastInsertID() : $this->id; 
        if (isset($this->data['SaveAnswer']['content']) && !empty($this->data['SaveAnswer']['content'])) {
            
            //delete old answer
            $this->Answer->deleteAll(array('Answer.question_id' => $question_id));

            $rightAnswer_Index = Set::extract("/right_answer", $this->data['SaveAnswer']); //
            $answerData = null;
            $right_answer = null;
            $idx = 0;
            foreach ($this->data['SaveAnswer']['content'] as $answer) {
                
                if (!$answer) continue;

                $this->data['Answer']['question_id'] = $question_id;
                $this->data['Answer']['content'] = $answer;
                $this->Answer->save($this->data['Answer']);

                if (in_array($idx, $this->data['SaveAnswer']['right_answer'])) {
                    $right_answer = ($this->Answer->getLastInsertID()) ? $this->Answer->getLastInsertID() : $this->Answer->id;
                }
           
                $this->Answer->id = false;
                $idx++;
            }
            $question['Question']['id'] = $question_id;
            $question['Question']['right_answer'] = $right_answer;
            $this->saveAll($question['Question'], array('validate' => false));
        }

        parent::afterSave($created);
    }

}
