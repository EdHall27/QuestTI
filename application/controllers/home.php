<?php
defined('BASEPATH') or exit('No direct script access allowed');

class home extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
			session_start();
		}
		$this->load->view('/template/layout-base.html');
		$this->load->view('/dashboard.php'); //menu


		//busca todos os dados dos tecnicos
		$this->load->model('Tecnico');
		$dados = $this->Tecnico->buscarTodos("tecnico");


		//busca tecnicos os dados dos tecnicos favoritos
		$this->load->model('Log');
		$dadosfav = $this->Log->PesqStatusfav($_SESSION['email'], 11);
		



		// pronto como filtrar os tecnicos favoritos 

		// agrupando por reponsavel da acao
		$op = "para";
		@$novoarray = array_count_values(array_column($dadosfav, $op));
	

		$this->load->model('Usuario');
		$tabletec = 'tecnico';

		//seta a posicao do array onde foi achado o registro
		$num = 0;


		// compara com o array que contem todos os tecnicos para pegar somente os favoritos do usuario
		// somente valores de avaliação acima de 4 são colocados no array
		foreach ($novoarray as $key => $value) {
			foreach ($dados  as  $key2 => $value2) {
				if ($key == $key2 && $value >=4) {
					$novoarray[] = $dados[$num];
				}
			}
			$num = $num + 1;
		}






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

		
		$data = array(
			"tecnicos" => $dados,
			"favoritos" => $novoarray,
		);


		$this->load->view('buscar_tec.php', $data);
		$this->load->view('/template/roda-pe-base.html');
		
	}

	public function hometec()
	{
		if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
			session_start();
		}


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
		// outro menu
		//$this->load->view('/template/index.php');

		$this->load->view('dashboard.php');
		$this->load->view('/grafico/grafico_admin.php', $dados);
		$this->load->view('/template/roda-pe-base.html');
	}
}
