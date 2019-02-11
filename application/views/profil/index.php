<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin profile</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= base_url(); ?>assets/dist/img/user4-128x128.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">Nina Mcintire</h3>
              <p class="text-muted text-center">Admin Olshop JTE</p>
              <hr>
              
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
              <p class="text-muted">Malibu, California</p>
              <hr>
              <a href="#" class="btn btn-danger btn-block"><b>Aktif</b></a>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Data admin</a></li>
              <li><a href="#setting" data-toggle="tab">Input admin</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">List Admin</h3>
                  </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Full Nama</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($datas as $no => $data): ?>   
                        <tr>
                          <td><?= ++$no; ?></td>
                          <td><?= $data->fullname; ?></td>
                          <td><?= $data->email; ?></td>
                          <td><?= $data->username; ?></td>
                          <td>
                            <?= anchor("profil/ubah/{$data->id}", 'ubah', ['class' => 'btn btn-warning']);?>  
                            <?= anchor("profil/hapus/{$data->id}", 'hapus', ['class' => 'btn btn-danger']);?>
                          </td>
                        </tr>
                      <?php endforeach; ?>  
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
                  <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                      <li><a href="#">«</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">»</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <!-- /.box-header -->
              <div class="tab-pane" id="setting">
              <form class="form-horizontal">
              <form action="<?= base_url(); ?>profil/tambah" method="post">
                <div class="form-group">
                  <label for="fullname" class="col-sm-2 control-label">Full Name</label>

                    <div class="col-sm-10">
                      <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Full Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                      <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="no_telepon" class="col-sm-2 control-label">No Telepon</label>

                    <div class="col-sm-10">
                      <input type="text" name="no_telepon" class="form-control" id="no_telepon" placeholder="No Telepon">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Tambah</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>

  <footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>