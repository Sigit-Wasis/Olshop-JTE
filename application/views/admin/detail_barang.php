<?php $this->load->view('admin/templates_admin/header'); ?>
<!-- ============================================================== -->
<div class="content-wrapper">
  <section class="content-header animated fadeIn">
    <h1>
      Barang    <small>Detail Barang</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url(); ?>dashboard/">
      <i class="fa fa-home"></i> Home</a></li>
    </ol>
  </section>

<section class="content animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Barang</h3>
          <div class="box-tools pull-right" style="margin-top:2px;">
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Gambar</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Harga</th>
              <th scope="col">Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ($data as $u) {
            ?>
            <tr>
              <td><img style="width: 80px" src="<?= base_url(); ?>assets/images/barang/<?= $u->gambar ?>"> </td>
              <td><?php echo $u->nama_barang ?></td>
              <td><?php echo $u->harga ?></td>
              <td><?php echo $u->deskripsi ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
</div>

<!-- ============================================================== -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>