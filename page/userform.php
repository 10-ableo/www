<?php 
  if (isset($_GET['id'])) { 
    $status = 'Update'; 
    $id     = $_GET['id'];
    $sql    = mysqli_query($con," SELECT * FROM user where user_id = '$id' ");
    $row    = mysqli_fetch_object($sql);
  }
  else { $status = 'Tambah'; }

  if (isset($_POST['Tambah'])) {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = md5($_POST['password']);

    //cek email apakah sudah dipakai atau belum
    $cek = mysqli_query($con," SELECT * FROM user where user_email = '$email' ");
    if (mysqli_num_rows($cek) > 0) {
      echo "<script>alert('Ops! Email yang anda masukan sudah digunakan'); window.location.href = '?p=useradd';</script>";
    }
    else
    {
      mysqli_query($con," INSERT INTO user VALUES ('','$nama','$email','$password') ");
      echo "<script>alert('Berhasil! Tambah data user'); window.location.href = '?p=user';</script>";
    }
  }
  if (isset($_POST['Update'])) {
    $iduser   = $_GET['id'];
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    //jika user engganti passwordnya
    if ($_POST['password']) {
      $password = md5($_POST['password']);
      mysqli_query($con," UPDATE user set user_nama = '$nama', user_email = '$email', user_password = '$password' where user_id = '$id' ");
    }
    else
    {
      mysqli_query($con," UPDATE user set user_nama = '$nama', user_email = '$email' where user_id = '$id' ");
    }
    echo "<script>alert('Berhasil! Update data user'); window.location.href = '?p=user';</script>";
  }
?>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        <?=$status?> Data User 
      </h6>

    </div>
    <form method="POST" action="">
    <div class="card-body">
      <div class="table-responsive">
        <div class="form-group">
          <label>Nama User</label>
          <input type="text" name="nama" value="<?=isset($row->user_nama)?$row->user_nama:''?>" class="form-control" required="" placeholder="Masukan nama user">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" value="<?=isset($row->user_email)?$row->user_email:''?>" class="form-control" required="" placeholder="Masukan email">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" name="password" class="form-control" <?=isset($row->user_password)?'placeholder="Masukan password jika ingin mengubah"':'required placeholder="Masukan password"'?> >
        </div>
      </div>
    </div>
    <div class="card-footer">
      <a href="?p=user" class="btn btn-danger">Kembali</a>
      <button type="submit" name="<?=$status?>" class="btn btn-primary">Simpan</button>
    </div>
    </form>
  </div>

</div>