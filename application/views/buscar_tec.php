<!DOCTYPE html>
<html lang="en">

<head>
  <title>QuesTi</title>

  <!--===============================================================================================-->


</head>

<body>
  <?php


  if (isset($_GET['tecnicos'])) {
    $tecselect = $_GET['tecnicos'];
  } else {
    $tecselect = "todos";
  }


  ?>

  <?php if ($tecselect != "favoritos") { ?>
    <button type="button" class="btn  btn-sm" style="background-color:CornflowerBlue; "> <a href="/home?tecnicos=favoritos" style="color:black; padding-left:70px;">Técnicos Favoritos</a></button>
  <?php } else { ?>

    <button type="button" class="btn  btn-sm" style="background-color:CornflowerBlue; "> <a href="/home?tecnicos=todos" style="color:black; padding-left:70px;">Todos Técnicos</a></button>
  <?php } ?>
  <input type="text" class="input-search" alt="lista-tecnicos" placeholder="Buscar...">
  <div class="container-login100 " style="background-color:white; padding-left:55px;">


    <?php
    if ($tecselect == "todos") {
      foreach ($tecnicos as $t) {




    ?>

        <div class="col-md-4">
          <div class="card border border-dark ">
            <div class="" style="background-color:CornflowerBlue">
              <img class="border border-white rounded-circle" style="background-color:	white" src="/assets/images/tec/tec.png" height="100" width="100" />
            </div>
            <div class="card-inner">
              <div class="header">
                <br>
                <div class="border rounded">
                  <td> <label for="inputEmail4"><?php echo $t["nome"]; ?></label></td><br>

                  <tr><label for="inputEmail4">Área de Atuação :</label>
                    <td> <label for="inputEmail4"><?php echo $t["area_atuacao"]; ?></label></td><br>

                    <td><label for="inputEmail4">Nota Média :</label></td>
                    <td><label for="inputEmail4"> <?php echo $t["avaliacao"]; ?></label><br></td>
                    <td> <label for="inputEmail4">Endereço:</label></td>
                    <td><label for="inputEmail4"> <?php echo $t["endereco"]; ?></label></td>
                  </tr>

                </div>
              </div>
              <div class="content">
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
                <label>
                  <img src="../assets/images/icons/<?php echo $estrela1; ?>" id="s1"></label>

                <label>
                  <img src="/../assets/images/icons/<?php echo $estrela2; ?>" id="s2"></label>

                <label>
                  <img src="../../assets/images/icons/<?php echo $estrela3; ?>" id="s3"></label>

                <label>
                  <img src="../../assets/images/icons/<?php echo $estrela4; ?>" id="s4"></label>

                <label>
                  <img src="../../assets/images/icons/<?php echo $estrela5; ?>" id="s5"></label>
                <!--   <p id="rating" name="rating"><?php/* echo $t['avaliacao']; */?></p> !-->
                <br><br>
                <button type="button" class="btn  btn-sm" style="background-color:CornflowerBlue; "><a href="/chamados/nova_solicitacao?id=<?php echo $t["id_tec"]; ?>" style="color:black">Solicitar Tecnico</a></button>

                <br><br>
              </div>
            </div>
          </div>
          <br>
        </div>
      <?php }
    } elseif ($tecselect == "favoritos") { ?>

      <?php foreach ($favoritos as $t) {

        if ($t['email'] != "") {


      ?>

          <div class="col-md-4">
            <div class="card border border-dark ">
              <div class="" style="background-color:CornflowerBlue">
                <img class="border border-white rounded-circle" style="background-color:	white" src="/assets/images/tec/tec.png" height="100" width="100" />
              </div>
              <div class="card-inner">
                <div class="header">
                  <br>
                  <div class="border rounded">
                    <td> <label for="inputEmail4"><?php echo $t["nome"]; ?></label></td><br>

                    <tr><label for="inputEmail4">Área de Atuação :</label>
                      <td> <label for="inputEmail4"><?php echo $t["area_atuacao"]; ?></label></td><br>

                      <td><label for="inputEmail4">Nota Média :</label></td>
                      <td><label for="inputEmail4"> <?php echo $t["avaliacao"]; ?></label><br></td>
                      <td> <label for="inputEmail4">Endereço:</label></td>
                      <td><label for="inputEmail4"> <?php echo $t["endereco"]; ?></label></td>
                    </tr>

                  </div>
                </div>
                <div class="content">
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
                  <label>
                    <img src="../assets/images/icons/<?php echo $estrela1; ?>" id="s1"></label>

                  <label>
                    <img src="/../assets/images/icons/<?php echo $estrela2; ?>" id="s2"></label>

                  <label>
                    <img src="../../assets/images/icons/<?php echo $estrela3; ?>" id="s3"></label>

                  <label>
                    <img src="../../assets/images/icons/<?php echo $estrela4; ?>" id="s4"></label>

                  <label>
                    <img src="../../assets/images/icons/<?php echo $estrela5; ?>" id="s5"></label>
                  <!--   <p id="rating" name="rating"><?php/* echo $t['avaliacao']; */?></p> !-->
                  <br><br>
                  <button type="button" class="btn  btn-sm" style="background-color:CornflowerBlue; "><a href="/chamados/nova_solicitacao?id=<?php echo $t["id_tec"]; ?>" style="color:black">Solicitar Tecnico</a></button>

                  <br><br>
                </div>
              </div>
            </div>
            <br>
          </div>
      <?php }
      } ?>



    <?php }
    ?>

  </div>
  <style type="text/css">
    body {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif
    }

    /* " Para o input */
    .input-search {
      border: 1px solid #CCC;
      padding: 9px 150px;
      font-size: 12px;
      margin-right: 100px 0;

      -webkit-border-radius: 15px;
      -moz-border-radius: 15px;
      -ms-border-radius: 15px;
      -o-border-radius: 15px;
      border-radius: 15px;
      background-color: #A9A9A9;
    }
  </style>



  </div>





</body>

</html>