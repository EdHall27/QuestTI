<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoricoPag extends CI_Controller
{

    public function index()
    {
        if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
            session_start();
        }


        if (@$_SESSION['login'] != null) {  //Verificar se a sessão não já está aberta.


            $this->load->model('Log');


            // pesuisa todos pagamentos do usuario cliente

            if ($_SESSION['tipo_user'] == 1) {
                // conta 
                $array = $this->Log->PesquisaLog("Stspago", 0, "chamado");


                // pesquisa o email de quem esta logado para comparar se exite conta 
                // vinculado a este email e cpf

                $dados = array(
                    "email"    =>  $_SESSION['email'],
                );



                $this->load->model('Usuario');
                $usuario = (array) $this->Usuario->buscar_email($dados, "cliente_cli");

                //prepara os dados retornados para fazer pesquisa no formato como 
                // está no contac

                $dados2 = array(
                    "cpf"    =>  $usuario['cpf_cli'],
                    "titular"    =>  $usuario['email'],
                    "tipo_conta"    =>  $usuario['tipo_user'],
                );
                //




                // verifica se os dados batem com a conta que existe em Contac
                $this->load->model('Contac');
                $usuario2 =  $this->Contac->verificaExists($dados2);
            } elseif ($_SESSION['tipo_user'] == 2) {

                // pesuisa todos pagamentos do usuario tecnico
                $array = $this->Log->PesquisaLog("Stspago", 1, "chamado");



                // pesquisa o email de quem esta logado para comparar se exite conta 
                // vinculado a este email e cpf

                $dados = array(
                    "email"    =>  $_SESSION['email'],
                );



                $this->load->model('Usuario');
                $usuario = (array) $this->Usuario->buscar_email($dados, "tecnico");


                //prepara os dados retornados para fazer pesquisa no formato como 
                // está no contac
                $dados2 = array(
                    "cpf"    =>  $usuario['cpf_tec'],
                    "titular"    =>  $usuario['email'],
                    "tipo_conta"    =>  $usuario['tipo_user'],
                );

                // verifica se os dados batem com a conta que existe em Contac
                $this->load->model('Contac');
                $usuario2 =  $this->Contac->verificaExists($dados2);
            }




            // junta os dados de historico , com os dados da conta de quem 
            //esta logado caso tenha sido criado a conta junto no cadastro
            $data = array(
                "resultado"    =>  $array,
                "conta"    =>  $usuario2,
            );






            $this->load->view('dashboard.php');
            $this->load->view('/template/layout-base.html');
            $this->load->view('/HistoricoPag/index.php', $data);
            $this->load->view('/template/roda-pe-base.html');
        } else {
            $this->load->view('/template/layout-base.html');
            $this->load->view('welcome.html');
            $this->load->view('/template/roda-pe-base.html');
        }
    }
}
