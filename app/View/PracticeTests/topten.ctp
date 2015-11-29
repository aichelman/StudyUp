<ul class="breadcrumb" style="margin-bottom: 5px">
    <li>
        <h4>Top Quiz</h4>
    </li>
</ul>
<div>
    <table cellpadding="0" cellspacing="0" id="practice_table" class="table table-bordered" style="background-color:#FFFFFF">
        <tbody>
        <?php
        foreach ($FavouritePracticeTests as $practiceTest):
        ?>
        <tr id="<?php echo $practiceTest['PracticeTest']['id']; ?>">
            <td>
                <p>
                    <a data-placement="bottom" data-content="<?php echo h($practiceTest['PracticeTest']['description']);?>" rel="popover" class="" href="<?php echo $this->Html->url('/quiz/'. $practiceTest['PracticeTest']['id'].'-'.$practiceTest['PracticeTest']['slug'].'.html');?>" data-original-title="<?php echo h($practiceTest['PracticeTest']['title']);?>">
                    <?php echo $this->Text->excerpt(h($practiceTest['PracticeTest']['title']), null, 20); ?>
                    </a>
                </p>
                <p class="pull-right">
                    <span class="label label-info"><?php echo h($practiceTest['PracticeTest']['likes']); ?> likes</span>
                    <span class="label"><?php echo h($practiceTest['PracticeTest']['dislikes']); ?> dislikes</span>
                </p>
            </td>

        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>