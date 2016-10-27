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
                    <form method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Логин</label>
                                <input type="text" name="login" class="form-control" id="exampleInputEmail1" placeholder="Введите логин">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Имя</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Введите имя">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Введите email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Пароль</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Введите новый пароль">
                            </div>
                            <div class="form-group">
                                <label>Группа пользователей</label>
                                <select name="group" class="form-control">
                                    <option>Пользователь</option>
                                    <option>Модератор</option>
                                    <option>Администратор</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Загрузить фото</label>
                                <input type="file" name="userfile" id="exampleInputFile">
                                <p class="help-block">Загрузка фото для аватарки.</p>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status" value="1"> Активность
                                </label>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Сохранить</button>
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
                        <h3 class="box-title">Дополнительные данные</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th>Task</th>
                                <th>Progress</th>
                            </tr>
                            <tr>
                                <td>Update software</td>
                                <td>data</td>
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