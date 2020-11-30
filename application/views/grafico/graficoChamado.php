<div class="wrapper"></div>





<div class="container-login100 " style="background-color:white">
    <div class="col-md-6 col-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">


                <span style="color:white" class="login100-form-title ">
                    Relatório Geral de Solicitações

                </span>
            </div>

            <div class="panel-body">
                <select class="form-group col-lg-6 form-control">
                    <option>Todo Período</option>
                    <option>3 Meses atrás</option>
                    <option>5 Meses atrás</option>
                </select>


                <div id="piechart" style="width: 900px; height: 500px;  float:left;width:600px;"></div>







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
                ['Task', 'Hours per Day'],
                ['Finalizados', <?php echo $finalizados; ?>],
                ['Cancelados', <?php echo $cancelados; ?>],
                ['Excluidos', <?php echo $excluidos; ?>],
                ['Avaliados', <?php echo $avaliados; ?>],
            ]);

            var options = {
                title: 'Relatório de Ações'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
