<!DOCTYPE html>
<html lang="en">

<head>
    <title>QuesTi</title>

    <!--===============================================================================================-->


</head>

<body>


    <!-- menu da conta corrente caso tenha uma ou nao !-->

    <div class="card" style="width: 18rem; width:30%; float:right; margin-left:10%;">
        <?php if ($conta) { ?>
            <div class="card-body">
                <h5 class="card-title">Saldo em Conta</h5>
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
        <div class="container-login100 " style="background-color:white;">
            <div class="">
                <div class="panel panel-primary">
                    <div class="panel-heading">


                        <span style="color:white" class="login100-form-title ">
                            Transações Financeiras

                        </span>
                    </div>


                    <table class="table table-responsive">
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
                            ?>


                                <tbody>

                                    <th scope="col"><?php echo $t["data_mod"]; ?></th>
                                    <th scope="col">
                                        <?php echo $t["para"]; ?></th>
                                    <th scope="col"><?php echo $t["quantidade"]; ?>
                                    <th scope="col"><?php echo $t["id"]; ?></th>
                                </tbody>
                            <?php } ?>
                        <?php } ?>



                    </table>

                <?php }
            if (isset($_GET['message'])) {
                $mensagem = $_GET['message'];
                ?>
                    <?php if ($mensagem == "deletado") { ?>
                        <script>
                            $(document).ready(function() {

                                swal("Deletado com Sucesso!", "O usuário foi deletado com sucesso!", "success", {
                                    confirmButtonText: "OK",
                                }).then(function() {
                                    window.location.href = "gerencia";
                                });
                            });
                        </script>
                    <?php } ?>
                <?php } ?>
                </div>
            </div>


            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</body>

</html>