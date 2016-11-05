<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Журнал предупреждений
            <small>предупреждения о нарушениях</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-warning"></i> Журнал предупреждений</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" accept-charset="utf-8" class="form-inline">
                        <div class="box-header">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="query" class="form-control"
                                       placeholder="Поиск">
                                <div class="input-group-btn">
                                    <button type="submit" name="search" value="search" class="btn btn-default"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="text-red"><?= validation_errors();?></div>
                            </div>
                        </div>
                    </form>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Пользователь</th>
                                <th>Рег. логин</th>
                                <th>IP</th>
                                <th>Сообщение</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody id="users__list">
                            <? if (!empty($warn)): ?>
                                <? foreach ($warn as $val): ?>
                                    <tr>
                                        <td>#<?=$val['id'];?></td>
                                        <td class="btn"><a><?=$val['name'];?></a></td>
                                        <td><?=$val['login'];?></td>
                                        <td><?=$val['ip'];?></td>
                                        <td><?=$val['message'];?></td>
                                        <td><?=date('d-m-Y H:i', $val['date']);?></td>
                                    </tr>
                                <? endforeach; ?>
                            <? else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Нет данных</td>
                                </tr>
                            <? endif; ?>
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

