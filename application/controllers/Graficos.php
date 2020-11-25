<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Graficos extends CI_Controller
{
    public function index()
    {

        $this->load->model('Log');

        // numero de cadastros total
        $cadastros = $this->Log->PesquisaLog("cadastro", 0, "chamado");
        $cadastrosc = $this->Log->CompilaDados($cadastros);

        //finalizados total
        $finalizados = $this->Log->PesquisaLog("Stsfinalizado", 0, "chamado");
        $finalizadosc = $this->Log->CompilaDados($finalizados);

        //cancelados total
        $cancelados = $this->Log->PesquisaLog("Stscancelado", 0, "chamado");
        $canceladosc = $this->Log->CompilaDados($cancelados);


        //excluidos total
        $excluidos = $this->Log->PesquisaLog("exlusão", 0, "chamado");
        $excluidosc = $this->Log->CompilaDados($excluidos);

        //avaliados total
        $avaliados = $this->Log->PesquisaLog("Stsavaliado", 0, "chamado");
        $avaliadosc = $this->Log->CompilaDados($avaliados);



        $data = array(
            "cadastro"    => $cadastrosc,
            "finalizados" => $finalizadosc,
            "cancelados"  => $canceladosc,
            "excluidos"   => $excluidosc,
            "avaliados"   => $avaliadosc,
        );


        $this->load->view('/template/layout-base.html');
        $this->load->view('dashboard.php');
        $this->load->view('/grafico/graficoChamado.php', $data);
        $this->load->view('/template/roda-pe-base.html');
    }


    public function TopTec()
    {
        $this->load->model('Log');

        // conta 
        $array = $this->Log->PesquisaLog("cadastro", 2, "chamado");

        // contando por tecnico

        $op = "responsavel";

        $result = array_count_values(array_column($array, $op));
        
        $data = array(
            "resultado"    =>  $result,
        );

        $this->load->view('/template/layout-base.html');
        $this->load->view('dashboard.php');
        $this->load->view('/grafico/graficoTopTec.php', $data);
        $this->load->view('/template/roda-pe-base.html');
     
    }
}
