<?php require_once('consultas.php');?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Paper Dashboard 2 by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

  <style>
    body {
      background:#33cc99!important;
    }
    .navbar-wrapper {
      color:white!important;
      font-weight:bold;
    }
  </style>
</head>

<body class="">

  <div class="container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
      <div class="container-fluid">
        <div class="navbar-wrapper">
          <a class="navbar-brand">Dashboard Queimadas no Brasil</a>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
     <br>
    <div class="content" style="margin-top: 10%">

      <div class="row">

        <div class="col-md-6">
          <div class="card ">
            <div class="card-header ">
              <h5 class="card-title">Queimadas por Biomas</h5>
              <p class="card-category">Dados de 2018</p>
            </div>
            <div class="card-body ">
              <canvas id="grafico-queimadas-por-biomas"></canvas>
            </div>
            <div class="card-footer ">
              <hr>
              <div class="stats">
                <i class="fa fa-history"></i> Bioma: conjunto de diferentes ecossistemas
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card ">
            <div class="card-header ">
              <h5 class="card-title">Queimadas por coordenação regional</h5>
              <p class="card-category">Dados de 2018</p>
            </div>
            <div class="card-body ">
              <canvas id="grafico-queimadas-por-coordenacao-regional"></canvas>
            </div>
            <div class="card-footer ">
              <hr>
              <div class="stats">
                <i class="fa fa-history"></i> Região: Que pertence a ou é próprio de uma região
              </div>
            </div>
          </div>
        </div>

      </div><!--end row-->


      <div class="row">

        <div class="col-md-6">
          <div class="card ">
            <div class="card-header ">
              <h5 class="card-title">Queimadas por Unidades de Conservação</h5>
              <p class="card-category">Dados de 2018</p>
            </div>
            <div class="card-body ">
              <canvas id="grafico-queimadas-por-unidade-conservacao"></canvas>
            </div>
            <div class="card-footer ">
              <hr>
              <div class="stats">
                <i class="fa fa-history"></i>Denominação dada pelo Sistema Nacional de Conservação.
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card ">
            <div class="card-header ">
              <h5 class="card-title">Queimadas nos ultimos 7 anos</h5>
              <p class="card-category">Dados de 2018 á 2012</p>
            </div>
            <div class="card-body ">
              <canvas id="grafico-queimadas_ultimos_7_anos"></canvas>
            </div>
            <div class="card-footer ">
              <hr>
              <div class="stats">
                <i class="fa fa-history"></i>
              </div>
            </div>
          </div>
        </div>

      </div><!--end row-->
    </div>

    <footer class="footer footer-black  footer-white ">
      <div class="container-fluid">
        <div class="row">
          <nav class="footer-nav">
            
          </nav>
          <div class="credits ml-auto">
            <span class="copyright">
              
            </span>
          </div>
        </div>
      </div>
    </footer>
  </div>
  </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  
  
<script>
  var ctx = document.getElementById("grafico-queimadas-por-biomas").getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'doughnut',
          data: {
              labels: [
                  <?php $i = 0; ?>
                  <?php foreach (queimadasPorBiomas($pdo) as $dado):?>
                    <?php $i++;?>
                    <?php if ($i <= count(queimadasPorBiomas($pdo))):?>
                      "<?php echo $dado->bioma_referencial;?>",
                    <?php endif;?>
                  <?php endforeach;?>
              ],
              datasets: [{
                backgroundColor: ['#33cc99','#996600','#66cc66','#ffcc00'],
                data: [
                  <?php $i = 0; ?>
                  <?php foreach (queimadasPorBiomas($pdo) as $dado):?>
                    <?php $i++;?>
                    <?php if ($i <= count(queimadasPorBiomas($pdo))):?>
                      <?php echo round($dado->media,2);?>,
                    <?php endif;?>
                  <?php endforeach;?>
                ]
              }]
          },
          options: {
            legend: {
              display: true,
              position: 'left'
            }
          }
      });

  var ctx = document.getElementById("grafico-queimadas-por-coordenacao-regional").getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'doughnut',
          data: {
              labels: [
                  <?php $i = 0; ?>
                  <?php foreach (queimadasPorCoordenacaoRegional($pdo) as $dado):?>
                    <?php $i++;?>
                    <?php if ($i <= count(queimadasPorCoordenacaoRegional($pdo))):?>
                      "<?php echo $dado->coordenacao_regional;?>",
                    <?php endif;?>
                  <?php endforeach;?>
              ],
              datasets: [{
                backgroundColor: ['#8eb5a8','#996600','#66cc66','#ffcc00','#33cc99','#bad7d7','#006600','#99ccff','#56a156','#bed8cf'],
                data: [
                  <?php $i = 0; ?>
                  <?php foreach (queimadasPorCoordenacaoRegional($pdo) as $dado):?>
                    <?php $i++;?>
                    <?php if ($i <= count(queimadasPorCoordenacaoRegional($pdo))):?>
                      <?php echo round($dado->media,2);?>,
                    <?php endif;?>
                  <?php endforeach;?>
                ]
              }]
          },

          options: {
            legend: {
              display: true,
              position: 'left'
            }
          }
      });

  var ctx = document.getElementById("grafico-queimadas-por-unidade-conservacao").getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'doughnut',
          data: {
              labels: [
                  <?php $i = 0; ?>
                  <?php foreach (queimadasPorUnidadesDeConservacao($pdo) as $dado):?>
                    <?php $i++;?>
                    <?php if ($i <= count(queimadasPorUnidadesDeConservacao($pdo))):?>
                      "<?php echo $dado->categoria_uc;?>",
                    <?php endif;?>
                  <?php endforeach;?>
              ],
              datasets: [{
                backgroundColor: ['#8eb5a8','#339933','#66cc66','#ffcc00','#33cc99','#bad7d7'],
                data: [
                  <?php $i = 0; ?>
                  <?php foreach (queimadasPorUnidadesDeConservacao($pdo) as $dado):?>
                    <?php $i++;?>
                    <?php if ($i <= count(queimadasPorUnidadesDeConservacao($pdo))):?>
                      <?php echo round($dado->media,2);?>,
                    <?php endif;?>
                  <?php endforeach;?>
                ]
              }]
          },

          options: {
            legend: {
              display: true,
              position: 'left'
            }
          }
      });

var ctx = document.getElementById('grafico-queimadas_ultimos_7_anos');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        datasets: [{
            label: 'Queimadas',
            <?php $queimada = queimadasNosUltimos7Anos($pdo);?>
            data: [
              <?php echo $queimada->queimadas_2018;?>,
              <?php echo $queimada->queimadas_2017;?>,
              <?php echo $queimada->queimadas_2016;?>,
              <?php echo $queimada->queimadas_2015;?>,
              <?php echo $queimada->queimadas_2014;?>,
              <?php echo $queimada->queimadas_2013;?>,
              <?php echo $queimada->queimadas_2012;?>
            ],
            backgroundColor: 'rgba(44,173,129,0.7)',
            borderColor: '#255949',
            borderWidth: 2
        }],

        labels: ['2018','2017','2016','2015','2014','2013','2012'],
    },
    options: {
        elements: {
            line: {
                tension: 0
            }
       },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
</body>

</html>
