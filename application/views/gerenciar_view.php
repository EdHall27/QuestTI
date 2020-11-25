<!DOCTYPE html>
<html lang="en">

<head>
  <title>QuesTi</title>

  <!--===============================================================================================-->


</head>

<body>
  <div class="container-login100 " style="background-color:white;">
    <div class="">
      <div class="panel panel-primary">
        <div class="panel-heading">


          <span style="color:white" class="login100-form-title ">
            Gerenciar Usuários

          </span>
        </div>


        <?php if ($tecnicos == true) {
        ?>


          <table class="table table-responsive">
            <thead>
              <th scope="col">Id</th>
              <th scope="col">Nome</th>
              <th scope="col">Area de Atuação</th>
              <!--  <th scope="col">cpf</th> !-->
              <th scope="col">Certificado</th>
              <th scope="col">Telefone</th>
              <th scope="col">Celular</th>
              </th>
              <th scope="col">Email</th>
              <th scope="col">Endereço</th>
              <th scope="col">Status</th>
              <th scope="col">Ações</th>
            </thead>

          <?php }
          ?>


          <div class="modal fade" id="confirm" role="dialog">
            <div class="modal-dialog modal-md">

              <div class="modal-content">
                <div class="modal-body">
                  <p> Realmente deseja executar essa ação?</p>
                </div>
                <div class="modal-footer">
                  <a href="/gerencia_cadastro/gerencia/<?php echo $metodo;  ?>?id=<?php echo $t['id_tec']; ?>" type="button" class="btn btn-danger" id="delete">Sim</a>
                  <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                </div>
              </div>

            </div>
          </div>


          <?php
          foreach ($tecnicos as $t) {

            if ($t["status"] == 0) {
              $color = "alert-danger";
              $chave = "Bloqueado";
              $metodo = "liberar_acesso";
            } else {
              $chave = "Liberado";
              $color = " alert-success  ";

              $metodo = "bloquear_acesso";
            }
          ?>



            <tbody>
              <th scope="col"><?php echo $t["id_tec"]; ?></th>
              <th scope="col"><?php echo $t["nome"]; ?></th>
              <th scope="col"><?php echo $t["area_atuacao"]; ?></th>
              <!--   <th scope="col"><?php /*echo $t["cpf_tec"]; */ ?></th> !-->
              <th scope="col"><a target="blank" href="/application/uploads/<?php echo $t["certificado"] ?>" class=" alert-danger">
                  <?php if ($t["certificado"] != "") { ?> <h5>Visualizar</h5><a></th><?php } ?>
            <th scope="col"><?php echo $t["telefone"]; ?></th>
            <th scope="col"><?php echo $t["celular"]; ?></th>
            <th scope="col"><?php echo $t["email"]; ?></th>
            <th scope="col"><?php echo $t["endereco"]; ?></th>

            <input hidden id="id" name="id" value="<?php echo $t["id_tec"]; ?>"> </input>
            <th scope="col" class="<?php echo $color; ?>">
              <h5><?php echo $chave ?></h5>
            </th>

            <th scope="col" style='text-align:center'><a href="/gerencia_cadastro/gerencia/gerenciar_id?id=<?php echo $t["id_tec"]; ?>" type="button">
                <h5>Alterar</h5>
              </a></th>


            </tbody>
          <?php } ?>



          </table>

          <?php
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