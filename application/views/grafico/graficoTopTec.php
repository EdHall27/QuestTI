<? // acessando chaves e valro de array

//array_values($resultado);
//array_keys($resultado);
?>

<div class="wrapper"></div>





<div class="container-login100 " style="background-color:white">
    <div class="col-md-6 col-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">


                <span style="color:white" class="login100-form-title ">
                    Relatório Quantitativo de Atendimentos

                </span>
            </div>

            <div class="panel-body">


                <div id="piechart" style="width: 900px; height: 500px;  float:left;width:600px;"></div>

            </div>



        </div>
    </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Quantidade de Chamados'],
            <?php foreach ($resultado as $chave => $valor) {
                echo "['" . $chave . "', " . $valor . "],";
            } ?>
        ]);

        var options = {
            title: 'Relatório de Atendimento Finalizados ou em Andamento'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

<?php var_dump($resultado); ?>