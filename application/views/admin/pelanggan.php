<div class="content-wrapper">
  <section class="content-header animated fadeIn">
    <h1>
      Pelanggan    <small>Manage Pelanggan</small>
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
          <h3 class="box-title">List Pelanggan</h3>
          <div class="box-tools pull-right" style="margin-top:2px;">
            <button type="button" class="btn btn-xs bg-blue" data-toggle="modal" data-target="#form-tambah-pelanggan" onclick="submit('tambah')">
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
               <th> Full Name</th>
               <th> Username </th>
               <th> Email </th>
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
<div class="modal fade" id="form-tambah-pelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"">
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
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full name" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
          </div> 
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="no_telepon">No telepon</label>
            <input type="number" id="no_telepon" name="no_telepon" class="form-control" placeholder="No Telepon" required>
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <input type="text" id="jenis_kelamin" name="jenis_kelamin" class="form-control" placeholder="Cowok / Cewek" required>
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
      url : '<?= base_url(); ?>pelanggan/ambil',
      dataType : 'json',
      success : function(data){
        let result = '';
          for(let i = 0; i < data.length; i++){
          result += '<tr>' +
          '<td class="text-left">' + (i+1) + '</td>' +
          '<td>' + data[i].fullname + '</td>' +
          '<td>' + data[i].username + '</td>' +
          '<td>' + data[i].email + '</td>' +
          '<td>'+
            `<a href="<?= base_url(); ?>pelanggan/detail/`+ data[i].id +`" class="btn btn-warning btn-sm m-1">Detail</a>` +
            '<button class="btn btn-primary btn-sm mr-2" onclick="submit('+ data[i].id +')" data-toggle="modal" data-target="#form-tambah-pelanggan" data-whatever="@getbootstrap">Edit</button>' +
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
    let fullname = $("[name= 'fullname']").val()
    let username = $("[name= 'username']").val()
    let email = $("[name= 'email']").val()
    let password = $("[name= 'password']").val()
    let no_telepon = $("[name= 'no_telepon']").val()
    let jenis_kelamin = $("[name= 'jenis_kelamin']").val()            
      $.ajax({
        type: 'post',
        data: 'fullname='+ fullname +'&username='+ username +'&email='+ email +'&password='+ password
              +'&no_telepon='+ no_telepon+'&jenis_kelamin='+ jenis_kelamin,
        dataType: 'JSON',
        url: '<?= base_url(); ?>pelanggan/tambahdata',
        success: function(hasil) {
          if(hasil.msg == ''){
            $('#form-tambah-pelanggan').modal('hide')
              ambilData()
              $("[name='fullname']").val('')
              $("[name='username']").val('')
              $("[name='email']").val('')
              $("[name='password']").val('')
              $("[name='no_telepon']").val('')
              $("[name='jenis_kelamin']").val('')

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
          url  : '<?= base_url(); ?>pelanggan/ambilId',
          dataType : 'JSON',
          success: function(hasil){
            $('#form').attr('data-id', ""+ hasil[0].id+ '')
            $('[name="fullname"]').val(hasil[0].fullname)
            $('[name="username"]').val(hasil[0].username)
            $('[name="email"]').val(hasil[0].email)
            $('[name="password"]').val(hasil[0].password)
            $('[name="no_telepon"]').val(hasil[0].no_telepon)
            $('[name="jenis_kelamin"]').val(hasil[0].jenis_kelamin)
            $('#pesan').hide()
          }
        })
      }
    }

  function ubahData(){
    let id = $('#form').attr('data-id')
    let fullname = $("[name= 'fullname']").val()
    let username = $("[name= 'username']").val()
    let email = $("[name= 'email']").val()
    let password = $("[name= 'password']").val()
    let no_telepon = $("[name= 'no_telepon']").val()
    let jenis_kelamin = $("[name= 'jenis_kelamin']").val()

      $.ajax({
        type: 'POST',
        data: {
          'id': id,
          'fullname': fullname,
          'username': username,
          'email' : email,
          'password' : password,
          'no_telepon' : no_telepon,
          'jenis_kelamin' : jenis_kelamin
        },
        url : '<?= base_url(); ?>pelanggan/ubahData',
        dataType: 'json',
        success: function(hasil){
          console.log(hasil)
          $('#pesan').html(hasil.msg)
          if(hasil.msg = 'jadi'){
            $('#form-tambah-pelanggan').modal('hide')
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
        url: '<?= base_url()."pelanggan/hapus" ?>',
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