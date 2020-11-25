<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ContaPag extends CI_Controller
{
    public function index()
    {

        if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
            session_start();
        }


        if (@$_SESSION['login'] != null) {
            $this->load->model('Contac');

            // pesquisa o email de quem esta logado para comparar se exite conta 
            // vinculado a este email e cpf

            $dados = array(
                "email"    =>  $_SESSION['email'],
            );


            if ($_SESSION['tipo_user'] == 1) {

                $tabela = "cliente_cli";
                $ident = "cpf_cli";
            } elseif ($_SESSION['tipo_user'] == 2) {
                $tabela = "tecnico";
                $ident = "cpf_tec";
            }


            $this->load->model('Usuario');
            $usuario = (array) $this->Usuario->buscar_email($dados, $tabela);

            //prepara os dados retornados para fazer pesquisa no formato como 
            // está no contac

            $dados2 = array(
                "cpf"    =>  $usuario[$ident],
                "titular"    =>  $usuario['email'],
                "tipo_conta"    =>  $_SESSION['tipo_user'],
            );
            //




            // verifica se os dados batem com a conta que existe em Contac
            $this->load->model('Contac');
            $usuario2 =  $this->Contac->verificaExists($dados2);

            // se retornar ja tem conta criada , se nao n existe cotna criada


            if ($usuario2 == null) {

                $data = array(
                    "id"    =>  null,
                    "cpf"    => $dados2['cpf'],
                    "titular"    =>  $dados2['titular'],
                    "tipo_conta" => $dados2['tipo_conta'],
                    "saldo" => 100, // para teste ja que o adionar dinheiro n funfa ainda
                    "credito" => 0,
                );


                $result = $this->Contac->setconta($data);
                $result = $this->Contac->inserirconta($data);

                if ($result) {
                    header("Location: HistoricoPag?message=SuccessConta");
                } else {
                    header("Location: HistoricoPag?message=erroCad");
                }
            } else {
                header("Location: HistoricoPag?message=jaexists");
            }
        }
    }
}
