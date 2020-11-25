<?php
class teste extends CI_Controller
{

    public function index()
    {

        if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
            session_start();
        }

        $this->load->model('Log');
        $dados = $this->Log->PesqStatusfav($_SESSION['email'], 11);


        // pronto como filtrar os tecnicos favoritos 

        // agrupando por reponsavel da acao
        $op = "para";
        @$novoarray = array_count_values(array_column($dados, $op));

        var_dump($novoarray);
    }



    public function index2()
    {

        var_dump($_POST);
    }
}
