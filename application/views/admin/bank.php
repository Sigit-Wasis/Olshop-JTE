<div class="content-wrapper">
  <section class="content-header animated fadeIn">
    <h1>
      Akun Bank    <small>Manage Akun Bank</small>
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
          <h3 class="box-title">List Akun Bank</h3>
          <div class="box-tools pull-right" style="margin-top:2px;">
            <button type="button" class="btn btn-xs bg-blue" data-toggle="modal" data-target="#form-tambah-bank" onclick="submit('tambah')">
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
               <th> No Rekening</th>
               <th> Kode Bank </th>
               <th> Nama Bank </th>
               <th> Pemilik </th>
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

<!-- =========================================================================================================== -->
<!-- ADD MODAL PELANGGAN -->
<div class="modal fade" id="form-tambah-bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"">
  <div class="modal-dialog" role="document">
    <form method="post" id="form">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judul-form"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <small id="pesan" class="form-text text-danger text-center"></small>
        <div class="modal-body">
          <div class="form-group">
            <label for="no_rek">No Rekening</label>
            <input type="text" id="no_rek" name="no_rek" class="form-control" placeholder="No Rekening">
          </div>
          <div class="form-group">
            <label for="kode_bank">Kode Bank</label>
            <input type="text" id="kode_bank" name="kode_bank" class="form-control" placeholder="Kode Bank">
          </div>

          <div class="form-group">
            <label for="nama">Nama Bank</label>
            <input type="nama" id="nama" name="nama" class="form-control" placeholder="Nama Bank">
          </div> 
          <div class="form-group">
            <label for="pemilik">Pemilik</label>
            <input type="text" id="pemilik" name="pemilik" class="form-control" placeholder="Pemilik">
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="button" id="btn-tambah" onclick="tambahdata()" class="btn btn-primary">Tambah</button>
          <button type="button" id="btn-ubah" onclick="ubahData()" class="btn btn-primary">Ubah</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- END MODAL PELANGGAN -->
<!-- =========================================================================================================== -->

<!-- ========================================== SCRIPT AJAX ==================================================== -->
<script>
  $(document).ready(() => {
    ambilData();
  });

  function ambilData(){
    $.ajax({
      type: 'POST',
      url : '<?= base_url(); ?>bank/ambil',
      dataType : 'json',
      success : function(data){
        let result = '';
          for(let i = 0; i < data.length; i++){
          result += '<tr>' +
          '<td class="text-left">' + (i+1) + '</td>' +
          '<td>' + data[i].no_rek + '</td>' +
          '<td>' + data[i].kode_bank + '</td>' +
          '<td>' + data[i].nama + '</td>' +
          '<td>' + data[i].pemilik + '</td>' +
          '<td>'+
            '<button class="btn btn-primary btn-sm mr-2" onclick="submit('+ data[i].id +')" data-toggle="modal" data-target="#form-tambah-bank" data-whatever="@getbootstrap">Edit</button>' +
            '<button class="btn btn-danger btn-sm" onclick="hapus('+ data[i].id +')">Delete</button>'+
            '</td>' +
            '</tr>';
          }
            if(!result){
              result += '<tr class="text-center"><td colspan="5"><h3>Not Found!</h3></td></tr>';
            }
              $('#result').html(result);
            }
        });
      }

  function tambahdata(){
    let no_rek = $("[name= 'no_rek']").val()
    let kode_bank = $("[name= 'kode_bank']").val()
    let nama = $("[name= 'nama']").val()
    let pemilik = $("[name= 'pemilik']").val()         
      $.ajax({
        type: 'post',
        data: 'no_rek='+ no_rek +'&kode_bank='+ kode_bank +'&nama='+ nama +'&pemilik='+ pemilik,
        dataType: 'JSON',
        url: '<?= base_url(); ?>bank/tambahdata',
        success: function(hasil) {
          if(hasil.msg == ''){
            $('#form-tambah-bank').modal('hide')
              ambilData()
              $("[name='no_rek']").val('')
              $("[name='kode_bank']").val('')
              $("[name='nama']").val('')
              $("[name='pemilik']").val('')

              Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              })
              }else{
                $('#pesan').html(hasil.msg)
              }
        }
      });
    }

  function submit(x){
    if(x == 'tambah'){
      $('#btn-tambah').show()
      $('#btn-ubah').hide()
    }else{
      $('#btn-tambah').hide()
      $('#btn-ubah').show()
        $.ajax({
          type : 'POST',
          data : 'id='+x,
          url  : '<?= base_url(); ?>bank/ambilId',
          dataType : 'JSON',
          success: function(hasil){
            $('#form').attr('data-id', ""+ hasil[0].id+ '')
            $('[name="no_rek"]').val(hasil[0].no_rek)
            $('[name="kode_bank"]').val(hasil[0].kode_bank)
            $('[name="nama"]').val(hasil[0].nama)
            $('[name="pemilik"]').val(hasil[0].pemilik)
            $('#pesan').hide()
          }
        })
      }
    }

  function ubahData(){
    let id = $('#form').attr('data-id')
    let no_rek = $("[name= 'no_rek']").val()
    let kode_bank = $("[name= 'kode_bank']").val()
    let nama = $("[name= 'nama']").val()
    let pemilik = $("[name= 'pemilik']").val()
      $.ajax({
        type: 'POST',
        data: {
          'id': id,
          'no_rek': no_rek,
          'kode_bank': kode_bank,
          'nama' : nama,
          'pemilik' : pemilik
        },
        url : '<?= base_url(); ?>bank/ubahData',
        dataType: 'json',
        success: function(hasil){
          console.log(hasil)
          $('#pesan').html(hasil.msg)
          if(hasil.msg = 'jadi'){
            $('#form-tambah-bank').modal('hide')
            ambilData()

              Swal.fire({
              position: 'center',
              type: 'success',
              title: 'Your work has been updated',
              showConfirmButton: false,
              timer: 1500
              })
            }
          }
        })
      }

  function hapus(id) {
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
        type: 'POST',
        data: 'id='+id,
        url: '<?= base_url()."bank/hapus" ?>',
        success: function(){
        ambilData()
        }
        });
        Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
        )
        }
      })
    }
</script>

<!-- ======================================== END SCRIPT AJAX =====================================================-->

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>