<? defined('BASEPATH') OR exit('No direct script access allowed');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Статистика
        <small>основные параметры системы</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-line-chart"></i> Статистика</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$stat['users'];?></h3>
              <p>Всего пользователей</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="/admin/users" class="small-box-footer">
              Подробнее <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

