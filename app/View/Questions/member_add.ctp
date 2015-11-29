<?php 
echo $this->Html->script(array(
        'jquery/cloneform/jquery.cloneform',
        'application/questions/admin_add',
        'twitter/wysiwyg/wysihtml5-0.3.0.min.js',
        'twitter/wysiwyg/bootstrap-wysihtml5',
    ));
echo $this->Html->css(array(        
        '../js/twitter/wysiwyg/bootstrap-wysihtml5',
    ));
?>
<?php echo $this->Html->script(array('ckeditor/ckeditor'));?>
<ul class="breadcrumb frontbreadcrumb">
    <li>
        <?php echo $this->Html->link('Home','/');?>
        <span class="divider">/</span>
    </li>
    <li>
        <?php echo $this->Html->link('Dashboard', array('controller'=>'practice_tests','action'=>'index'));?>
        <span class="divider">/</span>
    </li>
    <li>
        <?php echo $this->Html->link($this->Text->excerpt($practice_test_name, ''), array('controller'=>'questions','action'=>'index', $practice_test_id));?>
        <span class="divider">/</span>
    </li>
    <li class="active"><?php echo __('New Question'); ?></li>
</ul>
<div class="table-bordered bg-white" style="padding:20px">
<div class="tabbable tabs-below">
    <?php echo $this->Form->create('Question', array('type'=>'file', 'class'=>'form-horizontal'));?>
    <div class="tab-content">
        <div id="step1" class="active tab-pane fade in">

        <?php
                echo $this->Form->input('practice_test_id', array('value'=>$practice_test_id, 'type'=>'hidden'));
                echo $this->Form->input('content', array('div'=>'control-group',
                                        'before'=>'<label class="control-label" style="width:40px" for="QuestionContent">'.__('Content').'</label><div class="controls" style="margin-left:80px">',
                                        'after'=>$this->Form->error('content', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
                                        'error' => array('attributes' => array('style' => 'display:none')),
                                        'label'=>false, 'class'=>'input-xxlarge'));
                echo $this->Form->input('explanation', array('div'=>'control-group',
                                        'before'=>'<label class="control-label" style="width:40px" for="ExplanationContent">'.__('Explanation').'</label><div class="controls" style="margin-left:80px">',
                                        'after'=>$this->Form->error('content', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
                                        'error' => array('attributes' => array('style' => 'display:none')),
                                        'label'=>false, 'class'=>'input-xxlarge textarea'));
                echo $this->Form->input('published', array('div'=>'control-group', 'type'=>'checkbox','checked'=>true,
                                        'before'=>'<label class="control-label" style="width:40px" for="QuestionPublished">'.__('Published').'</label><div class="controls" style="margin-left:80px">',
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
            if(!empty($this->request->data['SaveAnswer']['content'])):
                    $i=0;
                    foreach($this->request->data['SaveAnswer']['content'] as $idx => $val):
                        $checked        = (in_array($idx, $this->data['SaveAnswer']['right_answer'])) ? 'checked=""' : '';
                        $placeholder    = ($val=='') ? __('Please input answer option') : '';
                        $error          = ($val=='') ? 'error' : '';
            ?>
                <fieldset class="clonable">
                    <div class="row">
                        <div class="control-group <?php echo $error;?>">
                            <div class="span2" style="text-align: right">
                                <label>
                                    <input type="radio" name="data[SaveAnswer][right_answer][]" <?php echo $checked;?> value="<?php echo $i;?>">
                                </label>
                            </div>
                            <div class="span2">
                                <div class="controls" style="margin-left: 2px">
                                <?php
                                echo $this->Form->input('SaveAnswer.content', array('name'=>'data[SaveAnswer][content][]',
                                                'type' => 'text', 'value'=>$val, 'placeholder'=>$placeholder,
                                                'before'=>'','after'=>'','div'=>false,
                                                'error' => array('attributes' => array('style' => 'display:none')),
                                                'label'=>false, 'class'=>'input-xlarge'));
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            <?php
                        $i++;
                    endforeach;
                else:
            ?>
            <fieldset class="clonable">
                <div class="row">
                    <div class="control-group">
                        <div class="span2" style="text-align: right">
                            <div class="">
                                <label>
                                    <input type="radio" name="data[SaveAnswer][right_answer][]" checked="true">
                                </label>
                            </div>
                        </div>
                        <div class="span2">
                            <div class="controls" style="margin-left: 2px">
                            <?php
                            echo $this->Form->input('SaveAnswer.content', array('name'=>'data[SaveAnswer][content][]', 'type' => 'text',
                                            'before'=>'','after'=>'','div'=>false,
                                            'error' => array('attributes' => array('style' => 'display:none')),
                                            'label'=>false, 'class'=>'input-xlarge'));
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <?php
                endif;
            ?>

            <span id="answerTemplate"></span>
            <div class="row">
                <div class="span2" style="text-align: right">&nbsp;</div>
                <div class="span3">
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
        <div class="row">
            <div class="span2"></div>
            <div class="span4" style="text-align: center">
                <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary', 'div'=>false));?>
                <?php $cancelLink = $this->Html->url('/member/questions/index/'.$practice_test_id);?>
                <?php echo $this->Form->submit(__('Cancel'), array('class'=>'btn', 'type'=>'button','div'=>false, 'onclick'=>'window.location.href="'.$cancelLink.'"'));?>
            </div>
            <div class="span2"></div>
        </div>
</div>
</div>
<?php echo $this->Form->end();?>

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
    });

    $('.textarea').wysihtml5();
</script>