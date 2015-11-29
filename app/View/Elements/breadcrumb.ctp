<?php if(isset($quiz_title)): ?>
<ul class="breadcrumb" style="margin-bottom: 5px">
    <li>
        <?php echo $this->Html->link('Home', array('action'=>'index'));?>
        <span class="divider">/</span>
    </li>
    <li class="active"><?php echo h($quiz_title); ?></li>
</ul>
<?php endif;?>