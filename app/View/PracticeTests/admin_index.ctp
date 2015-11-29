<?php echo $this->Html->script(array(
        'jquery/json2',
        'jquery/tablednd/jquery.tablednd'
    ));?>
<div class="practiceTests">
    <table cellpadding="0" cellspacing="0" id="practice_table" class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
            <th class="header"><?php echo $this->Paginator->sort('title');?></th>
            <th class="header" style="text-align: center; width:150px"><?php echo $this->Paginator->sort('created');?></th>
            <th class="header" style="text-align: center; width:150px"><?php echo $this->Paginator->sort('published');?></th>
            <th class="header" style="text-align: center; width:250px"><?php echo __('Actions');?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($practiceTests as $practiceTest):
        ?>
        <tr id="<?php echo $practiceTest['PracticeTest']['id']; ?>">
            <td>                
                <a data-placement="right" data-content="<?php echo h($practiceTest['PracticeTest']['description']);?>" rel="popover" class="" href="<?php echo $this->Html->url(array('controller'=>'questions', 'action' => 'index', $practiceTest['PracticeTest']['id']));?>" data-original-title="<?php echo h($practiceTest['PracticeTest']['title']);?>">
                <?php echo $this->Text->excerpt(h($practiceTest['PracticeTest']['title']), null, 20); ?>
                </a>
                <span class="label"><em><?php echo h($practiceTest['User']['name']); ?></em></span>
                <span class="label label-info link-white"><a href="<?php echo $this->Html->url('/practice_tests/view/'.$practiceTest['PracticeTest']['id'].'-'.$practiceTest['PracticeTest']['slug']);?>" target="_blank"><i class="icon-search icon-white"></i> View</a></span>
            </td>
            <td style="text-align: center"><?php echo h($practiceTest['PracticeTest']['created']); ?>&nbsp;</td>
            <td style="text-align: center">
                <span style="cursor: pointer">
                <?php
                switch ($practiceTest['PracticeTest']['published']){
                    case 2:
                        echo '<i class="icon-headphones"></i> '.$this->Html->link('Awaiting Approval', 'javascript:;;',
                            array(
                                'onclick' => 'published.toggle("status-'.$practiceTest['PracticeTest']['id'].'","'.$this->Html->url(array('action'=>'toggle', $practiceTest['PracticeTest']['id'], 0, "published")).'");',
                                'id' => 'status-'.$practiceTest['PracticeTest']['id'],

                        ));
                    break;                 
                    case 1:
                        echo '<a rel="tooltip" href="#" data-original-title="Approve Quiz">';
                        echo $this->Html->image('icons/allow-' . intval($practiceTest['PracticeTest']['published']) . '.png',
                                array('onclick' => 'published.toggle("status-'.$practiceTest['PracticeTest']['id'].'",
                                        "'.$this->Html->url(array('action'=>'toggle', $practiceTest['PracticeTest']['id'], (int)$practiceTest['PracticeTest']['published'], "published")).'");',
                                        'id' => 'status-'.$practiceTest['PracticeTest']['id']
                        ));
                        echo '</a>';
                    break;
                    case 0:
                        echo '<a rel="tooltip" href="#" data-original-title="Disabled Quiz">';
                        echo $this->Html->image('icons/allow-' . intval($practiceTest['PracticeTest']['published']) . '.png',
                                array('onclick' => 'published.toggle("status-'.$practiceTest['PracticeTest']['id'].'",
                                        "'.$this->Html->url(array('action'=>'toggle', $practiceTest['PracticeTest']['id'], (int)$practiceTest['PracticeTest']['published'], "published")).'");',
                                        'id' => 'status-'.$practiceTest['PracticeTest']['id']
                        ));
                        echo '</a>';
                    break;
                }               
                ?>
                </span>&nbsp;
            </td>
            <td style="text-align: center">
                <span class="label label-info link-white"><i class="icon-question-sign icon-white"></i> <?php echo $this->Html->link(__('Questions'), array('controller'=>'questions', 'action' => 'index', $practiceTest['PracticeTest']['id'])); ?></span>
                <span class="label label-warning link-white"><i class="icon-edit icon-white"></i> <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $practiceTest['PracticeTest']['id'])); ?></span>
                <span class="label label-important link-white"><i class="icon-trash icon-white"></i> <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $practiceTest['PracticeTest']['id']), null, __('Are you sure you want to delete `%s`?', $practiceTest['PracticeTest']['title'])); ?></span>
                <?php /* echo $this->Html->link('<i class="icon-question-sign icon-white"></i> '.__('Questions'), array('controller'=>'questions', 'action' => 'index', $practiceTest['PracticeTest']['id']), array('escape'=>false, 'class'=>'btn btn-info btn-small')); ?>
                <?php echo $this->Html->link('<i class="icon-edit icon-white"></i> '.__('Edit'), array('action' => 'edit', $practiceTest['PracticeTest']['id']), array('escape'=>false, 'class'=>'btn btn-warning btn-small')); ?>
                <?php echo $this->Form->postLink('<i class="icon-trash icon-white"></i> '.__('Delete'), array('action' => 'delete', $practiceTest['PracticeTest']['id']), array('escape'=>false, 'class'=>'btn btn-danger btn-small'), __('Are you sure you want to delete # %s?', $practiceTest['PracticeTest']['id'])); */?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
    <p>
        <?php echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));?>
    </p>
    <ul>
        <?php
        echo $this->Paginator->prev('&larr; ' . __('previous'), array('tag' => 'li','escape'=>false), null, array('tag' => 'li', 'escape'=>false, 'class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => '','tag' => 'li', 'before'=>'', 'after'=>''));
        echo $this->Paginator->next(__('next') . ' &rarr;', array('tag' => 'li','escape'=>false), null, array('tag' => 'li', 'escape'=>false, 'class' => 'next disabled'));
        ?>
    </ul>
    </div>
   
<script type="text/javascript">
    var published = { toggle : function(id, url){ obj = $('#'+id).closest("span"); $.ajax({ url: url, type: "POST", success: function(response){ obj.html(response); } }); } };
    $(document).ready(function(){
            $('.asc').closest('th').addClass('headerSortDown');
            $('.desc').closest('th').addClass('headerSortUp');       
    });

    $(function () {
        $("a[rel=tooltip]").tooltip('hide');
        
        $("a[rel=popover]")
        .popover({
            offset: 10
        })
//        .click(function(e) {
//            e.preventDefault()
//        })
    });
</script>

</div>
