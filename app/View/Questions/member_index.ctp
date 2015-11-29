<?php
echo $this->Html->script(array(
    'jquery/json2',
    'jquery/tablednd/jquery.tablednd'
));
?>

<ul class="breadcrumb frontbreadcrumb">
    <li>
        <?php echo $this->Html->link('Home','/');?>
        <span class="divider">/</span>
    </li>
    <li>
        <?php echo $this->Html->link('Dashboard', array('controller'=>'practice_tests','action'=>'index'));?>
        <span class="divider">/</span>
    </li>
    <li class="active"><?php echo $this->Text->excerpt($practice_test_name, ''); ?></li>
    <li class="pull-right" style="margin: -5px;"><a class="btn btn-small btn-info" href="<?php echo $this->Html->url('/member/questions/add/'.$practice_test_id);?>"><i class="icon-pencil icon-white"></i> New Question</a></li>
</ul>
<div class="table-bordered bg-white" style="padding:20px">
    <table cellpadding="0" cellspacing="0" id="question_table" class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="40px" nowrap=""><?php echo __('Order'); ?></th>
                <th class="header"><?php echo $this->Paginator->sort('content'); ?></th>
                <th class="header" style="text-align: center; width:100px"><?php echo $this->Paginator->sort('published'); ?></th>
                <th class="header" style="text-align: center; width:200px"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($questions as $question): ?>
            <tr id="<?php echo $question['Question']['id']; ?>">
                <td class="dragHandle"></td>
                <td><?php echo h($question['Question']['content']); ?>&nbsp;</td>
                <td style="text-align: center">
                    <span style="cursor: pointer">
                        <?php
                        echo $this->Html->image('icons/allow-' . intval($question['Question']['published']) . '.png',
                                array('onclick' => 'published.toggle("status-' . $question['Question']['id'] . '",
                            "' . $this->Html->url(array('action' => 'toggle', $question['Question']['id'], (int) $question['Question']['published'], "published")) . '");',
                                    'id' => 'status-' . $question['Question']['id']
                        ));
                        ?>
                    </span>&nbsp;
                </td>
                <td style="text-align: center">
                    <span class="label link-white label-warning"><i class="icon-edit icon-white"></i> <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $practice_test_id, $question['Question']['id'])); ?></span>
                    <span class="label link-white label-important"><i class="icon-trash icon-white"></i> <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $practice_test_id, $question['Question']['id']), null, __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?></span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <p>
        <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            )); ?>
        </p>
        <ul>
            <?php
                echo $this->Paginator->prev('&larr; ' . __('previous'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'escape' => false, 'class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'before' => '', 'after' => ''));
                echo $this->Paginator->next(__('next') . ' &rarr;', array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'escape' => false, 'class' => 'next disabled'));
            ?>
        </ul>
    </div>
    <script type="text/javascript">
        var published = { toggle : function(id, url){ obj = $('#'+id).closest("span"); $.ajax({ url: url, type: "POST", success: function(response){ obj.html(response); } }); } };
        $(document).ready(function(){
            $('.asc').closest('th').addClass('headerSortDown');
            $('.desc').closest('th').addClass('headerSortUp');

            // Initialise the table dragable
            $("#question_table tr").hover(function() {
                $(this.cells[0]).addClass('showDragHandle');
            }, function() {
                $(this.cells[0]).removeClass('showDragHandle');
            });
            $("#question_table").tableDnD({
                dragHandle: "dragHandle",
                onDrop: function(table, row) {
                    var rows = table.tBodies[0].rows;
                    var newOrder = [];
                    for (var i=0; i<rows.length; i++) {
                        newOrder[i] = rows[i].id;
                    }
                    var params = { 'data[Question][ordered]': JSON.stringify(newOrder) };
                    $.post('<?php echo $this->Html->url('/member/questions/ordered');?>', params,
                        function(response){}
                    );                    
                }
            });
        });
    </script>
</div>