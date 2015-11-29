<?php
echo $this->Html->script(array(
        'jquery/cloneform/jquery.cloneform',
        'application/questions/admin_add',
        //'twitter/wysiwyg/wysihtml5-0.3.0.min.js',
        //'twitter/wysiwyg/bootstrap-wysihtml5',
    ));
echo $this->Html->css(array(
        //'../js/twitter/wysiwyg/bootstrap-wysihtml5',
    ));
?>
<div class="questions form">
    <ul class="breadcrumb">
        <li>
            <?php echo $this->Html->link('Question List', array('action'=>'index', $practice_test_id));?>
            <span class="divider">/</span>
        </li>
        <li>
            <?php echo $this->Html->link($this->Text->excerpt($practice_test_name, ''), array('controller'=>'questions','action'=>'index', $practice_test_id));?>
            <span class="divider">/</span>
        </li>
        <li class="active"><?php echo __('Update'); ?></li>
    </ul>

    <div class="tabbable tabs-below">
        <?php echo $this->Form->create('Question', array('type'=>'file', 'class'=>'form-horizontal'));?>
        <div class="tab-content">
            <div id="step1" class="active tab-pane fade in">

            <?php
                    echo $this->Form->input('id');
                    echo $this->Form->hidden('right_answer');
                    echo $this->Form->input('practice_test_id', array('div'=>'control-group', 'empty'=>'----Select Quiz---', 'value'=>$practice_test_id,
                                            'before'=>'<label class="control-label" for="QuestionPracticeTestId">'.__('Quiz').'</label><div class="controls">',
                                            'after'=>$this->Form->error('practice_test_id', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
                                            'error' => array('attributes' => array('style' => 'display:none')),
                                            'label'=>false, 'class'=>'input-xlarge'));
                    echo $this->Form->input('content', array('div'=>'control-group',
                                            'before'=>'<label class="control-label" for="QuestionContent">'.__('Content').'</label><div class="controls">',
                                            'after'=>$this->Form->error('content', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
                                            'error' => array('attributes' => array('style' => 'display:none')),
                                            'label'=>false, 'class'=>'input-xxlarge textarea'));
                    echo $this->Form->input('explanation', array('div'=>'control-group',
                                        'before'=>'<label class="control-label" for="ExplanationContent">'.__('Explanation').'</label><div class="controls">',
                                        'after'=>$this->Form->error('content', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
                                        'error' => array('attributes' => array('style' => 'display:none')),
                                        'label'=>false, 'class'=>'input-xxlarge textarea'));
                    echo $this->Form->input('published', array('div'=>'control-group', 'type'=>'checkbox','checked'=>true,
                                            'before'=>'<label class="control-label" for="QuestionPublished">'.__('Published').'</label><div class="controls">',
                                            'after'=>$this->Form->error('published', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
                                            'error' => array('attributes' => array('style' => 'display:none')),
                                            'label'=>false, 'class'=>''));
            ?>

            </div>
            <div id="step2" class="tab-pane fade">
                <div class="row">
                    <div class="span2" style="text-align: right">
                        <h3>Right?</h3>
                    </div>
                    <div class="span2">
                        <h3>Answer</h3>
                    </div>
                </div>
                <?php
                    if(!empty($this->request->data['Answer'])){
                        $i=0;
                        foreach($this->request->data['Answer'] as $answer){
                ?>
                <fieldset class="clonable">
                    <div class="row">
                        <div class="control-group">
                            <div class="span2" style="text-align: right">
                                <?php $checked = ($answer['id']==$this->request->data['Question']['right_answer']) ? 'checked="true"' : '';?>
                                <div class="pull-right">
                                    <label class="radio">
                                        <input type="radio" value="<?php echo $i;?>" <?php echo $checked;?> name="data[SaveAnswer][right_answer][]">
                                    </label>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="controls" style="margin-left: 2px">
                                <?php
                                echo $this->Form->input('SaveAnswer.content', array('name'=>'data[SaveAnswer][content][]', 'type' => 'text', 'value'=>$answer['content'],
                                                'before'=>'','after'=>'','div'=>false,
                                                'error' => array('attributes' => array('style' => 'display:none')),
                                                'label'=>false, 'class'=>'input-xlarge'));
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        echo $this->Form->input('answer_id', array('name'=>'data[SaveAnswer][updateID][]', 'type'=>'hidden', 'value'=>$answer['id']));
                    ?>
                </fieldset>
                <?php
                        $i++;
                        }
                    }
                ?>
                <span id="answerTemplate"></span>
                <div class="row">
                    <div class="span2" style="text-align: right">&nbsp;</div>
                    <div class="span4">
                        <span>
                            <a data-placement="left" title="Remove the last answer option" rel="twipsy" id="edit-minus" class="btn btn-danger" href="javascript:;;">
                                <strong>&nbsp;-&nbsp;</strong>
                            </a>
                            <a data-placement="right" title="Create more the answer option" rel="twipsy" id="edit-plus" class="btn btn-info" href="javascript:;;">
                                <strong>&nbsp;+&nbsp;</strong>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <ul class="nav nav-tabs" id="tab">
            <li class="active"><a  data-toggle="tab"href="#step1">Question</a></li>
            <li><a data-toggle="tab" href="#step2">Answers</a></li>
        </ul>
    </div>
    <div class="form-actions">
        <?php

            // Find the index of the current item
            $current_index = array_search($current_id, $questionList);
            // Find the index of the next/prev items
            $next = $current_index + 1;
            $prev = $current_index - 1;

            $pClass = 'color: #999';
            $nClass = 'color: #999';
            $previous = '#';
            $forward = '#';
            if ($prev >= 0){
                $pClass = '';
                $previous = $questionList[$prev];
            }

            if($next < count($questionList)){
                $nClass = '';
                $forward = $questionList[$next];
            }

        ?>
            <div class="row">
                <div class="span2">
                        <ul class="pager">
                            <li class="previous">
                                <a href="<?php echo $previous;?>" style="<?php echo $pClass;?>" data-placement="left" title="Previous Question" rel="twipsy" >← previous</a>
                            </li>
                        </ul>
                </div>
                <div class="span4" style="text-align: center">
                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary', 'div'=>false));?>
                    <?php $cancelLink = ($this->Session->check('HistoryComponent.current')) ? $this->Session->read('HistoryComponent.current') : $this->Html->url('/admin/questions/index/'.$practice_test_id);?>
                    <?php echo $this->Form->submit(__('Cancel'), array('class'=>'btn', 'type'=>'button','div'=>false, 'onclick'=>'window.location.href="'.$cancelLink.'"'));?>
                    <?php //echo $this->Form->reset(__('Reset'), array('class'=>'btn', 'div'=>false));?>
                </div>
                <div class="span2" style="text-align: right">
                        <ul class="pager">
                            <li class="next">
                                <a href="<?php echo $forward;?>" style="<?php echo $nClass;?>" data-placement="right" title="Next Question" rel="twipsy" >next →</a>
                            </li>
                        </ul>
                </div>
            </div>

    </div>
<?php echo $this->Form->end();?>
</div>
<div class="modal hide fade" id="deleteImageConfirm">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Are you sure...?</h3>
    </div>
    <div class="modal-body">
        <p>This action will be permanently deleted your image…</p>
    </div>
    <div class="modal-footer">
        <a href="#" id="deleteImage" class="btn btn-primary">Yes</a>
        <a href="#" class="btn" data-dismiss="modal">Close</a>
    </div>
</div>
<script type="text/javascript">
    /**
    * Jquery Plugin of action
    */
    $(document).admin_add({
        practice_test_id: '<?php echo $practice_test_id;?>',
        maximumNumOfAnswers : <?php echo Configure::read('Settings.maximumNumOfAnswers');?>
    });

    $(function () {
        /**
         * load twitter boostrap
         */
        $('.tabs').tab('show');

        $("a[rel=twipsy]").tooltip({
            live: true
        });

        /**
         * delete image
         */
        $("#deleteImage").bind('click', {}, function(){
            var obj = $(this);
            var params = { 'data[Question][id]' : '<?php echo $current_id;?>' };
            var str = jQuery.param(params);
            $.post('<?php echo $this->Html->url("/admin/questions/delete_image");?>', str,
                function(response){
                    if(response==1){
                        $('#deleteImageConfirm').modal('hide');
                        $("#imageHolder").slideUp();
                    }
                }
            );

        });
    });

    //$('.textarea').wysihtml5();


</script>