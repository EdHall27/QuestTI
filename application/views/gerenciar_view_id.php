<!DOCTYPE html>
<html lang="en">

<head>
    <title>QuesTi</title>

    <!--===============================================================================================-->


</head>


<body>


    <?php


    $color = "btn btn-danger btn-sm";
    $acao1 = "disabled";
    @$acao = $_GET['acao'];
    //liberando para editar solciitacao
    if ($acao == "editar") {
        $acao1 = "";
    } else {
        $acao1 = "disabled";
    }

    @$acao_user = $_GET['acao_user'];

    if ($tecnicos['status'] == 0) {
        $acao = "Liberar Usuario";
        $color = "btn btn-success btn-sm";
        $action = "liberar_acesso";
        $status = "Bloqueado";
    } elseif ($tecnicos['status'] == 1) {
        $acao = "Bloquear Usuario";
        $action = "bloquear_acesso";
        $status = "liberado";
    }







    ?>


    <div class="wrapper" ></div>

    <div class="container-login100 " >
        <div class="modal fade" id="confirmar" role="dialog">
            <div class="modal-dialog modal-md">

                <div class="modal-content">
                    <div class="modal-body">
                        <p> Realmente deseja executar essa ação?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="<?php echo $action . "?id=" . $tecnicos['id_tec']; ?>" type="button" class="btn btn-success" id="delete">Sim</a>
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="excluir" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-body">
                    <p> Realmente deseja excluir o Usuário?</p>
                </div>
                <div class="modal-footer">
                    <a href="delete?del=<?php echo $tecnicos['id_tec']; ?>" type="button" class="btn btn-danger" id="delete">Apagar Registo</a>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                </div>
            </div>

        </div>
    </div>

    <div class=" col-offset-1" style="background-color:white; padding-left:450px; padding-right:450px; ">
        <div class="panel panel-primary">
            <div class="panel-heading">


                <span style="color:white" class="login100-form-title ">
                    Gerenciar Usuário

                </span>
            </div>

            <div class="panel-body">

                <div hidden class="form-group">
                    <label for="inputAddress">Id</label>
                    <input disabled value="<?php echo $tecnicos["id_tec"]; ?>" id="cep" name="cep" type="text" class="form-control" id="inputAddress">
                </div>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Nome</label>
                        <input <?php echo $acao1; ?> id="cel" value="<?php echo $tecnicos["nome"]; ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Area de Atuacao</label>
                        <input <?php echo $acao1; ?> value="<?php echo $tecnicos["area_atuacao"]; ?>" id="tel" name="tel" type="text" class="form-control" id="inputEmail4">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Cpf</label>
                        <input disabled id="cel" value="<?php echo $tecnicos["cpf_tec"]; ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Certificado</label>
                        <input <?php echo $acao1; ?> id="cel" value="<?php echo $tecnicos["certificado"]; ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Telefone</label>
                        <input <?php echo $acao1; ?> id="cel" value="<?php echo $tecnicos["telefone"]; ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Email</label>
                        <input <?php echo $acao1; ?> id="cel" value="<?php echo $tecnicos['email'] ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Endereço</label>
                        <input <?php echo $acao1; ?> id="cel" value="<?php echo $tecnicos['endereco']; ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Cep</label>
                        <input <?php echo $acao1; ?> id="cel" value="<?php echo $tecnicos['cep']; ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Cep</label>
                        <input <?php echo $acao1; ?> id="cel" value="<?php echo $tecnicos['celular']; ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Avaliação</label>
                        <input <?php echo $acao1; ?> id="cel" value="<?php echo $tecnicos['avaliacao']; ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Status</label>
                        <input disabled id="cel" value="<?php echo $status; ?>" name="cel" type="text" class="form-control" id="cel">
                    </div>


                </div>


                <button type="button" class="<?php echo $color; ?>" data-toggle="modal" data-target="#confirmar"><?php echo $acao; ?></button>


                <!--
                    <a href="gerenciar_id?id=<?php/* echo $tecnicos['id_tec'] */?>&acao=editar"> <button type="button" class="btn btn-primary btn-sm">Editar Usuario</button></a>!-->


                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#excluir">Excluir Usuario</button>


            </div>




        </div>
    </div>
    </div>

    <?php
    if (isset($_GET['message'])) {
        $mensagem = $_GET['message'];
    ?>

        <?php if ($mensagem == "liberado") { ?>
            <script>
                $(document).ready(function() {

                    swal("Usuário liberado !", "O usuário foi liberado com sucesso!", "success", {
                        confirmButtonText: "OK",
                    }).then(function() {
                        window.location.href = "#";
                    });
                });
            </script>
        <?php } ?>


        <?php if ($mensagem == "bloqueado") { ?>
            <script>
                $(document).ready(function() {

                    swal("Bloqueado com Sucesso!", "O usuário foi bloqueado com sucesso!", "success", {
                        confirmButtonText: "OK",
                    }).then(function() {
                        window.location.href = "#";
                    });
                });
            </script>
        <?php } ?>

    <?php } ?>


</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>