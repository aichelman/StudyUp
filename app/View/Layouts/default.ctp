<!DOCTYPE html>
<!--This file builds out the home page shell-->
<html lang="en">
  <head>
    <?php echo $this->Html->charset(); ?>
    <title>
        Study Up!
        <?php echo $title_for_layout; ?>
    </title>
    <meta name="description" content="">
    <meta name="author" content="">

    <?php
    if(Configure::read('debug') > 0){
        echo $this->Html->script('jquery/jquery-1.8.2.min');
    }else{
    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
    <script type="text/javascript" language="javascript"
            src="https://www.google.com/jsapi?key=ABQIAAAAEkMN-j2qpI1mLTSLd8rqrBSDkADYWJgeVp2QQf8WQ5D0s2Q90RS7-pWY3omCx9aNOInEzev6xsuT3Q">
    </script>

    <?php
    }
    ?>
    <script src="<?php echo $this->Html->url('/js/twitter/bootstrap.min.js');?>"></script>
    <!-- Le styles -->
    <link href="<?php echo $this->Html->url('/css/twitter/bootstrap.css');?>" rel="stylesheet">
    <link href="<?php echo $this->Html->url('/css/twitter/bootstrap-mycustomize.css');?>" rel="stylesheet">
    <?php echo $this->Html->css(array('/acl_management/css/social'));?>
    <?php
            echo $this->Html->meta('icon');
            echo $scripts_for_layout;       
    ?>
  </head>

  <body>
        <?php echo $this->element('front-top-nav');?>
        <article id="main" style="padding: 20px 0px 20px 0px;">

            <div class="container">
                <div class="row">
                    <div class="span12 columns">
                        <h3>Start preparing for your interviews here!</h3>
                        <p>This application tests you and helps you build your own study guides.</p>
                    </div>                   
                </div>
            </div>

        </article>
    

    
    <div class="container">        
        <div class="row">            
            <div class="span9">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $content_for_layout; ?>
            </div>
            <div class="span3" style="width:250px">
                <?php echo $this->requestAction('/topten', array('return'));?>
            </div>            
        </div>
    </div>
   

    <footer>
    <div class="footer-footer">
    <div class="container">
      <div class="row">
        <div class="span5">
          <h3>
            <a href="<?php echo $this->Html->url('/');?>">StudyUp</a>
          </h3>
          <p>
            COMP 426 Final Project
          </p>
        </div>
        <div class="span7">
          <div style="" class="pull-right">
            
          </div>
        </div>
      </div>
    </div>
    </div>
    </footer>    
    <?php echo $this->Html->script('jquery/jquery.simplemodal');?>  
    <script type="text/javascript">
    $(function () {
        if(jQuery().popover) {
            $("a[rel=popover]")
            .popover({
                offset: 10
            })
            .click(function(e) {
                //e.preventDefault()
            });        
        }
        
        $('.simple-modal-link').click(function (e) {
            $this = $(this);
            $href = $this.attr('href');
            $($href).modal();
            return false;               
        });
    });
    </script>
    <?php echo Configure::read('GA.embed_code');?>
  </body>
</html>
