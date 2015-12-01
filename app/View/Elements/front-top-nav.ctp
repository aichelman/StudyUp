<div class="navbar navbar-fixed-top" style="position:absolute">
    <div class="navbar-inner">
        <div class="container" style="padding-top: 10px;">
            <a href="<?php echo $this->Html->url('/'); ?>" class="brand" style="margin-top:-15px; margin-bottom:-10px">
                <img src="<?php echo $this->Html->url('/img/front/logo.png');?>">
            </a>
            <div class="nav-collapse">
                <ul class="nav">
                    <?php $homeActive = ($this->request->params['controller']=='pages') ? '' : 'active'; ?>
                    <?php $aboutActive = ($this->request->params['controller']=='pages') ? 'active' : ''; ?>
                    <li class="<?php echo $homeActive;?>"><a href="<?php echo $this->Html->url('/'); ?>">Home</a></li>
                </ul>
                <div class="row pull-right">
                    <div class="span7" style="text-align: right">
                         <?php
                            if($this->Session->read('Auth.User')):
                         ?>
                        <div class="btn-toolbar" style="margin-top:0px">
                        <?php
                            if($this->Session->read('Auth.User.group_id') == 1):
                        ?>
                                <div class="btn-group">
                        <?php
                                echo $this->Html->link('Admin Dasboard', '/admin/dashboards', array("class"=>"btn btn-small btn-danger"));
						?>
                                </div>
                        <?php else: ?>
                        <div class="btn-group">
                            <a class="btn btn-small btn-danger">Experience Points: </a>
                        </div>
                                <div class="btn-group">
                                    <a href="<?php echo $this->Html->url('/member/practice_tests/'); ?>" class="btn"><i class="icon white user"></i> Dashboard</a>
                                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></a>
                                    <ul class="dropdown-menu" style="text-align: left">
                                        <li><a href="<?php echo $this->Html->url('/member/practice_tests/'); ?>"><i class="icon-th-list"></i> Dashboard</a></li>
                                        <li><a href="<?php echo $this->Html->url('/member/practice_tests/add'); ?>"><i class="icon-pencil"></i> New Quiz</a></li>
                                    </ul>
                                </div>
						<?php
                            endif;
                        ?>		
                                <div class="btn-group">
                         <?php
                                echo $this->Html->link('Sign Out', '/users/logout', array("class"=>"btn btn-small btn-warning"));
                         ?>
                                </div>
                        </div>
                        <?php
                            else:
                                echo $this->Html->link('Sign Up', '/users/register', array("class"=>"btn")).'&nbsp;';
                                echo $this->Html->link('Sign In', '/users/login', array("class"=>"btn btn-info"));
                            endif;
                        ?>
                    </div>
                </div>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $('#countries').bind('change', {}, function(){
        obj = $(this);
        id = $(this).val();
        $.post('<?php echo $this->Html->url('/countries/change');?>', {'data[Country][id]' : id}, function(response){
            window.location.href = '/';
        });
    });
});
</script>