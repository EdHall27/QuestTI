<!DOCTYPE html>
<html lang="en">

<head>
  <title>QuesTi</title>

  <!--===============================================================================================-->


</head>


<body>
  <div class="container-login100 " style="background-color:white;">
    <div class="col-md-6 col-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">


          <span style="color:white" class="login100-form-title ">
            +Informações

          </span>
        </div>
        <div class="panel-body">


          <?php if ($chamado_id == true) {
          ?>


            <?php


            @$liberacao = $_GET['liberacao'];
            //liberando para editar solciitacao
            if ($liberacao == "editar") {
              $edit = "disabled";
              $acao1 = "";
              $div_visible = true;
              $cor = "btn btn-success btn-sm";
            } else if ($liberacao == "avaliar") {
              $acao1 = "disabled";
              $edit = "";
              $div_visible = true;
              $cor = "btn btn-success btn-sm";
            } else {
              $edit = "disabled";
              $acao1 = "disabled";
              $div_visible = false;
              $cor = "btn btn-danger btn-sm";
            }

            @$acao_user = $_GET['acao_user'];




            //inicalmente bloqueado acções de obs do chamado
            $liberacaoobs = "readonly";


            if (isset($_GET['acao'])) {
              @$acao = $_GET['acao'];
            }


            if (isset($_GET['idobs'])) {
              @$idobs = $_GET['idobs'];
            } else {
              @$idobs = null;
            }






            foreach ($chamado_id as $t) {


            ?>


              <?php $id_cha = $t["id_chamado"]; ?>


            <?php }

            $liberar_avaliacao = false;
            // convert o que vem do banco em int para uma string
            if ($t["status"] == 1) {
              $status = "Em Andamento";
            } else if ($t["status"] == 0) {
              $status = "Em Espera";
            } else if ($t["status"] == 2) {
              $status = "Aguardando Avaliação";
              $liberar_avaliacao = true;
            } else if ($t["status"] == 3) {

              $status = "Aguardando Pagamento";
            } else if ($t["status"] == 4) {

              $status = "Finalizado";
            } else if ($t["status"] == 5) {

              $status = "Cancelado";
            } else if ($acao_user == "cancelar") {
              $status = "Cancelado";
            }







            ?>


            <!-- aqui cuida de todas mudanças que n saem fora do fluxo  natural dos status !-->

            <div class="modal fade" id="mudar_status" role="dialog">
              <div class="modal-dialog modal-md">

                <div class="modal-content">
                  <div class="modal-body">
                    <p>
                      <h5><?php if ($t['status'] == 0) {
                            echo 'Deseja Realmente capturar a Solicitação?';
                            $modo = "Capturar";
                          } else if ($t['status'] == 1) {
                            echo 'Deseja Realmente finalizar a Solicitação?';
                            $modo = "Finalizar";
                          } else if ($t['status'] == 2) {
                            echo 'Avalie o Atendimento';
                            $modo = "Avaliar";
                          } else if ($t['status'] == 3) {
                            echo 'Você deve estar ciente que assim que clicar em "liberar pagamento" o valor total de ' . $t['total'] . ' do serviço será automáticamente descontado de sua conta!';
                            $modo = "Liberar Pagamento";
                          }
                          ?>
                      </h5>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <a href="/chamados/solicitacao_muda_status?status=<?php echo $t["status"]; ?>&id=<?php echo $t["id_chamado"]; ?>&valor=<?php echo $t["total"]; ?>" type="button" class="btn btn-success" id="delete">
                      <?php echo $modo; ?>
                    </a>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                  </div>
                </div>

              </div>
            </div>




            <div class="modal fade" id="cancelar" role="dialog">
              <div class="modal-dialog modal-md">

                <div class="modal-content">
                  <div class="modal-body">
                    <p> Realmente deseja cancelar a Solicitação?</p>
                  </div>
                  <div class="modal-footer">
                    <a href="solicitacao_muda_status?status=5&id=<?php echo $t["id_chamado"]; ?>" type="button" class="btn btn-success" id="delete">Sim</a>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                  </div>
                </div>

              </div>
            </div>



            <div class="modal fade" id="finalizar" role="dialog">
              <div class="modal-dialog modal-md">
                <form action="solicitacao_muda_status" method="GET" id="finalizartec">
                  <div class="modal-content">
                    <div class="modal-body">

                      <p>
                        <h5>Antes de finalizar insira o valor total do Serviço!</h5>
                      </p>

                    </div>
                    <div class="modal-footer">

                      <input hidden type="number" value="<?php echo $t['id_chamado']; ?>" name="id" id="id">
                      <input hidden type="number" value=1 name="status" id="status">


                      <label>Valor Total em R$</label>

                      <input id="total" value="" name="total" class="form-control" type="Text" size="12" onKeyUp="mascaraMoeda(this, event)">

                      <button type="submit" class="btn btn-success" id="delete">Finalizar Solicitação</button>
                      <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>



            <div class="modal fade" id="excluir" role="dialog">
              <div class="modal-dialog modal-md">

                <div class="modal-content">
                  <div class="modal-body">
                    <p> Realmente deseja excluir a Solicitação?</p>
                  </div>
                  <div class="modal-footer">
                    <a href="DeleteChamado?id_chamado=<?php echo $t['id_chamado']; ?>" type="button" class="btn btn-danger" id="delete">Apagar Registo</a>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                  </div>
                </div>

              </div>
            </div>


            <!-- modal de avaliacao do usuario !-->


            <div id="meuModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <form action="avaliarAtend" method="POST">
                  <!-- Conteúdo do modal-->
                  <div class="modal-content">

                    <!-- Cabeçalho do modal -->
                    <div class="modal-header">
                      <h4 class="modal-title">Avaliar Atendimento</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Corpo do modal -->
                    <div class="modal-body">

                      <body>
                        <a href="javascript:void(0)" onclick="Avaliar(1)">
                          <img src="../assets/images/icons/star0.png" id="s1"></a>

                        <a href="javascript:void(0)" onclick="Avaliar(2)">
                          <img src="/../assets/images/icons/star0.png" id="s2"></a>

                        <a href="javascript:void(0)" onclick="Avaliar(3)">
                          <img src="../../assets/images/icons/star0.png" id="s3"></a>

                        <a href="javascript:void(0)" onclick="Avaliar(4)">
                          <img src="../../assets/images/icons/star0.png" id="s4"></a>

                        <a href="javascript:void(0)" onclick="Avaliar(5)">
                          <img src="../../assets/images/icons/star0.png" id="s5"></a>

                        <p id="rating" name="rating">0</p>
                        <input hidden value="" name="ratinginput" type="int" id="ratinginput">
                      </body>
                    </div>
                    <input hidden value="<?php echo $t["id_chamado"]; ?>" name="id_chamado" type="int" class="form-control" id="id_chamado">

                    <input hidden value="<?php echo $t["cpf_tecnico"]; ?>" name="cpf_tec" type="text" class="form-control" id="cpf_tec">
                    <!-- Rodapé do modal-->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                      <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>

                  </div>
                </form>
              </div>
            </div>



            <div class="modal fade" id="editarobs" role="dialog">
              <div class="modal-dialog modal-md">

                <div class="modal-content">
                  <div class="modal-body">
                    <input class="idobs" name="idobs" id="idobs">
                    </input>
                    <h5>Edite a Observação!</h5>
                    </p>

                  </div>
                  <div class="modal-footer">




                    <button type="button" class="btn btn-success editar" id="editar">Finalizar Solicitação</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                  </div>
                </div>

              </div>
            </div>





            <div class="modal fade" id="adicionarobs" role="dialog">
              <div class="modal-dialog modal-md">
                <form action="/HistObs/AdicionarObs" method="POST" id="finalizartec">
                  <div class="modal-content">
                    <div class="modal-body">

                      <p>
                        <h5>Adicione a Obervação!</h5>
                      </p>
                      <input type="text" value="" name="obs" id="obs" class="form-control">
                    </div>
                    <div class="modal-footer">



                      <input hidden type="number" value="<?php echo $t['id_chamado']; ?>" name="id" id="id">
                      <input hidden type="text" value="mostradiv" name="div" id="div">


                      <button type="submit" class="btn btn-success" id="delete">Adicionar</button>
                      <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>


            <form method="POST" action="updateChamado">

              <div class="form-group" hidden>
                <label for="inputAddress">Id</label>
                <input readonly value="<?php echo $t["id_chamado"]; ?>" name="id_chamado" type="int" class="form-control" id="id_chamado">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4"><?php if($_SESSION['tipo_user'] == 1){echo "Técnico";} elseif($_SESSION['tipo_user'] == 2){ echo "Solicitante";}
                   ?></label>
                  <input readonly <?php echo $acao1; ?> value="<?php if($_SESSION['tipo_user'] == 1){echo $t["nome_tec"];} elseif($_SESSION['tipo_user'] == 2){echo $t["nome_cli"];}
                   ?>" id="cpf_tec" name="cpf_tec" type="text" class="form-control" id="inputEmail4">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Assunto</label>
                  <input <?php echo $acao1; ?> id="assunto" value="<?php echo $t["assunto"]; ?>" name="assunto" type="text" class="form-control" id="cel">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Descrição</label>
                  <input <?php echo $acao1; ?> id="descricao" name="descricao" value="<?php echo $t["descricao"]; ?>" type="text" class="form-control" id="cel">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Categoria</label>
                  <input <?php echo $acao1; ?> id="categoria" name="categoria" value="<?php echo $t["categoria"]; ?>" name="cel" type="text" class="form-control" id="cel">
                </div>


                <div class="form-group col-md-6">
                  <label for="inputPassword4">Anexo</label>

                  <div class="input-group">


                    <div class="input-group-prepend">
                    </div>
                    <input <?php echo $acao1; ?> id="anexo" name="anexo" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" value="<?php echo $t["arquivo"]; ?>">
                    <label class="custom-file-label" for="inputGroupFile01">Selecionar Arquivo</label>
                  </div>
                </div>



                <div class="form-group col-md-6">
                  <label for="inputPassword4">Status</label>
                  <input disabled id="status" value="<?php echo $status ?>" name="status" type="text" class="form-control" id="cel">
                </div>


                <div hidden class="form-group col-md-6">
                  <label for="inputPassword4">Status2</label>
                  <input id="status2" value="<?php echo $t["status"]; ?>" name="status2" type="text" class="form-control" id="cel">
                </div>

                <div class="form-group col-md-6">
                  <label for="inputPassword4">Valor Total</label>
                  <input disabled id="status" value="<?php echo $t["total"] ?>" name="total" type="text" class="form-control" id="total">
                </div>



                <div class="form-group col-md-6">
                  <label for="inputPassword4">Avaliação</label>
                  <?php
                  //classificando as estrelas para aparecer no front

                  if ($t['avaliacao'] == 0) {
                    $estrela1 = "star0.png";
                    $estrela2 = "star0.png";
                    $estrela3 = "star0.png";
                    $estrela4 = "star0.png";
                    $estrela5 = "star0.png";
                  } else if ($t['avaliacao'] == 1) {
                    $estrela1 = "star1.png";
                    $estrela2 = "star0.png";
                    $estrela3 = "star0.png";
                    $estrela4 = "star0.png";
                    $estrela5 = "star0.png";
                  } else if ($t['avaliacao'] == 2) {
                    $estrela1 = "star1.png";
                    $estrela2 = "star1.png";
                    $estrela3 = "star0.png";
                    $estrela4 = "star0.png";
                    $estrela5 = "star0.png";
                  } else if ($t['avaliacao'] == 3) {
                    $estrela1 = "star1.png";
                    $estrela2 = "star1.png";
                    $estrela3 = "star1.png";
                    $estrela4 = "star0.png";
                    $estrela5 = "star0.png";
                  } else if ($t['avaliacao'] == 4) {
                    $estrela1 = "star1.png";
                    $estrela2 = "star1.png";
                    $estrela3 = "star1.png";
                    $estrela4 = "star1.png";
                    $estrela5 = "star0.png";
                  } else if ($t['avaliacao'] == 5) {
                    $estrela1 = "star1.png";
                    $estrela2 = "star1.png";
                    $estrela3 = "star1.png";
                    $estrela4 = "star1.png";
                    $estrela5 = "star1.png";
                  }
                  ?>
                  <div>
                    <a>
                      <img src="../assets/images/icons/<?php echo $estrela1; ?>" id="s1"></a>

                    <a>
                      <img src="/../assets/images/icons/<?php echo $estrela2; ?>" id="s2"></a>

                    <a>
                      <img src="../../assets/images/icons/<?php echo $estrela3; ?>" id="s3"></a>

                    <a>
                      <img src="../../assets/images/icons/<?php echo $estrela4; ?>" id="s4"></a>

                    <a>
                      <img src="../../assets/images/icons/<?php echo $estrela5; ?>" id="s5"></a>
                    <!--   <p id="rating" name="rating"><?php/* echo $t['avaliacao']; */?></p> !-->
                    <br><br>
                  </div>
                </div>

              </div>












              <!-- aqui caso  dependendo do status e tip ode usuário liberar  determinados botões e funções diferentes para cada um !-->


              <?php if ($t["status"] != 4) { ?>
                <?php if ($div_visible == false) {
                  if ($_SESSION['tipo_user'] != 2) {
                    if ($t["status"] != 4 && $t["status"] != 5) {
                ?>

                      <a href="solicitacao_comp?status=<?php echo $t["status"]; ?>&id=<?php echo $t["id_chamado"]; ?>&liberacao=editar"> <button type="button" class="btn btn-primary btn-sm">Editar Registro</button></a>

                    <?php }
                  }

                  if ($_SESSION['tipo_user'] != 2 && $t["status"] == 2) { ?>

                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#meuModal">Avaliar Atendimento</button>

                  <?php   } ?>
                <?php   } else { ?>
                  <button type="submit" class="<?php echo $cor; ?>">Salvar</button>
                <?php } ?>

                <!--<a href="solicitacao_comp?status=<?php echo $t["status"]; ?>&id=<?php echo $t["id_chamado"]; ?>&liberacao=avaliar"> <button type="button" class="btn btn-success btn-sm">Avaliar Atendimento</button></a>
                meuModal !-->


                <?php if ($_SESSION['tipo_user'] == 1 && $t["status"] == 0) { ?>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#excluir">Excluir Solicitação</button>
                <?php  } ?>



                <?php if ($_SESSION['tipo_user'] == 2 && $t["status"] == 0) { ?>
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mudar_status">Capturar Solicitação</button>
                <?php  } ?>

                <?php if ($_SESSION['tipo_user'] != 2 && $t["status"] == 3) { ?>
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#mudar_status">Liberar Pagamento</button>
                <?php  } ?>

                <?php if ($_SESSION['tipo_user'] == 2 && $t["status"] == 1) { ?>
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#finalizar">Finalizar Solicitação</button>
                <?php  } ?>


                <?php if ($t['status'] < 2) { ?>
                  <?php if ($_SESSION['tipo_user'] == 1) { ?>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelar">Cancelar Solicitação</button>
                  <?php  } else { ?>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelar">Cancelar Chamado</button>
                  <?php } ?>

                <?php } ?>


              <?php  } ?>




            </form>
            <br><br>
            <div class="">
              <label style="color:#4682B4;" onclick="Mudarestado('mudadiv')">Histórico de Observações
                <i class="fas fa-angle-left right"></i></label>
            </div>
            <br>
          <?php } ?>
          <?php

          if (isset($_GET['mostradiv'])) {
            $divmostra = 'style="display:block;"';
          } else {
            $divmostra = 'style="display:none;"';
          }
          ?>
          <div id="mudadiv" <?php echo $divmostra; ?>>
            <form action="/HistObs/EditarObs" method="POST">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Obs</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Opções</th>
                  </tr>
                </thead>
                <tbody>



                  <?php

                  foreach ($histotico as $value) {

                    if ($idobs == $value['id']) {
                      $liberacaoobs = "";
                      $color1 = 'style = background-color:#C0C0C0;';
                    } else {
                      $liberacaoobs = "readonly";
                      $color1 = "";
                    }

                    $novadata = date('d/m/Y H:i', strtotime($value["data"]));
                  ?>

                    <td><input name="data" id="data" readonly value="<?php echo $novadata ?>"></td>
                    <td><input <?php echo $color1;  ?> name="obs" id="obs" <?php echo $liberacaoobs; ?> value="<?php echo $value['obs']; ?> "> </input></td>

                    <input hidden value="<?php echo $value['id'] ?>" id="id_obs" name="id_obs"></input>

                    <input hidden value="<?php echo $id_cha ?>" id="idChamado" name="idChamado"></input>

                    <td><input name="responsavel" id="responsavel" readonly value="<?php echo $value['responsavel'] ?>"></td>

                    <?php if (@$acao != "editobs" && $value['responsavel'] == $_SESSION['email']) { ?>
                      <td><a type="button" href="?id=<?php echo $id_cha; ?>&idobs=<?php echo $value['id']; ?>&acao=editobs&mostradiv=true" id="idobs" class="editar">Editar</a></td>
                    <?php } ?>

                    <?php if (@$acao == "editobs" && @$idobs == $value['id']  && $value['responsavel'] == $_SESSION['email']) { ?>
                      <td><button type="submit">Salvar</button></td>
                    <?php } ?>
                    <tr>
                    </tr>
                </tbody>

              <?php } ?>



              </table>


              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#adicionarobs">Adicionar Observação</button><br><br>
              <div class="">
            </form>
          </div>
          <?php

          //AQUI TRATA AS MENSAGENS DE RETORNO DO BACK-END 

          if (isset($_GET['message'])) {
            $mensagem = $_GET['message'];

          ?>
            <?php if ($mensagem == "editado") { ?>
              <script>
                $(document).ready(function() {

                  swal("Solicitação Alterada!", "A Solicitação foi editada com sucesso!", "success", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "ver_solicitacao?status=aberto";
                  });
                });
              </script>
            <?php } ?>


            <?php if ($mensagem == "erro_edit") { ?>
              <script>
                $(document).ready(function() {

                  swal("Erro ao Alterar!", "Não foi possivel salvar as edições!", "error", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>



            <?php if ($mensagem == "sts_ok") { ?>
              <script>
                $(document).ready(function() {

                  swal("Mudança de Status!", "O status da Solcitação foi alterado com sucesso!", "success", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>


            <?php if ($mensagem == "sts_err") { ?>
              <script>
                $(document).ready(function() {

                  swal("Erro ao alterar Status!", "Não foi possivel alterar o status da Solcitação!", "error", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>




            <?php if ($mensagem == "finalizado") { ?>
              <script>
                $(document).ready(function() {

                  swal("Solicitação Finalizada!", "O status da Solicitação foi alterado para Finalizado sucesso!", "success", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>


            <?php if ($mensagem == "err_finalizar") { ?>
              <script>
                $(document).ready(function() {

                  swal("Erro ao Finalizar Solicitação!", "Erro ao finalizar solicitação!", "error", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>



            <?php if ($mensagem == "excluido") { ?>
              <script>
                $(document).ready(function() {

                  swal("Excluído com Sucesso!", "Solicitação ecluída com sucesso!", "success", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>


            <?php if ($mensagem == "err_excluir") { ?>
              <script>
                $(document).ready(function() {

                  swal("Erro de Exclusão!", "Erro ao excluir solicitação!", "error", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>

            <?php if ($mensagem == "avaliado") { ?>
              <script>
                $(document).ready(function() {

                  swal("Avaliação Concluida!", "Avaliação cadastrada com sucesso!", "success", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>

            <?php if ($mensagem == "pago") { ?>
              <script>
                $(document).ready(function() {

                  swal("Pagamento Concluido!", "O Pagamento foi debitado automáticamente de sua conta!", "success", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>

            <?php if ($mensagem == "valoracima") { ?>
              <script>
                $(document).ready(function() {

                  swal(" Erro no pagamento!", "Foi verificado que o valor total é maior do que o saldo em conta , por favor adicione saldo para completar a transação!", "error", {
                    confirmButtonText: "ok",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>


            <?php if ($mensagem == "erroconta") { ?>
              <script>
                $(document).ready(function() {

                  swal(" Erro na Conta Corrente!", "Foi identificado um erro na conta corrente e o valor não foi possível ser depositado! ", "error", {
                    confirmButtonText: "ok",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>


            <?php if ($mensagem == "OBSedit") { ?>
              <script>
                $(document).ready(function() {

                  swal("Observação editada!", "A observação foi editada com sucesso!", "success", {
                    confirmButtonText: "OK",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>


            <?php if ($mensagem == "Erroredit") { ?>
              <script>
                $(document).ready(function() {

                  swal(" Erro ao editar observação!", "Não foi possível editar  a observação! ", "error", {
                    confirmButtonText: "ok",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>


            <?php if ($mensagem == "ErroPermissao") { ?>
              <script>
                $(document).ready(function() {

                  swal("Erro de permissão!", "Não é possível editar observações que não foram adicionadas por você! ", "error", {
                    confirmButtonText: "ok",
                  }).then(function() {
                    window.location.href = "#";
                  });
                });
              </script>
            <?php } ?>








          <?php

            //FIM DAS TRATATIVAS DE MENSAGENS E ALERTAS
          } ?>

        </div>
      </div>
    </div>
  </div>








  <script src="../assets/js/jquery.validate.min.js"></script>
  <script>
    String.prototype.reverse = function() {
      return this.split('').reverse().join('');
    };

    function mascaraMoeda(campo, evento) {
      var tecla = (!evento) ? window.event.keyCode : evento.which;
      var valor = campo.value.replace(/[^\d]+/gi, '').reverse();
      var resultado = "";
      var mascara = "##.###.###,##".reverse();
      for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
        if (mascara.charAt(x) != '#') {
          resultado += mascara.charAt(x);
          x++;
        } else {
          resultado += valor.charAt(y);
          y++;
          x++;
        }
      }
      campo.value = resultado.reverse();
    }

    $("#finalizartec").validate({
      rules: {
        total: {
          required: true,
        },

      },
      messages: {
        total: {
          required: "é obrigatório informar o valor para prosseguir!",
        },

      },
    });





    function Mudarestado(mudadiv) {
      var display = document.getElementById(mudadiv).style.display;
      if (display == "none")
        document.getElementById(mudadiv).style.display = 'block';
      else
        document.getElementById(mudadiv).style.display = 'none';
    }
  </script>

  <style>
    .error {
      color: red
    }

    #label {
      color: blue
    }
  </style>

</body>
<script src="../assets/js/funcoes.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</html>