<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">*
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">*
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->


            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                        <li class="nav-item">

                            <?php if ($_SESSION['tipo_user'] == 1) { ?>
                        <li><a href="/home">
                                <h4>
                                    Home
                                </h4>
                            </a>
                        </li>
                    <?php } elseif ($_SESSION['tipo_user'] == 0) { ?>
                        <li><a href="/home/hometec">
                                <h4>
                                    Home
                                </h4>
                        </li>
                        </a><?php } ?>

                    </li>


                    <li class="nav-item">

                    <li><a href="/cadastro/editar_cadastro">
                            <h4>
                                Editar Perfil

                            </h4>
                        </a>
                    </li>


                    <?php if ($_SESSION['tipo_user'] == 0) { ?>
                        <li class="nav-item">

                        <li><a href="/gerencia_cadastro/gerencia">
                                <h4>
                                    Gerenciar Cadastros
                                </h4>
                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($_SESSION['tipo_user'] == 1 || $_SESSION['tipo_user'] == 2) {
                        if ($_SESSION['tipo_user'] == 1) {
                            $menu = "Gerenciar Solicitações";
                            $sub1 = "Minhas Solicitações";
                            $sub2 = "Solicicitações Finalizadas";
                            $sub3 = "Relatório de Solicitações";
                        } elseif ($_SESSION['tipo_user'] == 2) {
                            $menu = "Gerenciar Chamados";
                            $sub1 = "Meus Chamados";
                            $sub2 = "Chamados Finalizados";
                            $sub3 = "";
                        } else {
                            $menu = "";
                        }
                    } ?>


                    <?php if (@$menu != "") { ?>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">

                                <h4>
                                    <?php echo $menu; ?>
                                    &nbsp &nbsp
                                    <i class="fas fa-angle-left right"></i>
                                </h4>

                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/chamados/ver_solicitacao?status=aberto" class="nav-link">

                                        <h4 style="color:	#708090;"><?php echo    $sub1; ?></h4>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/chamados/ver_solicitacao?status=finalizado" class="nav-link">

                                        <h4 style="color:#708090;"><?php echo   $sub2; ?></h4>
                                    </a>
                                </li>


                                <?php if ($sub3 != "") { ?>
                                    <li class="nav-item">
                                        <a href="/graficos" class="nav-link">

                                            <h4 style="color:#708090;"><?php echo    $sub3; ?></h4>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </li>
                    <?php } ?>





                    <?php if ($_SESSION['tipo_user'] == 0) { ?>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">

                                <h4>
                                    Feed Back
                                    &nbsp &nbsp
                                    <i class="fas fa-angle-left right"></i>
                                </h4>

                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../Graficos/TopTec" class="nav-link">

                                        <h4>Acompanhamento de Técnicos</h4>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    <?php } ?>


                    <?php if ($_SESSION['tipo_user'] == 1) {
                        $var = "Histórico Pagamento";
                    } elseif ($_SESSION['tipo_user'] == 2) {
                        $var = "Histórico de Recebimentos";
                    } else {
                        $var = "";
                    }
                    ?>

                    <?php if ($var != "") { ?>

                        <li><a href="../HistoricoPag">

                                <h4>
                                    <?php echo $var; ?>

                                </h4>
                            </a>
                        </li>

                    <?php  }
                    ?>
                    <li class="nav-item">

                    <li><a href="/login/logof">
                            <h4>
                                Sair
                            </h4>
                        </a>
                    </li>






                </nav>
                <!-- /.sidebar-menu -->


            </div>
            <!-- /.sidebar -->

            <li><a href="/perfil/mostra_termo">
                    <h4>
                        &nbsp Termos de uso
                    </h4>
                </a>
            </li>
        </aside>


    </div>



    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../../assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../../assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../../assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../../assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../../assets/plugins/moment/moment.min.js"></script>
    <script src="../../assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../../assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../../assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../assets/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../assets/dist/js/demo.js"></script>
</body>

</html>