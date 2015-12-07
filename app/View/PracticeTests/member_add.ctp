<ul class="breadcrumb frontbreadcrumb">
	hello member_add
    <li>
        <?php echo $this->Html->link('Home','/');?>
        <span class="divider">/</span>
    </li>
    <li>
            <?php echo $this->Html->link('Dashboard', array('action'=>'index'));?>
            <span class="divider">/</span>
    </li>
    <li class="active"><?php echo __('Edit Quiz'); ?></li>
</ul>
<div class="table-bordered bg-white" style="padding:20px">
<?php echo $this->Form->create('PracticeTest', array('class'=>'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Add Quiz'); ?></legend>
	<?php
		echo $this->Form->input('title', array('div'=>'control-group','placeholder'=>'',
					'before'=>'<label class="control-label">'.__('Title').'</label><div class="controls">',
					'after'=>$this->Form->error('title', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
					'error' => array('attributes' => array('style' => 'display:none')),
					'label'=>false, 'class'=>'input-xlarge'));
		echo $this->Form->input('description', array('div'=>'control-group','placeholder'=>'' , 'type'=>'textarea',
					'before'=>'<label class="control-label">'.__('Description').'</label><div class="controls">',
					'after'=>$this->Form->error('description', array(), array('wrap' => 'span', 'class' => 'help-inline')).'</div>',
					'error' => array('attributes' => array('style' => 'display:none')),
					'label'=>false, 'class'=>'input-xlarge'));		
	?>
        <div class="form-actions">
            <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-primary', 'div'=>false));?>
            <?php $cancelLink = $this->Html->url('/member/practice_tests/index/');?>
            <?php echo $this->Form->submit(__('Cancel'), array('class'=>'btn', 'type'=>'button','div'=>false, 'onclick'=>'window.location.href="'.$cancelLink.'"'));?>
        </div>
	</fieldset>
<?php echo $this->Form->end();?>
</div>