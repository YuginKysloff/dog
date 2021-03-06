<? defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Меню</li>
            <!-- Optionally, you can add icons to the links -->
            <li <? if($this->uri->segment(2) == 'statistics'):?>class="active"<? endif;?>>
                <a href="/admin/statistics">
                    <i class="fa fa-line-chart"></i>
                    <span>Статистика</span>
                </a>
            </li>
            <li <? if($this->uri->segment(2) == 'users'):?>class="active"<? endif;?>>
                <a href="/admin/users">
                    <i class="fa fa-users"></i>
                    <span>Пользователи</span>
                    <? if($last['users']):?>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-green"><?=$last['users'];?></small>
                        </span>
                    <? endif;?>
                </a>
            </li>
            <li <? if($this->uri->segment(2) == 'log'):?>class="active"<? endif;?>>
                <a href="/admin/log">
                    <i class="fa fa-book"></i>
                    <span>Журнал событий</span>
                </a>
            </li>
            <li <? if($this->uri->segment(2) == 'warning'):?>class="active"<? endif;?>>
                <a href="/admin/warning">
                    <i class="fa fa-warning"></i>
                    <span>Предупреждения</span>
                    <? if($last['warn']):?>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-red"><?=$last['warn'];?></small>
                        </span>
                    <? endif;?>
                </a>
            </li>
            <li>
                <a href="/admin/logout">
                    <i class="fa fa-sign-out"></i>
                    <span>Выход</span>
                </a>
            </li>
<!--            <li class="treeview">-->
<!--                <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>-->
<!--            <span class="pull-right-container">-->
<!--              <i class="fa fa-angle-left pull-right"></i>-->
<!--            </span>-->
<!--                </a>-->
<!--                <ul class="treeview-menu">-->
<!--                    <li><a href="#">Link in level 2</a></li>-->
<!--                    <li><a href="#">Link in level 2</a></li>-->
<!--                </ul>-->
<!--            </li>-->
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>