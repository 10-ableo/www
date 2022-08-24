<?php 
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($con," DELETE FROM user where user_id = '$id' ");
    echo "<script>alert('Berhasil! Delete data user'); window.location.href = '?p=user';</script>";
  }
?>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        Data User 
        <a href="?p=useradd" class="btn btn-primary btn-sm float-right"><span class="fa fa-save"></span> Tambah Data</a>
      </h6>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="1%">No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no=1;
            //select data user yang ada pada database
            $sql = mysqli_query($con," SELECT * FROM user ");
            while ($d = mysqli_fetch_object($sql)) { ?>
            <tr>
              <td><?=$no++?></td>
              <td><?=ucwords($d->user_nama)?></td>
              <td><?=ucwords($d->user_email)?></td>
              <td>
                <a href="?p=useredit&id=<?=$d->user_id?>" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
                <a onclick="return confirm('apakah anda yakin?')" href="?p=user&id=<?=$d->user_id?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>