<?php
defined('BASEPATH') or exit('No direct script access allowed');

class gerencia extends CI_Controller
{
  public function index()
  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }


    if (@$_SESSION['login'] != null) {  //Verificar se a sessão não já está aberta.


      $this->load->model('Usuario');
      $dados = $this->Usuario->buscarTodos("tecnico");


      $cont = 0;
      foreach ($dados as $array) {


        foreach ($array as $key => $value) {
          if ($key == "area_atuacao") {


            //aqui model que convert o id da area de atuacao em nome string para mostrar no front
            $this->load->model('AreaAtuacao');
            $id_convert = $this->AreaAtuacao->BuscaAreaId("areaatuacao", $value);


            @$dados[$cont][$key] = $id_convert->NomeArea;
          }
        }
        $cont = $cont + 1;
      }


      $data = array("tecnicos" => $dados);




      $this->load->view('dashboard.php');
      $this->load->view('/template/layout-base.html');
      $this->load->view('gerenciar_view', $data);
      $this->load->view('/template/roda-pe-base.html');
    } else {
      $this->load->view('/template/layout-base.html');
      $this->load->view('welcome.html');
      $this->load->view('/template/roda-pe-base.html');
    }
  }



  public function gerenciar_id()
  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }

    @$id_tec = $_GET['id'];

    if (@$_SESSION['login'] != null) {  //Verificar se a sessão não já está aberta.


      $this->load->model('Tecnico');
      $dados = (array)$this->Tecnico->buscarId("tecnico", $id_tec);




      $data = array("tecnicos" => $dados);


     
      $this->load->view('/template/layout-base.html');
      $this->load->view('dashboard.php');
      $this->load->view('gerenciar_view_id', $data);
    } else {
      $this->load->view('/template/layout-base.html');
      $this->load->view('welcome.html');
      $this->load->view('/template/roda-pe-base.html');
    }
  }

  public function liberar_acesso()
  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }



    $id = $this->input->get('id');

    $this->load->model('Tecnico');
    $data = (array)$this->Tecnico->buscarId("tecnico", $id);

    //setar o  valor de status para zero e da update
    $data['status'] = 1;



    $retorno = $this->Tecnico->updatebyid($data, "tecnico");


    if ($retorno) {
      // definindo insert de log
      $this->load->model('Movimentacao');
      $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "LiberadoAcesso");

      $timezone = new DateTimeZone('America/Sao_Paulo');
      $data1 = new DateTime('now', $timezone);
      $data1  =  $data1->format('Y/m/d H:i');

      $log = array(
        "id_tb" => $id,
        "NomeEntidade" => "tecnico",
        "TipoMov" => $id_mov[0]['id'],
        "data_mod" => $data1,
        "responsavel" => $_SESSION['email'],
      );

      $this->load->model('Log');
      $this->Log->setLog($log);
      $this->Log->inserirLog('logs');

      // fim insert de log
    }



    header("Location: gerenciar_id?message=liberado&id=$id");
    exit;
  }




  public function bloquear_acesso()
  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }



    $id = $this->input->get('id');


    //recupera todos os dados do tecnico
    $this->load->model('Tecnico');
    $data = (array)$this->Tecnico->buscarId("tecnico", $id);

    //setar o  valor de status para zero e da update
    $data['status'] = 0;



    $retorno = $this->Tecnico->updatebyid($data, "tecnico");


    // definindo insert de log
    $this->load->model('Movimentacao');
    $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "BloqueadoAcesso");

    $timezone = new DateTimeZone('America/Sao_Paulo');
    $data = new DateTime('now', $timezone);
    $data = $data->format('Y/m/d H:i');

    $log = array(
      "id_tb" => $id,
      "NomeEntidade" => "tecnico",
      "TipoMov" => $id_mov[0]['id'],
      "data_mod" => $data,
      "responsavel" => $_SESSION['email'],
    );

    $this->load->model('Log');
    $this->Log->setLog($log);
    $this->Log->inserirLog('logs');

    // fim insert de log

    header("Location: gerenciar_id?message=bloqueado&id=$id");
    exit;
  }


  function delete()
  {


    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }



    $id = $this->input->get('del');



    $table = "tecnico";

    $retorno = $this->db->where('id_tec', $id);
    $retorno = $this->db->delete($table);



    // definindo insert de log
    $this->load->model('Movimentacao');
    $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "exclusão");

    $timezone = new DateTimeZone('America/Sao_Paulo');
    $data = new DateTime('now', $timezone);
    $data = $data->format('Y/m/d H:i');

    $log = array(
      "NomeEntidade" => "tecnico",
      "TipoMov" => $id_mov[0]['id'],
      "data_mod" => $data,
      "responsavel" => $_SESSION['email'],
    );

    $this->load->model('Log');
    $this->Log->setLog($log);
    $this->Log->inserirLog('logs');

    // fim insert de log


    header("Location: ../gerencia?message=deletado");
    exit;
  }
}
