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
                            <tbody>
                                <tr>
                                    <td>183</td>
                                    <td>admin</td>
                                    <td>admin@admin.com</td>
                                    <td>Админы</td>
                                    <td>127,0,0,1</td>
                                    <td>12-10-2016</td>
                                    <td><i class="fa fa-edit"></i> - редактировать</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>John Doe</td>
                                    <td>google.com</td>
                                    <td><span class="label label-success">Активный</span></td>
                                    <td>127,0,0,1</td>
                                    <td>12-10-2016</td>
                                    <td><i class="fa fa-trash"></i> - удалить</td>
                                </tr>
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

