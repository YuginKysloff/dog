<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Пользователи
            <small>информация о пользователях</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-users"></i> Пользователи</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" accept-charset="utf-8" class="form-inline">
                        <div class="box-header">
                            <div class="input-group input-group-sm col-sm-1">
                                <select name="case" class="form-control">
                                    <option value="1" selected>!Abc</option>
                                    <option value="2">Abc</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm col-sm-1">
                                <select name="like" class="form-control">
                                    <option value="1" selected>LIKE</option>
                                    <option value="2">% LIKE</option>
                                    <option value="3">LIKE %</option>
                                    <option value="4">% LIKE %</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm col-sm-1">
                                <select name="field" class="form-control">
                                    <option value="1" selected>Логин</option>
                                    <option value="2">E-mail</option>
                                    <option value="3">IP</option>
                                </select>
                            </div>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="login" class="form-control pull-right"
                                           placeholder="Поиск">
                                    <div class="input-group-btn">
                                        <button type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Фото</th>
                                    <th>Логин</th>
                                    <th>Имя</th>
                                    <th>E-mail</th>
                                    <th>Группа</th>
                                    <th>Дата регистрации</th>
                                    <th>Операции</th>
                                </tr>
                            </thead>
                            <tbody  id="users__list">
                            <? if(isset($users)):?>
                                <? foreach($users as $val):?>
                                    <tr>
                                        <td <? switch($val['group']):
                                                case 0:?>class="bg-red"<? break;
                                                case 2:?>class="bg-blue"
                                            <? endswitch;?>>
                                            #<?=$val['id'];?>
                                        </td>
                                        <td>
                                            <img src="/uploads/users/avatars/user<?=$val['id'];?>.jpg"
                                                 class="img-roundedimg-thumbnail"
                                                 alt="<?=$val['login'];?>" width="30" height="30">
                                        </td>
                                        <td><a href="/admin/log/index/<?=$val['login'];?>"><?=$val['login'];?></a></td>
                                        <td><?=$val['name'];?></td>
                                        <td><?=$val['email'];?></td>
                                        <td>
                                            <? switch($val['group']):
                                                case 1:?>Пользователь
                                                    <? break;
                                                case 2:?>Администратор
                                                    <? break;
                                                default:?>Заблокирован
                                            <? endswitch;?>
                                        </td>
                                        <td><?=date('d-m-Y H:i', $val['reg_date']);?></td>
                                        <td class="btn"><a href="/admin/users/edit/<?=md5($val['id']);?>"><i class="fa fa-edit"></i> - редактировать</a></td>
                                    </tr>
                                <? endforeach;?>
                            <? else:?>
                                <tr>
                                    <td colspan="7" class="text-center">Нет данных</td>
                                </tr>
                            <? endif;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?=$this->pagination->create_links();?>
                    </div>
                </div>
                <!-- /.box -->
<!--                --><?//=$this->pagination->create_links();?>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->