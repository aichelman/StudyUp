<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="i-bar"></span>
                <span class="i-bar"></span>
                <span class="i-bar"></span>
            </a>
            <a class="brand" href="<?php echo $this->Html->url('/');?>">StudyUp</a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="">
                        <a href="<?php echo $this->Html->url('/admin/dashboards/index');?>">Dashboard</a>
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Manage Quiz<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Html->url('/admin/practice_tests/index');?>"><?php echo __('Manage Quiz');?></a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $this->Html->url('/admin/practice_tests/add');?>"><?php echo __('New Quiz');?></a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Users <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <!-- <li><a href="<?php echo $this->Html->url('/admin/user_permissions');?>"><?php echo __('Permission');?></a></li>
                            <li class="divider"></li> -->
                            <li><a href="<?php echo $this->Html->url('/admin/users');?>"><?php echo __('Manage Users');?></a></li>
                            <li><a href="<?php echo $this->Html->url('/admin/users/add');?>"><?php echo __('New User');?></a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $this->Html->url('/admin/groups');?>"><?php echo __('Manage Groups');?></a></li>
                            <!-- <li><a href="<?php echo $this->Html->url('/admin/groups/add');?>"><?php echo __('New Group');?></a></li> -->
                        </ul>
                    </li>
                </ul>
        <?php
        if($this->Session->check('Auth.User.id')){
        ?>
        <ul class="nav pull-right">
          <li class=""><a>Hi, <?php echo $this->Session->read('Auth.User.name');?></a></li>
          <li class=""><?php echo $this->Html->link('Logout', '/users/logout');?></li>
        </ul>
        <?php
        }
        ?>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>