<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Пользователи
            <small>Редактирование пользователя <?=$user['login'];?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/users"><i class="fa fa-users"></i> Пользователи</a></li>
            <li class="active">Редактирование</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Данные пользователя <?=$user['login'];?></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" accept-charset="utf-8" enctype="multipart/form-data" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="login" class="col-sm-3 control-label">Логин</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="login" id="login" value="<?=set_value('login', $user['login']);?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Имя</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name" value="<?=set_value('name', $user['name']);?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email" value="<?=set_value('email', $user['email']);?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Новый пароль</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" id="password" value="<?=set_value('password');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="conf_password" class="col-sm-3 control-label">Повторить</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="conf_password" id="conf_password" value="<?=set_value('conf_password');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Группа</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="group">
                                        <option value="0" <?=($user['group'] == 0) ? 'selected' : '';?>>Заблокированы</option>
                                        <option value="1" <?=($user['group'] == 1) ? 'selected' : '';?>>Пользователи</option>
                                        <option value="2" <?=($user['group'] == 2) ? 'selected' : '';?>>Администраторы</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="userfile" class="col-sm-3 control-label">Загрузить фото</label>
                                <div class="col-sm-9">
                                    <input type="file" name="userfile" id="userfile">
                                    <p class="help-block">Загрузка фото для аватарки.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary center-block">
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- right column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Дополнительная информация</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Дата регистрации</td>
                                    <td><?=date('d-m-Y h:i', $user['reg_date']);?></td>
                                </tr>
                                <tr>
                                    <td>Дата последней активности</td>
                                    <td><?=date('d-m-Y h:i', $user['last_date']);?></td>
                                </tr>
                                <tr>
                                    <td>IP регистрации</td>
                                    <td><?=$user['reg_ip'];?></td>
                                </tr>
                                <tr>
                                    <td>IP последней активности</td>
                                    <td><?=$user['reg_ip'];?></td>
                                </tr>
                                <tr>
                                    <td>Ссылка регистрации</td>
                                    <td><?=$user['reg_link'];?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">Аватар</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <img src="/uploads/users/avatars/user<?=$user['id'];?>.jpg"
                                             alt="<?=$user['login'];?>" class="img-thumbnail" width="160" height="160">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->