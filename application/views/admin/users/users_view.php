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
                    <div class="box-header">
                        <h3 class="box-title">Пользователи</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                       placeholder="Поиск">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <? if($users):?>
                                <? foreach($users as $val):?>
                                    <tr>
                                        <td>#<?=$val['id'];?></td>
                                        <td>
                                            <img src="/uploads/users/avatars/user<?=$val['id'];?>.jpg"
                                                 class="img-roundedimg-thumbnail"
                                                 alt="<?=$val['login'];?>" width="30" height="30">
                                        </td>
                                        <td><a href="/admin/log/index/<?=$val['login'];?>"><?=$val['login'];?></a></td>
                                        <td><?=$val['name'];?></td>
                                        <td><?=$val['email'];?></td>
                                        <td id="group_<?=$val['id'];?>">
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
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->