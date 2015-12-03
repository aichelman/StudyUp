<div class="table-bordered bg-white" style="padding:20px">
    <div class="row">
        <div class="span8">

        <!--Top Page Scroll-->    
        <div class="pagination">
            <ul>
            <?php
                echo $this->Paginator->prev('&larr; ' . __('previous'), array('tag' => 'li','escape'=>false), null, array('tag' => 'li', 'escape'=>false, 'class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => '','tag' => 'li', 'before'=>'', 'after'=>''));
                echo $this->Paginator->next(__('next') . ' &rarr;', array('tag' => 'li','escape'=>false), null, array('tag' => 'li', 'escape'=>false, 'class' => 'next disabled'));
            ?>
            </ul>
        </div>
        </div>

<?php
    if($posts){
    $totalRow = count($posts);
    $i = 0;
?>

<div class="span8">
    <ul class="thumbnails">    
<?php
foreach ($posts as $post){    
?>
            <!--Displays Quizzes by Most Recently Created-->    
            <li class="span8">
                <div class="thumbnail">                  
                  <div class="caption">
                    <h4>
                        <a data-placement="right" data-content="<?php echo h($post['PracticeTest']['description']);?>" rel="popover" class="" href="<?php echo $this->Html->url("/quiz/" . $post['PracticeTest']['id'] . "-" . $post['PracticeTest']['slug'] . ".html"); ?>" data-original-title="<?php echo h($post['PracticeTest']['title']);?>">
                            <?php echo h($this->Text->excerpt($post['PracticeTest']['title'], null, 19, '...')); ?>
                        </a>
                    </h4>
                    <p><?php echo h($this->Text->excerpt($post['PracticeTest']['description'], null)); ?></p>
                    <div style="margin-bottom: 9px" class="btn-toolbar">
                        <div class="btn-group">
                            <p><span class="label" style="text-transform: none; font-style: italic; font-size: 12px; font-weight: normal"><?php echo h($post['User']['name'])." on ".$this->Time->niceShort($post['PracticeTest']['created']); ?></span></p>
                        </div>
                        <div class="btn-group pull-right">
                            <span class="label label-info"><?php echo h($post['PracticeTest']['likes']); ?> likes</span>
                            <span class="label"><?php echo h($post['PracticeTest']['dislikes']); ?> dislikes</span>
                        </div>
                    </div>
                  </div>
                </div>
              </li>             
              
<?php
    $i++;
}
?> 
    </ul>
</div>

<div class="span8">
    <!--Bottom Page Scroll-->
    <div class="pagination">
        <ul>
        <?php
            echo $this->Paginator->prev('&larr; ' . __('previous'), array('tag' => 'li','escape'=>false), null, array('tag' => 'li', 'escape'=>false, 'class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => '','tag' => 'li', 'before'=>'', 'after'=>''));
            echo $this->Paginator->next(__('next') . ' &rarr;', array('tag' => 'li','escape'=>false), null, array('tag' => 'li', 'escape'=>false, 'class' => 'next disabled'));
        ?>
        </ul>
    </div>
</div>
</div>
</div>



<?php }else{
    echo "<h3>Sorry, no content found.</h3>";
}?>