<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Login extends CI_Controller
{
  /**
   * Recebe o post do login
   */
  public function home()
  {
    $this->load->view('/template/layout-base.html');
    $this->load->view('welcome.html');
    $this->load->view('/template/roda-pe-base.html');
  }

  public function logar()
  {



    // se houver envio de post coloca em um array
    if (isset($_POST['email']) && isset($_POST['senha'])) {
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      $data = array(
        "email" => $email,
        "senha" => $senha
      );



      //como enviar dados para model

      //chama a model de verificacao

      $this->load->model('Usuario');

      //se autenticacao der certo libera acesso se nao volta pra o login
      //faz select nas 2 teabelas para ver se tem algum usuario valido em alguma delas 
      $retorno = $this->Usuario->autenticar($data, 'administracao');
      $retorno2 = $this->Usuario->autenticar($data, 'cliente_cli');
      $data['status'] = $retorno2;



      //definindo a tabela de atuacao
      if ($retorno) {
        $entidade = "adminsitracao";
      } elseif ($retorno2) {
        $entidade = "cliente_cli";
      }


      if ($retorno || $retorno2) {


        // definindo insert de log
        $this->load->model('Movimentacao');
        $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "Login");

        $timezone = new DateTimeZone('America/Sao_Paulo');
        $data = new DateTime('now', $timezone);
        $data = $data->format('Y/m/d H:i');

        $log = array(
          "NomeEntidade" => $entidade,
          "TipoMov" => $id_mov[0]['id'],
          "data_mod" => $data,
          "responsavel" => $email,
        );

        $this->load->model('Log');
        $this->Log->setLog($log);
        $this->Log->inserirLog('logs');

        // fim insert de log





        // redirecionando apra pagina inicial




        if ($entidade == "adminsitracao") {


          $this->load->model('Log');

          // numero de cadastros total
          $cadastrostec = $this->Log->PesquisaLog("cadastro", 3, "tecnico");
          $cadastrostecc  = $this->Log->CompilaDados($cadastrostec);

          $cliente_cli = $this->Log->PesquisaLog("cadastro", 3, "cliente_cli");
          $cliente_clic = $this->Log->CompilaDados($cliente_cli);


          // soma o total de cadastros feitos
          $totalcadastros = $cadastrostecc + $cliente_clic;

          //usuarios liberados 
          $tecnicolib = $this->Log->PesquisaLog("LiberadoAcesso", 3, "tecnico");
          $tecnicolibc = $this->Log->CompilaDados($tecnicolib);

          //usuarios bloqueados

          $tecnicoblock = $this->Log->PesquisaLog("BloqueadoAcesso", 3, "tecnico");
          $tecnicoblockc = $this->Log->CompilaDados($tecnicoblock);

          //usuarios excluido

          $tecexc = $this->Log->PesquisaLog("exlusão", 3, "tecnico");
          $tecexcc = $this->Log->CompilaDados($tecexc);




          $dados = array(
            "cadastros"    => $totalcadastros,
            "TecnicosLiberados" => $tecnicolibc,
            "TecnicosBloqueados"  => $tecnicoblockc,
            "TecnicosExcluidos" => $tecexcc,
          );

   
          
          $this->load->view('/template/layout-base.html');
          $this->load->view('dashboard.php');
          $this->load->view('/grafico/grafico_admin.php', $dados);
          $this->load->view('/template/roda-pe-base.html');
          
        } elseif ($entidade == "cliente_cli") {





          //busca todos os dados dos tecnicos
          $this->load->model('Tecnico');
          $dados = $this->Tecnico->buscarTodos("tecnico");



          // aqui faz um for para trocar o id da area de atuacao pelo nome dela

          // inicia o contador para ver em qual array trocar cada id

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




          // pro curando dados do usuari logado 

          $dados1["email"] = $email;

          $this->load->model('Usuario');
          $var = (array) $this->Usuario->buscar_email($dados1, "cliente_cli");
          // map cpmsegui fazer de outra forma por isso esta igual ao  home do cliente
          $this->load->view('/template/layout-base.html');



          $this->load->view('dashboard.php'); //menu
          $data = array("tecnicos" => $dados);
          $this->load->view('buscar_tec.php', $data);

          $this->load->view('/template/roda-pe-base.html');
        }
      } else {
        header("Location: ../welcome?message=errorlogin");
        exit;
      }
    } else {

      $this->load->view('/template/layout-base.html');
      $this->load->view('welcome.php');
      $this->load->view('/template/roda-pe-base.html');
    }
  }

  public function logof()
  {
    session_start();

    // aqui para retoranr para tela de login do tecnico ou Usuario Comum
    if ($_SESSION['tipo_user'] == 1) {
      $voltar = "welcome.php";
      $entidade = "cliente_cli";
    }
    if ($_SESSION['tipo_user'] == 2) {
      $voltar = "welcome_tec.php";
      $entidade = "tecnico";
    }
    if ($_SESSION['tipo_user'] == 0) {
      $voltar = "welcome.php";
      $entidade = "adminsitracao";
    }


    // definindo insert de log
    $this->load->model('Movimentacao');
    $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "Logoff");

    $timezone = new DateTimeZone('America/Sao_Paulo');
    $data = new DateTime('now', $timezone);
    $data = $data->format('Y/m/d H:i');

    $log = array(
      "NomeEntidade" => $entidade,
      "TipoMov" => $id_mov[0]['id'],
      "data_mod" => $data,
      "responsavel" => $_SESSION['email'],
    );

    $this->load->model('Log');
    $this->Log->setLog($log);
    $this->Log->inserirLog('logs');

    // fim insert de log


    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    unset($_SESSION['tipo_user']);



    $this->load->view('/template/layout-base.html');
    $this->load->view($voltar);
    $this->load->view('/template/roda-pe-base.html');
  }


  public function logartec()
  {






    // faz a mesma coisa do logar só que so verifica na tabeal de tecnicos
    if (isset($_POST['email']) && isset($_POST['senha'])) {
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      $data = array(
        "email" => $email,
        "senha" => $senha
      );



      $this->load->model('Usuario');
      $retorno = $this->Usuario->autenticar($data, 'tecnico');

      if ($retorno) {

        // definindo insert de log
        $this->load->model('Movimentacao');
        $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "Login");

        $timezone = new DateTimeZone('America/Sao_Paulo');
        $data = new DateTime('now', $timezone);
        $data = $data->format('Y/m/d H:i');

        $log = array(
          "NomeEntidade" => "tecnico",
          "TipoMov" => $id_mov[0]['id'],
          "data_mod" => $data,
          "responsavel" => $email,
        );

        $this->load->model('Log');
        $this->Log->setLog($log);
        $this->Log->inserirLog('logs');

        // fim insert de log




        $dados1["email"] = $email;

        $this->load->model('Usuario');
        $var = (array) $this->Usuario->buscar_email($dados1, "tecnico");

        // map cpmsegui fazer de outra forma por isso esta igual ao  home do cliente
        $this->load->view('/template/layout-base.html');

        $this->load->view('dashboard.php'); //menu

        $this->load->view('/template/roda-pe-base.html');
      } else {
        header("Location: ../welcome/tec?message=errorlogin");
        exit;
      }
    } else {

      $this->load->view('/template/layout-base.html');
      $this->load->view('welcome_tec.html');
      $this->load->view('/template/roda-pe-base.html');
    }
  }






  // esse metodo deixei de lado pois nao achei uma solução de como chamar um controller dentro de outro
  //controller , acabei veficando a sessao em cada metodo

  public function verificalog()
  {
    session_start();

    if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
      unset($_SESSION['login']);
      unset($_SESSION['senha']);
      header('location:index.php');
    }
  }
}
