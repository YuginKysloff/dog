<? defined('BASEPATH') OR exit('No direct script access allowed');?>

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
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="query" class="form-control"
                                       placeholder="Поиск">
                                <div class="input-group-btn">
                                    <button type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="text-red"><?=validation_errors();?></div>
                            </div>
                        </div>
                    </form>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">№</th>
                                    <th class="text-center">Фото</th>
                                    <th class="text-center">Логин</th>
                                    <th class="text-center">Имя</th>
                                    <th class="text-center">E-mail</th>
                                    <th class="text-center">Группа</th>
                                    <th class="text-center">Дата регистрации</th>
                                    <th class="text-center">Операции</th>
                                </tr>
                            </thead>
                            <tbody  id="users__list">
                            <? if(!empty($users)):?>
                                <? foreach($users as $val):?>
                                    <tr>
                                        <td class="text-center
                                            <? switch($val['group']):
                                                case 0:?>bg-red<? break;
                                                case 2:?>bg-blue
                                            <? endswitch;?>">
                                            #<?=$val['id'];?>
                                        </td>
                                        <td class="text-center">
                                            <a class="fancybox" rel="group<?=$val['id'];?>" href="/uploads/users/avatars/user<?=$val['id'];?>.jpg" title="<?=$val['login'];?>">
                                                <img src="/uploads/users/avatars/user<?=$val['id'];?>_thumb.jpg"
                                                     class="img-roundedimg-thumbnail"
                                                     alt="<?=$val['login'];?>" width="30" height="30">
                                            </a>
                                        </td>
                                        <td class="text-center"><a href="/admin/log/<?=$val['login'];?>"><?=$val['login'];?></a></td>
                                        <td class="text-center"><?=$val['name'];?></td>
                                        <td class="text-center"><?=$val['email'];?></td>
                                        <td class="text-center">
                                            <? switch($val['group']):
                                                case 1:?>Пользователь
                                                    <? break;
                                                case 2:?>Администратор
                                                    <? break;
                                                default:?>Заблокирован
                                            <? endswitch;?>
                                        </td>
                                        <td class="text-center"><?=date('d-m-Y H:i', $val['reg_date']);?></td>
                                        <td class="pointer text-center"><a href="/admin/users/edit/<?=md5($val['id']);?>"><i class="fa fa-edit"></i> - редактировать</a></td>
                                    </tr>
                                <? endforeach;?>
                            <? else:?>
                                <tr>
                                    <td colspan="8" class="text-center">Нет данных</td>
                                </tr>
                            <? endif;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?=$this->pagination->create_links() ?? '';?>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->