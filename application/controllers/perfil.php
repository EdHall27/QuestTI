<?php
class Perfil extends CI_Controller
{

  public function index()
  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }


    $this->load->view('/template/layout-base.html');
    $this->load->view('/template/index.php');
    $this->load->view('/perfil/perfil.html');
    $this->load->view('/template/roda-pe-base.html');
  }


  public function trocar_senha()
  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }


    $this->load->view('/template/layout-base.html');
    $this->load->view('/template/index.php');
    $this->load->view('/perfil/edit_senha.html');
    $this->load->view('/template/roda-pe-base.html');
  }

  public function mostra_termo()
  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }
    $this->load->view('/template/layout-base.html');
    $this->load->view('/perfil/termo_uso.html');

  }



  public function update_termo()
  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }



    if (isset($_POST["aceito"])) {
      $valor = 1;
    } else {

      if (isset($_POST["recusado"])) {
        $valor = 0;
      } else {
        $valor = null;
      }
    }

    $data["termo"] = $valor;

    $data1['email'] = $_SESSION['email'];



    if ($_SESSION['tipo_user'] == 1) {
      $table = "cliente_cli";
      $pagina = header("Location: ../welcome?message=errorlogin");
    } elseif ($_SESSION['tipo_user'] == 2) {
      $table = "tecnico";
      $pagina = header("Location: ../welcome?message=errorlogin");
    }


    //chamando dois métodos uma para verificar se email já existe e outro para verificar  o cpf
    $this->load->model('Usuario');
    $verifica_email = (array) $this->Usuario->buscar_email($data1, $table);


    //definindo a tabela


    if ($verifica_email['termo'] == 0) {


      if (@$valor != null) {

        $this->load->model('Usuario');
        $verifica_email =  $this->Usuario->updatetermo($data, $data1['email'], $table);
        $this->update_termo();
      } else {

        $this->load->view('/template/layout-base.html');
        $this->load->view('dashboard.php');
        $this->load->view('/perfil/termo_uso.html');
        $this->load->view('/template/roda-pe-base.html');
      }
    } else {
      $this->load->view('/template/layout-base.html');
      $this->load->view('dashboard.php');
      $this->load->view('/perfil/termo_uso.html');
      $this->load->view('/template/roda-pe-base.html');
    }
  }
}
