<style>
  #test-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
  #test-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
  #test-list li:hover{background:#F0F0F0;}
  #search-box{margin-left: 20px;}
  #submit{margin-bottom: 9px;}
  #sorting{float:right;}
</style>

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

<!--search bar-->
<div class="Search">
	<input type="text" id="search-box" placeholder="Quiz Name" />
  <button type="button" id="submit" onclick="submit()">Submit</button>
  <select id="sorting" onchange="sort()">
    <option value="" disabled selected>Sort tests by:</option>
    <option value="title">Title (alphabetical)</option>
    <option value="n2o">Newest to Oldest</option>
    <option value="o2n">Oldest to Newest</option>
    <option value="numOfLikesDesc">Number of likes (descending)</option>
    <option value="numOfLikesAsc">Number of likes (ascending)</option>
  </select>
	<div id="suggesstion-box">
    <ul id="test-list">
    </ul>
  </div>
</div>

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

<script type="text/javascript">
//autocomplete
$(document).ready(function(){
	$("#search-box").keyup(function(e){
    if(e.keyCode == 8){
      $('.span8').show();
    }
    $("#suggesstion-box ul").empty();
    var tests = "";
    var i = 0;
    <?php
    foreach ($posts as $post){
    ?>
      var data = "<?php echo h($this->Text->excerpt($post['PracticeTest']['title'], null, 19, '...')); ?>";
      if($(this).val().length!=0 && data.substring(0,$(this).val().length).toLowerCase() == $(this).val()){
        if(i=0){
          tests = tests+data;
        }else{
          tests = tests+","+data;
        }
        i++;
      }
    <?php
    }
    ?>
      if(tests.length>0){
        var arr = tests.split(",");
  			$("#suggesstion-box").show();
        $.each(arr, function(index, value) {
          if(index == 0){
            return true;
          }
          $("#suggesstion-box ul").append('<li onClick="selectTest(&quot;'+value+'&quot;)">'+value+'</li>');
        });
  			$("#search-box").css("background","#FFF");
      }else{
        $("#suggesstion-box ul").empty();
        $("#suggesstion-box").hide();
      }
	});
});
//select test name
function selectTest(val) {
  $("#search-box").val(val);
  $("#suggesstion-box").hide();
}
function submit() {
  $('.span8').show();
  var testTitle = $("#search-box").val();
  var a = $('.thumbnail a').not("[data-original-title='"+testTitle+"']");
  a.parent().parent().parent().parent().hide();
}
function sort(){
  var nameArray = [];
  var dateArray = [];
  var likesArray = [];
  switch($('#sorting').val()) {
    case "title":
      $('.caption').each(function() {
        nameArray.push($(this).children("h4").children().data('original-title'));
      });
      nameArray.sort();
      for(i = 1; i < nameArray.length; i++){
        var a = $(".thumbnail a[data-original-title='"+nameArray[i-1]+"']");
        var b = $(".thumbnail a[data-original-title='"+nameArray[i]+"']");
        $( b.parent().parent().parent().parent() ).insertAfter( a.parent().parent().parent().parent() );
      }
      break;

      case "n2o":
        $('.caption').each(function() {
          var string = $(this).children("div").children(".btn-group").children().children().text();
          var stringArray = string.split(" ");
          var dateTime = "";
          for(i = 0; i < stringArray.length; i++){
            if(!isNaN(stringArray[i].substring(0, 2))){
              dateTime+=stringArray[i];
            }
          }
          dateArray.push(dateTime);
        });
        dateArray.sort();
        for(i = dateArray.length-1; i > 0; i--){
          var a = $(".thumbnail span:contains('"+dateArray[i].replace(",",", ")+"')");
          var b = $(".thumbnail span:contains('"+dateArray[i-1].replace(",",", ")+"')");
          $( b.parent().parent().parent().parent().parent().parent() ).insertAfter( a.parent().parent().parent().parent().parent().parent() );
        }

        break;

        case "o2n":
          $('.caption').each(function() {
            var string = $(this).children("div").children(".btn-group").children().children().text();
            var stringArray = string.split(" ");
            var dateTime = "";
            for(i = 0; i < stringArray.length; i++){
              if(!isNaN(stringArray[i].substring(0, 2))){
                dateTime+=stringArray[i];
              }
            }
            dateArray.push(dateTime);
          });
          dateArray.sort();
          for(i = 1; i < dateArray.length; i++){
            var a = $(".thumbnail span:contains('"+dateArray[i-1].replace(",",", ")+"')");
            var b = $(".thumbnail span:contains('"+dateArray[i].replace(",",", ")+"')");
            $( b.parent().parent().parent().parent().parent().parent() ).insertAfter( a.parent().parent().parent().parent().parent().parent() );
          }
          break;

          case "numOfLikesDesc":
          $('.caption').each(function() {
              var quizUrl = $(this).children("h4").children().attr('href');
              var likes = $(this).children("div").children(".btn-group.pull-right").children("span.label.label-info").text();
              var string = likes+","+quizUrl;
              likesArray.push(string);
          });
          likesArray.sort();
          for(i = likesArray.length-1; i > 0; i--){
            var a = $(".thumbnail a[href='"+likesArray[i].substr(likesArray[i].indexOf(",") + 1)+"']");
            var b = $(".thumbnail a[href='"+likesArray[i-1].substr(likesArray[i-1].indexOf(",") + 1)+"']");
            $( b.parent().parent().parent().parent() ).insertAfter( a.parent().parent().parent().parent() );
          }
          break;

          case "numOfLikesAsc":
          $('.caption').each(function() {
              var quizUrl = $(this).children("h4").children().attr('href');
              var likes = $(this).children("div").children(".btn-group.pull-right").children("span.label.label-info").text();
              var string = likes+","+quizUrl;
              likesArray.push(string);
          });
          likesArray.sort();
          for(i = 1; i < likesArray.length; i++){
            var a = $(".thumbnail a[href='"+likesArray[i-1].substr(likesArray[i-1].indexOf(",") + 1)+"']");
            var b = $(".thumbnail a[href='"+likesArray[i].substr(likesArray[i].indexOf(",") + 1)+"']");
            $( b.parent().parent().parent().parent() ).insertAfter( a.parent().parent().parent().parent() );
          }
          break;


  }

}
</script>

<?php }else{
    echo "<h3>Sorry, no content found.</h3>";
}?>
