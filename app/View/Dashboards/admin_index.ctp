<?php echo $this->Html->script(array(
        'jquery/json2',
        'jquery/tablednd/jquery.tablednd'
    ));
	if(isset($flot_data_views) && isset($flot_data_visits)){
		echo $this->element('google_analytics', array('flot_data_views'=>$flot_data_views, 'flot_data_visits'=>$flot_data_visits));
	}
?>
<div class="row">
<div class="span6">
<h3>New Quizzes</h3><hr/>
<div class="practiceTests">
    <table cellpadding="0" cellspacing="0" id="practice_table" class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
            <th class="header"><?php echo 'Title';?></th>
            <th class="header" style="text-align: center; width:150px"><?php echo 'Status';?></th>
        </tr>
        </thead>
        <tbody>

        <!--displays most recent quizzes-->
        <?php
        foreach ($practiceTests as $practiceTest):
        ?>
        <tr id="<?php echo $practiceTest['PracticeTest']['id']; ?>">
            <td>
                <!--Quiz Attributes-->
                <a data-placement="right" data-content="<?php echo h($practiceTest['PracticeTest']['description']);?>" href="<?php echo $this->Html->url(array('controller'=>'questions', 'action' => 'index', $practiceTest['PracticeTest']['id']));?>" data-original-title="<?php echo h($practiceTest['PracticeTest']['title']);?>">
                <?php echo $this->Text->excerpt(h($practiceTest['PracticeTest']['title']), null, 20); ?>
                </a>
                <span class="label"><em><?php echo h($practiceTest['User']['name']); ?></em></span>
                <span class="label label-info link-white"><a href="<?php echo $this->Html->url('/practice_tests/view/'.$practiceTest['PracticeTest']['id'].'-'.$practiceTest['PracticeTest']['slug']);?>" target="_blank"><i class="icon-search icon-white"></i> View</a></span>
            </td>
            <td style="text-align: center">
                <!--Awaiting approval, live, or off status icon-->
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
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>

<div class="span6">
<h3>Top Quizzes</h3><hr/>
<div class="practiceTests">
    <table cellpadding="0" cellspacing="0" id="practice_table" class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
            <th class="header"><?php echo 'Title';?></th>
            <th class="header" style="text-align: center; width:150px"><?php echo '#';?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($FavouritePracticeTests as $practiceTest):
        ?>
        <tr id="<?php echo $practiceTest['PracticeTest']['id']; ?>">
            <td>
                <!--Quiz Attributes-->
                <a data-placement="right" data-content="<?php echo h($practiceTest['PracticeTest']['description']);?>" class="" href="<?php echo $this->Html->url(array('controller'=>'questions', 'action' => 'index', $practiceTest['PracticeTest']['id']));?>" data-original-title="<?php echo h($practiceTest['PracticeTest']['title']);?>">
                <?php echo $this->Text->excerpt(h($practiceTest['PracticeTest']['title']), null, 20); ?>
                </a>
                <span class="label"><em><?php echo h($practiceTest['User']['name']); ?></em></span>
                <span class="label label-info link-white"><a href="<?php echo $this->Html->url('/practice_tests/view/'.$practiceTest['PracticeTest']['id'].'-'.$practiceTest['PracticeTest']['slug']);?>" target="_blank"><i class="icon-search icon-white"></i> View</a></span>
            </td>
            <td style="text-align: center">
                <!--likes and dislike count-->
                <span class="label label-warning"><?php echo h($practiceTest['PracticeTest']['likes']); ?> likes</span>
                <span class="label"><?php echo h($practiceTest['PracticeTest']['dislikes']); ?> dislikes</span>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<h3>New Members</h3><hr/>
<div class="practiceTests">
    <table cellpadding="0" cellspacing="0" id="practice_table" class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
            <th class="header"><?php echo 'Name';?></th>
            <th class="header" style="text-align: center; width:150px"><?php echo 'Created';?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $user):
        ?>
        <tr id="<?php echo $user['User']['id']; ?>">
            <td>
                <a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'edit', $user['User']['id']));?>" target="_blank">
                <?php echo h($user['User']['name']); ?>
                </a>
            </td>
            <td style="text-align: center">
                 <?php echo h($user['User']['created']); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
</div>
<script type="text/javascript">
    //AJAX/RESTfully change status of quiz
    var published = { 
        toggle : function(id, url) { 
            obj = $('#'+id).closest("span"); 
            $.ajax({ url: url, type: "POST", success: function(response){ obj.html(response); } }); 
                                    } 
    };


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