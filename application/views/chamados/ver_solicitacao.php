<!DOCTYPE html>
<html lang="en">

<head>
  <title>QuesTi</title>

  <!--===============================================================================================-->


</head>

<body>





  <?php if ($chamado_aberto == true || $chamado_andamento == true || $chamado_finalizado == true || $Emavaliacao || $AguardPagamento || $cancelado) {
  ?>


    <div class="container-login100 " style="background-color:white;">
      <div class="col-md-6 col-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">



            <span style="color:white" class="login100-form-title ">
              Minhas Solicitações

            </span>
          </div>

          <table class="table ">

            <thead>
              <th scope="col">ID</th>
              <th scope="col">Status</th>
              <th scope="col">Assunto</th>
              <th scope="col">Data abertura</th>
              <?php if ($chamado_finalizado == true) { ?>
                <th scope="col">Data Final</th>
              <?php } ?>
              <th scope="col">Anexo</th>

              <th scope="col">+Informações</th>
            </thead>

          <?php }
          ?>

          <?php
          if ($chamado_aberto == true) {
            foreach ($chamado_aberto as $t) {
              $status = "Em Aberto";
              $novadata = date('d/m/Y H:i', strtotime($t["data_abertura"]));

          ?>

              <tbody>
                <th scope="col"><?php echo $t["id_chamado"]; ?></th>
                <th scope="col"><?php echo $status ?></th>
                <th scope="col"><?php echo $t["assunto"]; ?></th>
                <th scope="col"><?php echo $novadata; ?></th>
                <th scope="col"><a target="_blank" href="../FILES/UPLOADS/<?php echo $t["arquivo"]; ?>"><?php if ($t["arquivo"] != "") { ?> Visualizar<?php } ?></a></th>
                <th scope="col" style="text-align: center" ;><a href="/chamados/solicitacao_comp?id=<?php echo $t['id_chamado']; ?>">ver mais </a></th>

              </tbody>
        </div>
    <?php }
          } ?>

    <?php
    if ($chamado_andamento == true) {
      foreach ($chamado_andamento as $t) {
        $status = "Em Andamento";
        $novadata = date('d/m/Y H:i', strtotime($t["data_abertura"]));

    ?>


        <tbody>
          <th scope="col"><?php echo $t["id_chamado"]; ?></th>
          <th scope="col"><?php echo $status ?></th>
          <th scope="col"><?php echo $t["assunto"]; ?></th>
          <th scope="col"><?php echo $novadata; ?></th>
          <th scope="col"><a target="_blank" href="../FILES/UPLOADS/<?php echo $t["arquivo"]; ?>"><?php if ($t["arquivo"] != "") { ?> Visualizar<?php } ?></a></th>
          <th scope="col" style="text-align: center" ;><a href="/chamados/solicitacao_comp?id=<?php echo $t['id_chamado']; ?>">ver mais </a></th>

        </tbody>
    <?php }
    } ?>




    <?php
    if ($Emavaliacao == true) {
      foreach ($Emavaliacao as $t) {
        $status = "Aguardando Avaliação";
        $novadata = date('d/m/Y H:i', strtotime($t["data_abertura"]));

    ?>


        <tbody>
          <th scope="col"><?php echo $t["id_chamado"]; ?></th>
          <th scope="col"><?php echo $status ?></th>
          <th scope="col"><?php echo $t["assunto"]; ?></th>
          <th scope="col"><?php echo $novadata; ?></th>
          <th scope="col"><a target="_blank" href="../FILES/UPLOADS/<?php echo $t["arquivo"]; ?>"><?php if ($t["arquivo"] != "") { ?> Visualizar<?php } ?></a></th>
          <th scope="col" style="text-align: center" ;><a href="/chamados/solicitacao_comp?id=<?php echo $t['id_chamado']; ?>">ver mais </a></th>

        </tbody>
    <?php }
    } ?>





    <?php
    if ($AguardPagamento == true) {
      foreach ($AguardPagamento as $t) {
        $status = "Aguardando Pagamento";
        $novadata = date('d/m/Y H:i', strtotime($t["data_abertura"]));

    ?>





        <tbody>
          <th scope="col"><?php echo $t["id_chamado"]; ?></th>
          <th scope="col"><?php echo $status ?></th>
          <th scope="col"><?php echo $t["assunto"]; ?></th>
          <th scope="col"><?php echo $novadata; ?></th>
          <th scope="col"><a target="_blank" href="../FILES/UPLOADS/<?php echo $t["arquivo"]; ?>"><?php if ($t["arquivo"] != "") { ?> Visualizar<?php } ?></a></th>
          <th scope="col" style="text-align: center" ;><a href="/chamados/solicitacao_comp?id=<?php echo $t['id_chamado']; ?>">ver mais </a></th>

        </tbody>
    <?php }
    } ?>





    <?php
    if ($chamado_finalizado == true) {
      foreach ($chamado_finalizado as $t) {
        $status = "Finalizado";
        $novadata = date('d/m/Y H:i', strtotime($t["data_abertura"]));

    ?>


        <tbody>
          <th scope="col"><?php echo $t["id_chamado"]; ?></th>
          <th scope="col"><?php echo $status ?></th>
          <th scope="col"><?php echo $t["assunto"]; ?></th>
          <th scope="col"><?php echo $novadata; ?></th>
          <th scope="col"><?php echo $t["data_fim"]; ?></th>
          <th scope="col"><a target="_blank" href="../FILES/UPLOADS/<?php echo $t["arquivo"]; ?>"><?php if ($t["arquivo"] != "") { ?> Visualizar<?php } ?></a></th>
          <th scope="col" style="text-align: center" ;><a href="/chamados/solicitacao_comp?id=<?php echo $t['id_chamado']; ?>">ver mais </a></th>

        </tbody>
    <?php }
    } ?>














    <?php
    if ($cancelado == true) {
      foreach ($cancelado as $t) {
        $status = "Cancelado";
        $novadata = date('d/m/Y H:i', strtotime($t["data_abertura"]));
    ?>





        <tbody>
          <th scope="col"><?php echo $t["id_chamado"]; ?></th>
          <th scope="col"><?php echo $status ?></th>
          <th scope="col"><?php echo $t["assunto"]; ?></th>
          <th scope="col"><?php echo $novadata; ?></th>
          <th scope="col"><?php echo $t["data_fim"]; ?></th>
          <th scope="col"><a target="_blank" href="../FILES/UPLOADS/<?php echo $t["arquivo"]; ?>"><?php if ($t["arquivo"] != "") { ?> Visualizar<?php } ?></a></th>
          <th scope="col" style="text-align: center" ;><a href="/chamados/solicitacao_comp?id=<?php echo $t['id_chamado']; ?>">ver mais </a></th>

        </tbody>
    <?php }
    } ?>






    </table>




      </div>
    </div>





</body>

</html>