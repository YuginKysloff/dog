<? defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Журнал событий
            <small>основные события системы</small>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-book"></i> Журнал событий</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" accept-charset="utf-8" class="form-inline" id="log__search_form">
                        <div class="box-header">
                            <div class="input-group input-group-sm col-sm-1">
                                <select name="per_page" class="form-control">
                                    <option value="10" <? if($this->uri->segment(3) == 10):?>selected<? endif;?>>
                                        10 строк
                                    </option>
                                    <option value="25" <? if($this->uri->segment(3) == 25):?>selected<? endif;?>>
                                        25 строк
                                    </option>
                                    <option value="50" <? if($this->uri->segment(3) == 50):?>selected<? endif;?>>
                                        50 строк
                                    </option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="query" value="" class="form-control"
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
                                <th id="log">Логин</th>
                                <th>Сообщение</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody id="log__list">
                            <? if (!empty($log)): ?>
                                <? foreach ($log as $val): ?>
                                    <tr>
                                        <td>#<?=$val['id'];?></td>
                                        <td class="log__login pointer"><a><?=$val['login'];?></a></td>
                                        <td><?=$val['message'];?></td>
                                        <td><?=date('d-m-Y H:i', $val['date']);?></td>
                                    </tr>
                                <? endforeach; ?>
                            <? else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Нет данных</td>
                                </tr>
                            <? endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?=$this->pagination->create_links();?>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

