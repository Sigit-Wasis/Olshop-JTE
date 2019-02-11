<div class="content-wrapper">
  <section class="content-header animated fadeIn">
    <h1>
      Barang    <small>Manage Barang</small>
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
          <h3 class="box-title">List Barang</h3>
          <div class="box-tools pull-right" style="margin-top:2px;">
            <button type="button" id="tombol-tambah" class="btn btn-xs bg-blue" data-toggle="modal" data-target="#form-tambah-barang">
              <i class="fa fa-plus-circle"></i> Add
            </button>
          </div>
        </div>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-list">
            <thead class="bg-blue">
              <tr>
               <th width="50"> No</th>
               <th> Nama Barang</th>
               <th> Harga </th>
               <th width="200"> Action</th>
              </tr> 
            </thead>
            <tbody id="result"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

<!-- add usergroup modal -->
<div class="modal fade" id="form-tambah-barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"">
  <div class="modal-dialog" role="document">
    <form method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judul-form"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <small id="pesan" class="form-text text-danger text-center"></small>
        <div class="modal-body">
          <div class="form-group row">
            <label for="nama-barang" class="col-sm-3 text-left control-label col-form-label">Nama Barang</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="nama-barang" name="nama-barang" placeholder="Nama Barang">
              </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-3 text-left control-label col-form-label">Kategori</label>
              <!-- {# Daftar Kategori #} -->
            <div class="col-md-3 col-sm-3" id="kategori"></div>
            <div class="col-md-3 col-sm-3" id="kategori2"></div>
          </div>
          <div class="form-group row">
            <label for="fname" class="col-sm-3 text-left control-label col-form-label">Upload Gambar</label>
              <div class="col-md-9">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="gambar-barang" name="gambar-barang">
                  <label class="custom-file-label" for="gambar-barang">Pilih Gambar...</label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="harga-barang" class="col-sm-3 text-left control-label col-form-label">Harga Barang</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="harga-barang" name="harga-barang" placeholder="Harga Barang">
              </div>
          </div>
          <div class="form-group row">
            <label for="deskripsi-barang" class="col-sm-3 text-left control-label col-form-label">Deskripsi</label>
              <div class="col-md-9">
                <textarea class="form-control" id="deskripsi-barang" name="deskripsi-barang"></textarea>
              </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button id="tambah" type="submit" class="btn btn-success">Tambah</button>
          <button id="simpan" type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Modal -->
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Full Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header" id="detail-title">
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item" id="detail-id"></li>
            <li class="list-group-item" id="detail-email"></li>
            <li class="list-group-item" id="detail-address"></li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPT AJAX -->
<script>
$(document).ready(() => {
    getAllData();
});
function getAllData()
{
    $.ajax({
        type     : 'POST',
        dataType : 'JSON',
        url      : '<?= base_url(); ?>barang/ambil',
        success  : function (data){
            let result = '';
            for(let i = 0; i < data.length; i++){
                result += '<tr>' +
                    '<td class="text-left">' + (i+1) + '</td>' +
                    '<td>' + data[i].nama_barang + '</td>' +
                    '<td>Rp.' + data[i].harga + '</td>' +
                    '<td>'+
                    `<a href="<?= base_url(); ?>barang/detail/`+ data[i].id +`" class="btn btn-warning btn-sm m-1">Detail</a>` +
                    '<button type="button" class="btn btn-primary btn-sm m-1" data-toggle="modal" data-target="#form-tambah-barang" onclick="getid('+ data[i].id +')" data-whatever="@getbootstrap">Edit</button>' +
                    `<button class="btn btn-danger btn-sm m-1" onclick="hapus(`+ data[i].id +`, '`+ data[i].gambar +`')">Delete</button>`+
                    '</td>' +
                '</tr>';
            }
            if(!result){
                result += '<tr class="text-center"><td colspan="5"><h3>Not Found!</h3></td></tr>';
            }
            $('#result').html(result);
        }
    });
    // Ambil daftar kategori
    $.ajax({
        type     : 'POST',
        dataType : 'JSON',
        url      : '<?= base_url(); ?>barang/ambilkategori',
        success  : function (data){
            let kategori = '';
            let kategori2 = '';
            for(let i = 0; i < data.length; i++){
                if(i < 3){
                    kategori += '<div class="custom-control custom-checkbox mr-sm-2"> '+
                                    '<input type="checkbox" class="custom-control-input" id="'+ data[i].nama_kategori +'" name="kategori[]" value="'+ data[i].id +'">'+
                                    '<label class="custom-control-label text-capitalize" for="'+ data[i].nama_kategori +'">'+ data[i].nama_kategori +'</label>'+
                                '</div>';
                }
                //Memberi kolom setiap 3 kali data barang
                if(i >= 3){
                    kategori2 += '<div class="custom-control custom-checkbox mr-sm-2"> '+
                                    '<input type="checkbox" class="custom-control-input" id="'+ data[i].nama_kategori +'" name="kategori[]" value="'+ data[i].id +'">'+
                                    '<label class="custom-control-label text-capitalize" for="'+ data[i].nama_kategori +'">'+ data[i].nama_kategori +'</label>'+
                                '</div>';
                }
            }
            if(data.length > 3){
                $('#kategori2').html(kategori2);
            }
            $('#kategori').html(kategori);
        }
    });
}

$('#tombol-tambah').on('click', () => {
    $('#tambah').show();
    $('#simpan').hide();
    $('[name = "nama-barang"]').val('');
    $('[name = "harga-barang"]').val('');
    $('[name = "deskripsi-barang"]').val('');
    $('[type = "checkbox"]').prop('checked', false);
    $('#form').attr('data-id', '');
    $('#judul-form').html('Tambah Data Barang');
    $('#pesan').html('');
});

$('#form').on('submit', function(e){
    e.preventDefault();
    let data = new FormData(this);
    data.append('id', $(this).attr('data-id'))
    if( $(this).attr('data-id') != '' ) {

        $.ajax({
            url: "barang/ubah",
            type: "POST",
            data: data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(result)  
            {                
                if(result.msg == ''){
                    let alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                    '<strong>Success </strong>' + result.status +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                '</div> ';
                    $('#form-tambah-barang').modal('hide');
                    getAllData();
                    Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Your work has been updated',
                    showConfirmButton: false,
                    timer: 1500
                    })
                } else {
                    $('#pesan').html(result.msg);
                }
            }
        });

    } else {

        $.ajax({
            url: "barang/tambah",
            type: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(result)  
            {
                if(result.msg == ''){
                    let alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                    '<strong>Success </strong>' + result.status +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                '</div> ';
                    $('#form-tambah-barang').modal('hide');
                    getAllData();
                      Swal.fire({
                      position: 'center',
                      type: 'success',
                      title: 'Your work has been saved',
                      showConfirmButton: false,
                      timer: 1500
                      });
                } else {
                    $('#pesan').html(result.msg);
                }
            }
        });
    }
});

function getid(id)
{
    $('#simpan').show();
    $('#tambah').hide();
    $('[type = "checkbox"]').prop('checked', false);
    $('#judul-form').html('Ubah Data Barang');
    $.ajax({
        type: 'POST',
        data: 'id=' + id,
        url: '<?= base_url(); ?>barang/getbyid',
        dataType: 'JSON',
        success: function(data){
            $('[name = "nama-barang"]').val(data[0].nama_barang);
            $('[name = "harga-barang"]').val(data[0].harga);
            $('[name = "deskripsi-barang"]').val(data[0].deskripsi);
            $('#id').val(data[0].id);
            $('#form').attr('data-id', data[0].id);
            data.forEach(function(kategori) {
                $('#'+ kategori.nama_kategori +'').prop('checked', true);
            })
        }
    });
}

function detail(query)
{
  $.ajax({
    type: 'post',
    data: 'id=' + query,
    url: '<?= base_url(); ?>barang/detail',
    dataType: 'json',
    success: function(data){
      $('#detail-id').html(data[0].id);
      $('#detail-title').html(data[0].name);
      $('#detail-email').html(data[0].email);
      $('#detail-address').html(data[0].street_address);
    }
  })
}

function hapus(id, namaGambar)
{
    if(confirm('yakin')){
        $.ajax({
            type: 'POST',
            data: 'id=' + id + '&namaGambar=' + namaGambar,
            dataType: 'JSON',
            url: '<?= base_url(); ?>barang/hapus',
            success: function(result) {
                let alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                                    '<strong>Success </strong>' + result.status +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                        '<span aria-hidden="true">&times;</span>' +
                                    '</button>' +
                                '</div> ';
                $('#alert').html(alert);
                getAllData();
            }
        });
    };
}
</script>

<!-- END SCRIPT AJAX -->

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>