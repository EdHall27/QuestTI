<!DOCTYPE html>
<html lang="en">

<head>
    <title>QuesTi</title>

    <!--===============================================================================================-->


</head>

<body>


    <!-- menu da conta corrente caso tenha uma ou nao !-->

    <div class="card" style="width: 18rem; width:25%; float:right; margin-left:10%; background-color:#E8E8E8;">
        <?php if ($conta) { ?>
            <div class="card-body">
                <h5>Saldo em Conta</h5>
                <p class="card-text">R$ <?php echo $conta[0]['saldo']; ?></p>

                <?php if ($conta[0]['tipo_conta'] == 1) { ?> <a href="#" class="btn btn-primary">Adicionar Dinheiro</a><?php } elseif ($conta[0]['tipo_conta'] == 2) { ?>

                    <a href="#" class="btn btn-primary">Transferir Dinheiro</a>
                <?php } ?>
            <?php } else { ?>
                <h5 class="card-title">Não é possível mostrar o Saldo pois não existe uma conta vinculada!</h5>
                <a href="ContaPag" class="btn btn-primary">Vincular Conta</a>
            <?php } ?>
            </div>
    </div>
    <?php if ($resultado) {
    ?>
        <div class="container-login100 " style="background-color:white; padding-bottom:400px;">
            <div class="col-md-6 col-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">


                        <span style="color:white; " class="login100-form-title  ">
                            Transações Financeiras

                        </span>
                    </div>
                    <div class="panel-body">


                        <table class="table ">
                            <thead>
                                <th scope="col">Data Pagamento</th>
                                <?php if ($_SESSION['tipo_user'] == 1) {
                                ?> <th scope="col">Favorecido</th>
                                    <th scope="col">Transferido</th>
                                <?php } elseif ($_SESSION['tipo_user'] == 2) { ?>
                                    <th scope="col">Pagador</th>
                                    <th scope="col">Recebido</th>
                                <?php } ?>


                            </thead>
                            <?php if ($resultado == true) {
                            ?>

                                <?php foreach ($resultado as $t) {

                                    $novadata = date('d/m/Y H:i', strtotime($t["data_mod"]));
                                ?>


                                    <tbody>

                                        <th scope="col"><?php echo $novadata; ?></th>
                                        <th scope="col">
                                            <?php echo $t["para"]; ?></th>
                                        <th scope="col" style='text-align:center;'><?php echo $t["quantidade"]; ?>
                                    </tbody>
                                <?php } ?>
                            <?php } ?>



                        </table>

                    <?php } ?>


                    </div>
                </div>
            </div>
        </div>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</body>

</html>