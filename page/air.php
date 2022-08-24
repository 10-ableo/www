<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Daya</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="1%">No</th>
              <th>Waktu</th>
              <th>Ketinggian Air</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no=1;
            $sql = mysqli_query($con," SELECT * FROM tinggi_air ");
            while ($d = mysqli_fetch_object($sql)) { ?>
            <tr>
              <td><?=$no++?></td>
              <td><?=date('H:i:s A, d F Y', strtotime($d->air_waktu))?></td>
              <td><?=number_format($d->tinggi_air,2)?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>