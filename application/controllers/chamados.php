<?php
defined('BASEPATH') or exit('No direct script access allowed');

class chamados extends CI_Controller
{



  //controller padrao que manda para submenu
  public function index()

  {

    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }

    $this->load->view('/template/layout-base.html');
    $this->load->view('dashboard.php');
    if ($_SESSION['tipo_user'] == 1) {
      $this->load->view('/chamados/chamado_view.html');
    } else if ($_SESSION['tipo_user'] == 2) {
      $this->load->view('/chamados/chamado_view_tec.html');
    }


    $this->load->view('/template/roda-pe-base.html');
  }


  // esse realemnte renderiza o formulario de solicitacao
  public function nova_solicitacao()

  {

    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }

    $this->load->model('AreaAtuacao');
    // selecionando para jogar no front as areas



    if (isset($_GET['id'])) {
      $data = array(
        "tecnico" => $_GET['id'],
        "array" => $areas = $this->AreaAtuacao->TodasAreas("areaatuacao"),
      );
    } else {
      $data = null;
    }





    $this->load->view('/template/layout-base.html');
    $this->load->view('dashboard.php');
    $this->load->view('/chamados/abrir_solicitacao.php', $data);
    $this->load->view('/template/roda-pe-base.html');
  }

  //avaliar
  public function avaliarAtend()

  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }

    $id_chamado = $id_chamado = $_POST['id_chamado'];

    $data = array(
      "avaliacao" => $_POST['ratinginput'],
    );

    $this->load->model('Chamado');
    $retorno = $this->Chamado->Avaliar($data, $id_chamado);

    if ($retorno) {

      // definindo insert de log
      $this->load->model('Movimentacao');
      $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "Stsavaliado");

      $timezone = new DateTimeZone('America/Sao_Paulo');
      $data = new DateTime('now', $timezone);
      $data = $data->format('Y/m/d H:i');


      $tec = array(
        "cpf_tec" => $_POST['cpf_tec'],
      );


      $this->load->model('Tecnico');
      $Tecnico = (array) $this->Tecnico->buscar_cpf($tec, "tecnico");



      $log = array(
        "id_tb" => $id_chamado,
        "NomeEntidade" => "chamado",
        "TipoMov" => $id_mov[0]['id'],
        "data_mod" => $data,
        "responsavel" => $_SESSION['email'],
        "quantidade" => $_POST['ratinginput'],
        "para" => $Tecnico['email'],
      );

      $this->load->model('Log');
      $this->Log->setLog($log);
      $this->Log->inserirLog('logs');

      // fim insert de log



      // contando quantas avaliações foram feitas
      // para o tecnico selecionado
      // com o id 11 que é avaliação 


      $this->load->model('Log');
      $retorno = $this->Log->PesqStatus($Tecnico['email'], 11);
      $dadoscompilados = $this->Log->CompilaDados($retorno);


      // comando avaliações totais para fazer a media de avaliacao

      $media = 0;
      foreach ($retorno as $value) {

        if ($value['quantidade'] != null) {
          $media =  $media + $value['quantidade'];
        }
      }


      //fazendo a media
      if ($media != 0) {
        $media_total = $media / $dadoscompilados;



        // formatando para inteiro 

        $media_int = floor($media_total);
      } else {
        $media_int = 0;
      }




      $data = array(
        "avaliacao" => $media_int,
      );


      $this->load->model('Tecnico');
      $retorno = $this->Tecnico->UpdateAvaliacao($data, $Tecnico['email']);





      header("Location: solicitacao_muda_status?id=" . $id_chamado . "&status=2");
    } else {
      echo "erro ao avaliar";
    }
  }


  public function ver_solicitacao()

  {

    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }

    /* refazer codigo que mostra os chamados disponiveis na tela do tecnico
  */
    if (isset($_GET['status'])) {
      $status = $_GET['status'];

      if ($_SESSION['tipo_user'] == 1) {
        $metodo = "ByStatusCli";
        $data['email'] = $_SESSION['email'];
        $user = $this->load->model('Usuario');
        $user = $this->Usuario->buscar_email($data, "cliente_cli");
        $cpf = $user->cpf_cli;
      } elseif ($_SESSION['tipo_user'] == 2) {
        $data['email'] = $_SESSION['email'];
        $user = $this->load->model('Usuario');
        $user = $this->Usuario->buscar_email($data, "tecnico");
        $cpf = $user->cpf_tec;
        $metodo = "ByStatusTec";
      }

      switch ($status) {

        case "aberto":

          $status = 0;
          $chamado_aberto = $this->load->model('Chamado');
          $chamado_aberto  = $this->Chamado->$metodo($status, $cpf);

          $status = 1;
          $chamado_andamento = $this->load->model('Chamado');
          $chamado_andamento = $this->Chamado->$metodo($status, $cpf);


          $status = 2;
          $avaliacao = $this->load->model('Chamado');
          $avaliacao = $this->Chamado->$metodo($status, $cpf);


          $status = 3;
          $empagamento = $this->load->model('Chamado');
          $empagamento = $this->Chamado->$metodo($status, $cpf);



          break;

        case "EmAndamento":
          $status = 1;
          $chamado_andamento = $this->load->model('Chamado');
          $chamado_andamento = $this->Chamado->$metodo($status, $cpf);

          $status = 0;
          $chamado_aberto = $this->load->model('Chamado');
          $chamado_aberto  = $this->$metodo->ChamadobyStatus($status, $cpf);
          break;


        case "finalizado":
          $status = 4;
          $chamado_finalizado = $this->load->model('Chamado');
          $chamado_finalizado = $this->Chamado->$metodo($status, $cpf);

          $status = 5;
          $cancelado = $this->load->model('Chamado');
          $cancelado = $this->Chamado->$metodo($status, $cpf);

          break;

        case "Emavaliacao":
          $status = 2;
          $avaliacao = $this->load->model('Chamado');
          $avaliacao = $this->Chamado->$metodo($status, $cpf);

          break;

        case "AguardPagamento":
          $status = 3;
          $empagamento = $this->load->model('Chamado');
          $empagamento = $this->Chamado->$metodo($status, $cpf);

          break;

        case "cancelado":
          $status = 5;
          $cancelado = $this->load->model('Chamado');
          $cancelado = $this->Chamado->$metodo($status, $cpf);

          break;

        default:
          $status = false;
          break;
      }
    }





    //var_dump($chamado_aberto);



    //se tiver registro entao renderiza a pagina
    if (@$chamado_aberto  ||  @$chamado_andamento || @$chamado_finalizado || @$avaliacao || @$empagamento || @$cancelado) {

      /*fim*/


      $data = array(
        "chamado_aberto" => @$chamado_aberto,
        "chamado_andamento" => @$chamado_andamento,
        "chamado_finalizado" => @$chamado_finalizado,
        "Emavaliacao" => @$avaliacao,
        "AguardPagamento" => @$empagamento,
        "cancelado" => @$cancelado,


      );

      $this->load->view('/template/layout-base.html');
      $this->load->view('dashboard.php');
      $this->load->view('/chamados/ver_solicitacao.php', $data);
      $this->load->view('/template/roda-pe-base.html');
    } else {
      $data = array(
        "chamado_aberto" => @$chamado_aberto,
        "chamado_andamento" => @$chamado_andamento,
        "chamado_finalizado" => @$chamado_finalizado,
        "Emavaliacao" => @$avaliacao,
        "AguardPagamento" => @$empagamento,
        "cancelado" => @$cancelado,

      );

      $this->load->view('/template/layout-base.html');
      $this->load->view('dashboard.php');
      $this->load->view('/chamados/ver_solicitacao.php', $data);


      var_dump($data);
      if ($data["chamado_aberto"] != null && $data["chamado_andamento"] != null && $data["chamado_finalizado"] != null && $data["Emavaliacao"] != null && $data["AguardPagamento"] && $data["cancelado"] != null) {
        $this->load->view('/template/roda-pe-base.html');
      }
    }
  }




  public function solicitacao_comp()
  {

    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }



    $id = $this->input->get('id');
    $data = array("id_chamado" => $id);

    $this->load->model('Chamado');
    $retorno = $this->Chamado->ChamadoId($data);


    // acessando os historicos do chamado

    $this->load->model('ObsChamado');
    $retorno2 = $this->ObsChamado->TodosObsChamados($id);




    $data = array(
      "chamado_id" => $retorno,
      "histotico" => $retorno2,
    );

    $this->load->view('/template/layout-base.html');
    $this->load->view('dashboard.php');
    $this->load->view('/chamados/chamado_id.php', $data);
    $this->load->view('/template/roda-pe-base.html');
  }




  public function updateChamado()
  {

    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }





    $data = array(
      'id_chamado' => $this->input->post('id_chamado'),
      'assunto' => $this->input->post('assunto'),
      'descricao' => $this->input->post('descricao'),
      'categoria' => $this->input->post('categoria'),
      'arquivo' => $this->input->post('anexo'),
      'categoria' => $this->input->post('categoria'),
      'status' => $this->input->post('status2'),
      'avaliacao' => $this->input->post('avaliacao'),
    );

    $this->load->model('Chamado');
    $retorno = $this->Chamado->updateChamadoId($data, "chamado");


    if ($retorno) {

      // definindo insert de log
      $this->load->model('Movimentacao');
      $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "alteração");

      $timezone = new DateTimeZone('America/Sao_Paulo');
      $data = new DateTime('now', $timezone);
      $data = $data->format('Y/m/d H:i');

      $log = array(
        "id_tb" => $this->input->post('id_chamado'),
        "NomeEntidade" => "chamado",
        "TipoMov" => $id_mov[0]['id'],
        "data_mod" => $data,
        "responsavel" => $_SESSION['email'],
      );

      $this->load->model('Log');
      $this->Log->setLog($log);
      $this->Log->inserirLog('logs');

      // fim insert de log
      header("Location: solicitacao_comp?message=editado&id=" . $this->input->post('id_chamado'));
      exit;
    } else {
      header("Location: solicitacao_comp?message=err_edit&id=" . $this->input->post('id_chamado'));
      exit;
    }
  }



  public function DeleteChamado()
  {

    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }


    $id = $this->input->get('id_chamado');
    $this->load->model('Chamado');
    $retorno = $this->Chamado->delete($id);

    if ($retorno) {


      // definindo insert de log
      $this->load->model('Movimentacao');
      $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "exclusão");

      $timezone = new DateTimeZone('America/Sao_Paulo');
      $data = new DateTime('now', $timezone);
      $data = $data->format('Y/m/d H:i');

      $log = array(
        "NomeEntidade" => "chamado",
        "TipoMov" => $id_mov[0]['id'],
        "data_mod" => $data,
        "responsavel" => $_SESSION['email'],
      );

      $this->load->model('Log');
      $this->Log->setLog($log);
      $this->Log->inserirLog('logs');

      // fim insert de log


      header("Location: solicitacao_comp?id=" . @$id . "&message=excluido");
      exit;
    } else {
      header("Location: solicitacao_comp?id=" . @$id . "&message=err_excluir");
      exit;
    }
  }




  public function solicitacao_muda_status()
  {

    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }


    //aqui se tiver status no get  ele muda para o valor a ser inserido na tabela para fazer a mudança de 
    //status na tabela chamado

    if (isset($_GET['status'])) {
      @$id = $_GET['id'];
      @$para = null;
      @$total = null;
      @$mensagempag = null;

      if ($_GET['status'] == 0) {
        $novo_status = 1;
        $acao_tb = "Stscapturado";
        $total = 0;
      } else if ($_GET['status'] == 1) {

        // aqui muda o status e inclui o valor total no chamado
        //

        $valortotal =  $_GET['total'];
        $valorconvert =  str_replace(['.', ','], ['', '.'], $valortotal);


        $data = array(
          "total" => $valorconvert,
        );

        $this->load->model('Chamado');
        $retorno = $this->Chamado->AdicionaPreco($data, $id);

        if ($retorno) {
          echo "adcicionou o valor";
        } else {
          echo "erro ao  adicionar o valor";
          exit;
        }


        $novo_status = 2;
        $acao_tb = "StsFimTec";
        $total = 0;
      } else if ($_GET['status'] == 2) {
        $novo_status = 3;
        $acao_tb = "Stsavaliado";
        $total = 0;



        $id = $this->input->get('id');
        $data = array("id_chamado" => $id);


        // consultando o chamado para poder pegar o cpf 
        // cpf para depositar o valor desejado

        $this->load->model('Chamado');
        $retorno = $this->Chamado->ChamadoId($data);



        // e traz a conta do tecnico onde sera depositada

        $data2 = array("cpf_tec" => $retorno[0]['cpf_tecnico']);


        //pegando o usuario
        $this->load->model('Tecnico');
        $ContaSessaoTec = (array) $this->Tecnico->buscar_cpf($data2, "tecnico");


        // pesquisando as logs de avaliacao gravadas  com esse mesmo tecnico selecionado pelo
        // cliente


        $this->load->model('Log');
        $retorno = $this->Log->PesqAvaliacao($ContaSessaoTec['email'], 11);
        $contar = $this->Log->CompilaDados($retorno);


        $media = 0;
        $total = 0;
        foreach ($retorno  as $value) {
          $total = $value['quantidade'] + $total;
        }


        // calculando a media para atualizar a media do tecnico
        $media = floor($total / $contar);

        
        //verifica se a media e maior que 5 ou menor que 0
        if ($media > 5) {
          $media = 5;
        } elseif ($media < 0) {
          $media = 1;
        }

        $data3 = array("avaliacao" => $media);

        $pesquisa = $this->Tecnico->UpdateAvaliacao($data3, $ContaSessaoTec['email']);


        $para = $ContaSessaoTec['email'];
      } else if ($_GET['status'] == 3) {

        $this->load->model('Contac');
        $ContaSessaoCli = $this->Contac->verificaTitular($_SESSION['email']);



        $id = $this->input->get('id');
        $data = array("id_chamado" => $id);


        // consultando o chamado para poder pegar o cpf 
        // cpf para depositar o valor desejado

        $this->load->model('Chamado');
        $retorno = $this->Chamado->ChamadoId($data);



        // e traz a conta do tecnico onde sera depositada

        $this->load->model('Contac');
        $ContaSessaoTec = $this->Contac->verificaCpf($retorno[0]['cpf_tecnico']);

        $para = $ContaSessaoTec[0]['titular'];

        //fazendo as ações de subtração e adição para efetuar a transação

        $total = $_GET['valor'];


        // conta depositante
        // verifica se o tecnico tem conta
        if ($ContaSessaoTec && $ContaSessaoCli) {
          if ($total > $ContaSessaoCli[0]['saldo']) {
            echo "valor maior do que o disponível em conta";
            $subtotalC = 0;
            $subtotalTec = 0;
          } else {
            $subtotalC = $ContaSessaoCli[0]['saldo'] - $total;
            $subtotalTec = $ContaSessaoTec[0]['saldo'] + $total;
          }
        } else {
          header("Location: solicitacao_comp?id=" . @$id . "&message=erroconta");
          exit;
        }


        if ($subtotalC != 0 && $subtotalTec != 0) {

          //subtrai
          $data = array(
            "saldo" => $subtotalC,
          );

          //add
          $data2 = array(
            "saldo" => $subtotalTec,
          );

          $this->load->model('Contac');
          $subtraicli = $this->Contac->updateSaldo($ContaSessaoCli[0]['titular'], $data);

          $addtec = $this->Contac->updateSaldo($ContaSessaoTec[0]['titular'], $data2);


          // seleciona o tecnico



          // fazer verificacao de recebimento e  entrega do valor foram com sucesso depois



          $novo_status = 4;
          $acao_tb = "Stspago";
          $mensagempag = 'pago';
        } else {
          $mensagempag = 'erropagamento';
          $novo_status = 3;
          $acao_tb = "Stspago";
        }
      } else if ($_GET['status'] == 4) {
        $novo_status = 4;
        $acao_tb = "Stsfinalizado";
      } else if ($_GET['status'] == 5) {
        $novo_status = 5;
        $acao_tb = "Stscancelado";
      }
    } else {
      exit;
    }



    $data = array(
      "status" => $novo_status,
      "id_chamado" => $id,
    );

    $this->load->model('Chamado');
    $retorno = $this->Chamado->updateChamadoId($data, "chamado");

    //retorna ao metodo inicial
    if ($retorno) {


      // definindo insert de log
      $this->load->model('Movimentacao');
      $id_mov = $this->Movimentacao->BuscabyName("movimentacao", $acao_tb);

      $timezone = new DateTimeZone('America/Sao_Paulo');
      $data = new DateTime('now', $timezone);
      $data = $data->format('Y/m/d H:i');

      $log = array(
        "id_tb" => $id,
        "NomeEntidade" => "chamado",
        "TipoMov" => $id_mov[0]['id'],
        "data_mod" => $data,
        "responsavel" => $_SESSION['email'],
        "para" => $para,
        "quantidade" => @$total,
      );

      $this->load->model('Log');
      $this->Log->setLog($log);
      $result = $this->Log->inserirLog('logs');

      // fim insert de log



      if ($novo_status == 4 || $mensagempag != null) {
        if ($mensagempag   == "pago") {
          header("Location: solicitacao_comp?id=" . @$id . "&message=pago");
          exit;
        } elseif ($mensagempag   == "erropagamento") {

          header("Location: solicitacao_comp?id=" . @$id . "&message=valoracima");
          exit;
        }
      } else {
        header("Location: solicitacao_comp?id=" . @$id . "&message=sts_ok");
      }


      if ($novo_status == 4) {
        header("Location: solicitacao_comp?id=" . @$id . "&message=err_finalizar");
      }
    } else {
      header("Location: solicitacao_comp?id=" . @$id . "&message=sts_err");
      exit;
    }
  }





  public function cadastra_chamado()

  {
    if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
      session_start();
    }

    $busca = array(
      "email" => $_SESSION['email'],
    );



    //verificando  se os dados sao validos
    if ($this->input->post('info') == "" || $this->input->post('assunto') == "") {
      echo "<script>alert('Preencha os campos Obrigatórios!');history.back()</script>";
      exit;
    }

    //busca cpf de quem esta logado

    $cli = $this->load->model('Cliente');
    $cli = $this->Cliente->buscar_email($busca, 'cliente_cli');


    //setando data para horario de sao paulo
    date_default_timezone_set('America/Sao_Paulo');
    $data_inicial = date('Y/m/d H:i:s');




    //importando metodo de upload de arquivos

    if ($_FILES['arquivo']['name'] != "") {

      // verifica se teve upload ou nao
      $this->load->model('upload');
      $nome_arquivo = $this->upload->upload_arquivos($_FILES['arquivo']);
    } else {
      $nome_arquivo = null;
    }



    //chamadno metodo que ira buscar o cpf do tecnico para inserir
    $this->load->model('Tecnico');
    $tec = $this->Tecnico->buscarId("tecnico", $this->input->post('id_tec'));


    $data = array(
      "status" => 0,
      "descricao" => $this->input->post('info'),
      "cpf_cliente" =>  $cli->cpf_cli, // pega de quem estiver logado
      "cpf_tecnico" => $tec->cpf_tec, // aqui vai para o tecnico selecionado pelo cliente
      "categoria" => $this->input->post('categoria'),
      "assunto" => $this->input->post('assunto'),
      "arquivo" =>  $nome_arquivo,
      "data_abertura" => $data_inicial

    );






    $this->load->model('Chamado');
    $retorno = $this->Chamado->setChamado($data);
    $retorno = $this->Chamado->inserirChamado("chamado");







    if ($retorno) {


      // definindo insert de log
      $this->load->model('Movimentacao');
      $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "cadastro");

      $timezone = new DateTimeZone('America/Sao_Paulo');
      $data = new DateTime('now', $timezone);
      $data = $data->format('Y/m/d H:i');

      $log = array(
        "NomeEntidade" => "chamado",
        "TipoMov" => $id_mov[0]['id'],
        "data_mod" => $data,
        "responsavel" => $_SESSION['email'],
        "para" => $tec->email,
      );

      $this->load->model('Log');
      $this->Log->setLog($log);
      $this->Log->inserirLog('logs');

      // fim insert de log



      header("Location: nova_solicitacao?message=enviada");
      exit;
    } else {
      header("Location: nova_solicitacao?message=erro_envio");
      exit;
    }
  }
}
