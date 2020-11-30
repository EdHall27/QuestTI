<div class="wrapper"></div>





<div class="container-login100 " style="background-color:white">
    <div class="col-md-6 col-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">


                <span style="color:white" class="login100-form-title ">
                    Gerenciamento de Acessos

                </span>
            </div>

            <div class="panel-body">

                <select class="form-group col-lg-6 form-control">
                    <option>Todo Período</option>
                    <option>Nesse mês</option>
                    <option>5 Meses atrás</option>
                </select>
                <br><br><br><br>
                <div id="columnchart_material" style="width: 900px; height: 500px;  float:left;width:600px;"></div>

            </div>



        </div>
    </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Ano', 'Cadastros', 'Tecnicos Liberados', 'Tecnicos Bloqueados', 'Técnicos Excluidos'],
            ['2020', <?php echo $cadastros; ?>, <?php echo $TecnicosLiberados; ?>, <?php echo $TecnicosBloqueados; ?>, <?php echo $TecnicosExcluidos; ?>],
        ]);

        var options = {
            chart: {
                title: 'gráficos  gerenciamento de  técnicos',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>


