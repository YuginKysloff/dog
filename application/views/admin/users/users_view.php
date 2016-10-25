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
                                    <th>Логин/ФИО</th>
                                    <th>E-mail/Ссылка</th>
                                    <th>Группа/Статус</th>
                                    <th>IP рег/активн</th>
                                    <th>Дата рег/активн</th>
                                    <th>Операции</th>
                                </tr>
                            </thead>
                            <tbody  id="users__list">
                            <? if($users):?>
                                <? foreach($users as $val):?>
                                    <tr>
                                        <td>#<?=$val['id'];?></td>
                                        <td><a href="/admin/log/index/<?=$val['login'];?>"><?=$val['login'];?></a></td>
                                        <td><?=$val['email'];?></td>
                                        <td><?=($val['group'] < 2) ? 'Пользователи' : 'Администраторы';?></td>
                                        <td><?=$val['reg_ip'];?></td>
                                        <td><?=date('d-m-Y H:i', $val['reg_date']);?></td>
                                        <td><i class="fa fa-edit"></i> - редактировать</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><?=$val['name'];?></td>
                                        <td><a href="http://<?=$val['reg_link'];?>" target="_blank"><?=(strlen($val['reg_link']) > 40) ? substr($val['reg_link'], 0, 40).'...' : $val['reg_link'];?></a></td>
                                        <td>
                                            <? if($val['status'] == 0):?>
                                                <span class="label label-danger users__status">Отключен</span>
                                            <? else:?>
                                                <span class="label label-success users__status">Активен</span>
                                            <? endif;?>
                                        </td>
                                        <td <?=($val['reg_ip'] != $val['last_ip']) ? 'class="text-red"' : '';?>><?=$val['last_ip'];?></td>
                                        <td><?=date('d-m-Y H:i', $val['last_date']);?></td>
                                        <td></td>
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

