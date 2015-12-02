<?php echo $this->Html->script('application/quiz/vote_share');?>
<?php echo $this->element('breadcrumb');?>

<div class="span9" style="margin-left: 0px;">
<div class="table-bordered bg-white" style="padding:20px">
        <div class="posts">
            <!--Echos Title, Date Created, and Description-->
            <h3><a href="<?php echo $this->Html->url("/practice_tests/view/" . $post['PracticeTest']['id']."-".$post['PracticeTest']['slug']); ?>"><?php echo h($post['PracticeTest']['title']); ?></a></h3>
            <p><span class="label" style="text-transform: none; font-style: italic; font-size: 12px; font-weight: normal"><?php echo h($post['User']['name'])." on ".$this->Time->niceShort($post['PracticeTest']['created']); ?></span></p>
            <p><?php echo h($post['PracticeTest']['description']); ?></p>
        </div>
        <!--Builds like, dislike, and social media buttons-->
        <div style="margin-bottom: 9px" class="btn-toolbar">
            <div class="btn-group">
                <a href="javascript:;;" class="btn btnVote" id="button-likes" method="likes"><i class="icon-heart"></i> Like</a>
                <a href="javascript:;;" class="btn btnVote" id="button-dislikes" method="dislikes">Dislike</a>
            </div>
            <div class="btn-group">
                <a href="javascript:;;" class="btn btn-primary" id="button-share"><i class="icon white user"></i> Share</a>
            </div>
            <div class="btn-group pull-right">
                <span class="label label-info"><?php echo h($post['PracticeTest']['likes']); ?> likes</span>
                <span class="label"><?php echo h($post['PracticeTest']['dislikes']); ?> dislikes</span>
            </div>
        </div>
        <!--Prevents unknown users from liking/disliking-->
        <div class="alert alert-info fade in" id="auth-voted" style="display: none">
                    <a href="javascript:;;"  class="close">×</a>
                    <a href="<?php echo $this->Html->url('/users/login');?>">Sign in</a> or <a href="<?php echo $this->Html->url('/users/register');?>">sign up</a> now!
        </div>
        <!--Social Media Modal-->
        <div class="alert alert-info fade in" id="alert-dislikes" style="display: none">
                    <a href="javascript:;;" class="close">×</a>
                    You disliked this quiz. Thanks for the feedback!
        </div>
        <div class="alert alert-info fade in" id="alert-likes" style="display: none">
            <a href="javascript:;;" class="close">×</a>
            <div class="row" id="message">
                <div class="span5">
                    <strong>Thanks!</strong> Share it with your friends!
                </div>
            </div>
            <div class="row">
                <div class="span5">
                    <table class="table" style="border: none; margin-bottom: 0px;">
                        <tr>
                            <td style="border-top: 0px; border-left:0px"><a name="fb_share"></a></td>
                            <td style="border-top: 0px; border-left:0px"><a href="https://twitter.com/share" class="twitter-share-button" data-related="jasoncosta" data-lang="en" data-size="medium" data-count="none">Tweet</a></td>
                            <td style="border-top: 0px; border-left:0px"><g:plusone size="medium" annotation="none"></g:plusone></td>
                            <td style="border-top: 0px; border-left:0px">
                                <div class="controls">
                                  <input type="text" value="<?php echo FULL_BASE_URL.$this->here;?>" onclick="this.select();" id="focusedInput" class="input-xlarge focused">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="border-top: 0px; border-left:0px">
                                <div class="control-group">
                                <label for="textarea" class="control-label">Embed code</label>
                                <div class="controls">
                                    <textarea onclick="this.select();" id="focusedInput" class="input-xxlarge focused">&lt;div id=&quot;quiz-content&quot;&gt;&lt;/div&gt;&lt;script type=&quot;text/javascript&quot; src=&quot;<?php echo FULL_BASE_URL.$this->base;?>/openquiz.js?id=<?php echo $post['PracticeTest']['id'];?>&quot;&gt;&lt;/script&gt;&lt;script type=&quot;text/javascript&quot;&gt;$(function(){$('#quiz-content').sliding_quiz (openquiz);});&lt;/script&gt;</textarea>
                                </div>
                            </td>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!--Calls Openquiz.js to build quiz interface-->
        <div id="quiz-content"></div>
        <?php echo $this->Html->script(array('/openquiz.js?id='.$post['PracticeTest']['id']));?>
        <script type="text/javascript">
        $(function(){
            $('#quiz-content').sliding_quiz (openquiz);
        });
        </script>
</div>
</div>

<script type="text/javascript">
$(function(){
    $(document).vote_share({vote_url:'<?php echo $this->Html->url('/practice_tests/vote/'.$id);?>'});
});
</script>    
<?php
if($dislikes){
    echo '<script>$("#button-dislikes").addClass(\'active\'); </script>';
}
if($likes){
    echo '<script>$("#button-likes").addClass(\'active\'); </script>';
}
?>
<!--Facebook-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=228257440599200";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
<!--Twitter-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<!--Google Plus-->
<script type="text/javascript">
    (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
  
    $(function(){
        $('.close').bind('click', function () {
            $(this).parent().hide();
        });      
    });
    
</script>