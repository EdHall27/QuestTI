<!DOCTYPE html>

<html lang="en">

<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top  " style="background-color:  #0066cc">
      <a class="navbar-brand" href="#">QuestTi</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          
        
        <li class="nav-item active">
            <a class="nav-link" href="../home">Home <span class="sr-only">(current)</span></a>
          </li>
          <?php $_SESSION['tipo_user'] ?>

          <?php if($_SESSION['tipo_user']==0){?>
          <li class="nav-item ">
            <a class="nav-link" href="/gerencia_cadastro/gerencia">Gerenciar Cadastros</a>
          </li>
         <?php } ?>


         <?php if($_SESSION['tipo_user']==2){?>
         <li class="nav-item ">
            <a class="nav-link" href="../chamados">Gerenciar Chamados  <span class="sr-only">(current)</span></a>
          </li>
          <?php } ?>


          <?php if($_SESSION['tipo_user']==1){?>
         <li class="nav-item ">
            <a class="nav-link" href="../chamados">Solicitação de Serviços  <span class="sr-only">(current)</span></a>
          </li>
          <?php } ?>

          <?php if($_SESSION['tipo_user']!=0){?>
          <li class="nav-item ">
            <a class="nav-link" href="#">Histórico Pagamentos <span class="sr-only">(current)</span></a>
          </li>
          <?php } ?>

          <?php if($_SESSION['tipo_user']==0){?>
          <li class="nav-item ">
            <a class="nav-link" href="#">Relatórios <span class="sr-only">(current)</span></a>
          </li>
          <?php } ?>

          <?php if($_SESSION['tipo_user']==0){?>
          <li class="nav-item ">
            <a class="nav-link" href="#"> Feedback <span class="sr-only">(current)</span></a>
          </li>
          <?php } ?>

          <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li> -->
        </ul>
        <?php if($_SESSION['login'] ==true){?>
          <span class="navbar-brand">Bem vindo, <?php echo $_SESSION['login']; ?></span><br>
          <a class="btn btn-outline-success my-2 my-sm-0" href="/perfil">Perfil</a>
          <a class="btn btn-outline-success my-2 my-sm-0" href="/login/logof">Sair</a>
          <?php }?>
      </div>
    </nav>
</header>
</body>
</html>