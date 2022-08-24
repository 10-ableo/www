<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="row justify-content-center">
        <div class="col-md-3">
          <div class="form-group">
            <label>Tanggal Awal</label>
            <input type="date" name="awal" id="awal" class="form-control" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Tanggal Akhir</label>
            <input type="date" name="akhir" id="akhir" class="form-control" required>
          </div>
        </div>
        <div class="col-md-3">
          <button onclick="return grafik()" class="btn btn-primary" style="margin-top: 31px" type="button" id="filter">Filter Data</button>
        </div>
      </div>
  </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary" id="text">Statistik ketinggian air</h6>
    </div>
    <div class="card-body">
      <canvas id="canvas"></canvas>
    </div>
  </div>
</div>
<script src="src/vendor/jquery/jquery.min.js"></script>
<script src="src/vendor/chart.js/Chart.min.js"></script>
<script>
  $('#canvas').hide();
  function grafik()
    {
      var awal  = $('#awal').val();
      var akhir = $('#akhir').val();

      if (awal == '' || akhir == '') {
        alert('Masukan tanggal awan dan tanggal akhir!');
        return false;
      }

      $('#text').text('Statistik ketinggian air Periode '+ awal +' s/d '+ akhir)

      $.ajax({
            url: "data_grafik.php",
            method: "POST",
            data:{ 'awal':awal,'akhir':akhir },
            dataType : "json",
            success: function(data) {
              console.log(data.jumlah)
              if (data.jumlah == 0)
              {
                alert('Data tidak ditemukan');
                $('#canvas').hide();
                return false;
              }
              $('#canvas').show();
              var ctx = document.getElementById('canvas').getContext('2d');
              var chart = new Chart(ctx, {
                  type: 'line',
                  data: {
                      labels: data.label,
                      datasets: [{
                          label: 'Ketinggian Air',
                          backgroundColor: 'white',
                          fill: false,
                          borderColor: 'blue',

                          data: data.tinggi_air
                      }]
                  },
                  options: {
                      scales: {
                          xAxis: {
                              ticks: {
                                  maxTicksLimit: 10
                              }
                          }
                      }
                  }
              });
            }
        });
    }
</script>
