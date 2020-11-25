<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistObs extends CI_Controller
{



    public function AdicionarObs()
    {
        if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
            session_start();
        }


        if (isset($_POST['id']) && isset($_POST['obs'])) {
            $id = $_POST['id'];
            $obs = $_POST['obs'];
            $post = true;
        } else {
            $post = false;
        }



        if ($post == true) {


            //data de agora

            date_default_timezone_set('America/Sao_Paulo');

            $agora = date('Y-m-d H:i:s');

            $data = array(
                "obs" => $obs,
                "responsavel" => $_SESSION['email'],
                "id_chamado" => $id,
                "data" => $agora,
            );

            //chamando model para editar
            $retorno = $this->load->model("ObsChamado");

            $retorno = $this->ObsChamado->inserirObsChamado($data);


            if ($retorno) {
                header("Location: /chamados/solicitacao_comp?id=" . $_POST['id'] . "&mostradiv=true" . "&message=OBSCadastrada");
            }else{
                header("Location: /chamados/solicitacao_comp?id=" . $_POST['id'] . "&mostradiv=true" . "&message=ErrObsCadastro");
            }
        } else {
            header("Location: /chamados/solicitacao_comp?id=" . $_POST['id'] . "&mostradiv=true" . "&message=ErrobEnvio");
        }
    }


    public function EditarObs()
    {
        if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
            session_start();
        }

        if (isset($_POST['id_obs']) && isset($_POST['data']) && isset($_POST['obs']) && isset($_POST['responsavel']) && isset($_POST['idChamado'])) {
            $id = (int) $_POST['id_obs'];
            $idchaamado = (int) $_POST['idChamado'];
            $data1 = $_POST['data'];
            $obs = $_POST['obs'];
            $responsavel = $_POST['responsavel'];
            $post = true;
        } else {
            $post = false;
        }


        if ($post == true) {

            //data de agora

            date_default_timezone_set('America/Sao_Paulo');

            $agora = date('Y-m-d H:i:s');


            $data = array(
                "obs" => $obs,
                "responsavel" => $responsavel,
                "id_chamado" => $idchaamado,
                "data" => $agora,
            );


            //chamando model para editar
            $retorno = $this->load->model("ObsChamado");

            $retorno = $this->ObsChamado->updateObsId($id, $data);

            if ($retorno) {

                header("Location: /chamados/solicitacao_comp?id=" . $_POST['idChamado'] . "&acao=editobs&mostradiv=true &idobs=" . $_POST['id_obs'] . "&message=OBSedit");
            }else{
                header("Location: /chamados/solicitacao_comp?id=" . $_POST['idChamado'] . "&acao=editobs&mostradiv=true &idobs=" . $_POST['id_obs'] . "&message=OBSerredit");
            }
        } else {

            header("Location: /chamados/solicitacao_comp?id=" . $_POST['idChamado'] . "&acao=editobs&mostradiv=true &idobs=" . $_POST['id_obs'] . "&message=ErroEnvio");
        }
    }
}
