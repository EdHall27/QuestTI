<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cadastro extends CI_Controller
{

    public function index()
    {
        $this->load->view('/template/layout-base.html');
        $this->load->model('AreaAtuacao');
        $data["array"] = $this->AreaAtuacao->TodasAreas("areaatuacao");
        $this->load->view('cadastrar.php', $data);
    }

    public function cadastrar()
    {

       
        if (
            isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['senha2'])
            && isset($_POST['endereco']) && isset($_POST['cep']) && isset($_POST['tel']) && isset($_POST['cel']) && isset($_POST['termo1'])
        ) {
            $tipo_usuario = $_POST['tipo_usuario'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $senha2 = $_POST['senha2'];
            $endereco = $_POST['endereco'];
            $cep = $_POST['cep'];
            $tel = $_POST['tel'];
            $cel = $_POST['cel'];
            $termo=$_POST['termo1'];

            //deixa só os numeros
            $cpf = $this->limpaCPF_CNPJ($_POST['cpf']);
            $cpf2 = $this->limpaCPF_CNPJ($_POST['cpf2']);

            if ($senha != $senha2) {
                "<script>alert('As senhas nao conferem!');history.back()</script>";
                exit;
            }
            if ($cpf != $cpf2) {
                "<script>alert('Cpf Não confere!');history.back()</script>";
                exit;
            }
        } else {
            header("location: index?error=nulo");
        }



        if ($tipo_usuario == "Técnico") {

            // aqui caso deixe em branco a area por padrao vai como outros
            if (isset($_POST['area_atuacao'])) {
                $area_atuacao = $_POST['area_atuacao'];
            } else {
                $area_atuacao = "outros";
            }




            //variaveis de upload
            $tipo_arquivos = ["txt", "csv"];
            $caminho = "C:/xampp/htdocs/Projeto/application/uploads/";
            $url = explode('controllers', dirname(__FILE__));
            $base_path = $url[0] . "uploads/";

            //pega caminho
            //dirname(__FILE__).
            $tipo_usuario = 2;
            $certificado =  $_FILES['certificado'];
            $senha_encri = $this->encript($senha);

            $area = $this->load->model('AreaAtuacao');
            $area = $this->AreaAtuacao->BuscaAreaName("areaatuacao", $area_atuacao);

           // var_dump($area[0]['id']);




            $data = array(
                "area_atuacao" => $area[0]['id'],
                "certificado" => $this->upload($certificado, $base_path, $tipo_arquivos), // mudar para receber o caminho do upload
                "nome" => $nome,
                "email" => $email,
                "cpf_tec" => $cpf,
                "senha" => $senha_encri,
                "endereco" => $endereco,
                "cep" => $cep,
                "telefone" => $tel,
                "celular" => $cel,
                "status" => 0,
                "tipo_user" => $tipo_usuario,
                "termo" => 1

            );

            //chamando dois métodos uma para verificar se email já existe e outro para verificar  o cpf
            $this->load->model('Tecnico');
            $verifica_email = $this->Tecnico->buscar_email($data, "tecnico");
            $verifica_cpf = $this->Tecnico->buscar_cpf($data, "tecnico");



            if ($verifica_email == false && $verifica_cpf == false) {

                // setando o usuariop pra iniciar dasativado e depois ser liberado pelo 
                // administrador

                $cadastrar = $this->Tecnico->setUser($data);
                $cadastrar = $this->Tecnico->id_tec = null;
                $cadastrar = $this->Tecnico->status = 0;

                $cadastrar = $this->Tecnico->inserir("tecnico");
                if ($cadastrar) {
                    $pagina_retorn = "Welcome.html";
                    $metodo_insert = "insert";
                    $retorno = true;
                } else {
                    $retorno = false;
                }
            } else {
                header("Location: index?message=erro_email");
                exit;
            }
        } else {
            $tipo_usuario = 1;
            $senha_encri = $this->encript($senha);
            $data = array(
                "nome" => $nome,
                "email" => $email,
                "cpf_cli" => $cpf,
                "senha" => $senha_encri,
                "endereco" => $endereco,
                "cep" => $cep,
                "telefone" => $tel,
                "celular" => $cel,
                "status" => 0,
                "tipo_user" => $tipo_usuario,
                "termo" => 1

            );


            //chamando dois métodos uma para verificar se email já existe e outro para verificar  o cpf
            $this->load->model('Cliente');
            $verifica_email = $this->Cliente->buscar_email($data, "cliente_cli");
            $verifica_cpf = $this->Cliente->buscar_cpf($data, "cliente_cli");



            if ($verifica_email == false && $verifica_cpf == false) {


                $cadastrar = $this->Cliente->setUser($data);
                $cadastrar = $this->Cliente->id = null;
                $cadastrar = $this->Cliente->status = 1;

                $cadastrar = $this->Cliente->inserir("cliente_cli");
                if ($cadastrar) {
                    $pagina_retorn = "Welcome_tec.html";
                    $metodo_insert = "insert_tec";
                    $retorno = true;
                } else {
                    $retorno = false;
                }
            } else {
                header("Location: index?message=erro_email");
                exit;
            }
            
        }



        // definindo insert de log
        $this->load->model('Movimentacao');
        $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "cadastro");

        $timezone = new DateTimeZone('America/Sao_Paulo');
        $data = new DateTime('now', $timezone);
        $data = $data->format('Y/m/d H:i');



        if ($retorno == true) {
            if ($tipo_usuario == 2) {

                $log = array(
                    "NomeEntidade" => "tecnico",
                    "TipoMov" => $id_mov[0]['id'],
                    "data_mod" => $data,
                    "responsavel" => $email,

                );

                $this->load->model('Log');
                $this->Log->setLog($log);
                $this->Log->inserirLog('logs');

                header("Location: index?message=aguardar");
                exit;
            }

            $log = array(
                "NomeEntidade" => "cliente_cli",
                "TipoMov" => $id_mov[0]['id'],
                "data_mod" => $data,
                "responsavel" => $email,
            );

            $this->load->model('Log');
            $this->Log->setLog($log);
            $this->Log->inserirLog('logs');

            header("Location: index?message=cadastrado");
            exit;
        } else {
            echo "<script>alert('Erro ao cadastrar!');history.back()</script>";
            $this->load->view('/template/layout-base.html');
            $this->load->view('/cadastrar.html');
        }
        
    }

    public function editar_cadastro()
    {

        if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
            session_start();
        }

        //verificando qual usuario esta logado para setar a tebela

        if ($_SESSION['tipo_user'] == 0) {
            $table = "administracao";
        } elseif ($_SESSION['tipo_user'] == 1) {
            $table = "cliente_cli";
        } elseif ($_SESSION['tipo_user'] == 2) {
            $table = "tecnico";
        }


        //areas de atuacao 
        $this->load->model('AreaAtuacao');


        //verifica se tem email logado e coloca no array para pesquisar na model
        if (@$_SESSION['email'] != null) {
            $data = array(
                "email" => $_SESSION['email'],
            );
        }


        if (@$_SESSION['email'] != null) {
            $this->load->model('Usuario');

            $dados = $this->Usuario->buscar_email($data, $table);

            //buscando as areas do banco
            $this->load->model('AreaAtuacao');
            $data["array"] = $this->AreaAtuacao->TodasAreas("areaatuacao");

            $this->load->view('/template/layout-base.html');
            $this->load->view('dashboard.php');
            $this->load->view('/perfil/update.php', $dados);
        } else {

            $this->load->view('/template/layout-base.html');
            $this->load->view('welcome.html');
            $this->load->view('/template/roda-pe-base.html');
        }
    }



    public function altera()
    {


        // incia array sem nada
        $data = array();

        $data1 = array(
            "email" => $this->input->post('email'),
        );

        if ($this->input->post('escolha') == true) {
            $senha = $this->encript($this->input->post('senha'));
            $senha2 = $this->encript($this->input->post('senha2'));
        } else {
            $senha = $this->input->post('senha_antiga');
        }

        // aqui deixa todos  os identificadores cpf e cnpj na mesma variavel dependendo do usuario

        if ($this->input->post('tipo_user') == 0) {
            $id_tabela = "id";
            $identificador = "cnpj";

            //chamando  para verificar se email já existe 
            $this->load->model('Cliente');
            $verifica_email = $this->Cliente->buscar_email($data1, "administracao");
        } elseif ($this->input->post('tipo_user') == 1) {
            $id_tabela = "id";
            $identificador = "cpf_cli";


            //chamando  para verificar se email já existe 
            $this->load->model('Cliente');
            $verifica_email = $this->Cliente->buscar_email($data1, "cliente_cli");
        } else {
            $id_tabela = "id_tec";
            $identificador = "cpf_tec";

            $this->load->model('Tecnico');
            $verifica_email = $this->Tecnico->buscar_email($data1, "tecnico");
        }



        if ($this->input->post('id') == $verifica_email->$id_tabela) {
        } else {

            header("Location: editar_cadastro?message=err_email");
            exit;
        }



        // aqui adiciona campos comuns a todas as tabelas 
        $data = array(
            $id_tabela => $this->input->post('id'),
            'tipo_user' => $this->input->post('tipo_user'),
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'endereco' => $this->input->post('endereco'),
            'senha' => $senha,
            'status' => 1,
            $identificador =>  $this->limpaCPF_CNPJ($this->input->post('cpf')),
        );


        //adiciona valores adicionais ao array dependendo da tabela que será inserido
        if ($this->input->post('tipo_user') == 1) {
            $entidade = "cliente_cli";
            $data['cep'] = $this->input->post('cep');
            $data['telefone'] = $this->input->post('tel');
            $data['celular'] = $this->input->post('cel');
            $table = "cliente_cli";
            $model = "Cliente";
        } elseif ($this->input->post('tipo_user') == 2) {
            $entidade = "tecnico";
            $data['cep'] = $this->input->post('cep');
            $data['telefone'] = $this->input->post('tel');
            $data['celular'] = $this->input->post('cel');
            $table = "tecnico";
            $model = "Tecnico";
        }


        //admin
        elseif ($this->input->post('tipo_user') == 0) {
            $entidade = "adminsitracao";
            $data['cep'] = $this->input->post('cep');
            $data['telefone'] = $this->input->post('tel');
            $data['celular'] = $this->input->post('cel');
            $table = "administracao";
            $model = "Usuario";
        }





        //transforma id em int

        $id = intval($this->input->post('id'));
        $this->load->model($model);
        $dados = $this->$model->updatebyid($data, $table);



        if ($dados) {
            //se deu tudo certo  inicia uma nova sessao com os dados atualizados

            session_start();

            $_SESSION['email'] = $data['email'];
            $_SESSION['tipo_user'] = $data['tipo_user'];
            $_SESSION['login'] = $data['nome'];



            // definindo insert de log
            $this->load->model('Movimentacao');
            $id_mov = $this->Movimentacao->BuscabyName("movimentacao", "alteração");

            $timezone = new DateTimeZone('America/Sao_Paulo');
            $data = new DateTime('now', $timezone);
            $data = $data->format('Y/m/d H:i');

            $log = array(
                "id_tb" => $id,
                "NomeEntidade" => $entidade,
                "TipoMov" => $id_mov[0]['id'],
                "data_mod" => $data,
                "responsavel" => $_SESSION['email'],
            );

            $this->load->model('Log');
            $this->Log->setLog($log);
            $this->Log->inserirLog('logs');

            // fim insert de log

            header("Location: editar_cadastro?message=editado");
            exit;
        } else {

            header("Location: editar_cadastro?message=erro_edit");
            exit;
        }
    }




    //trata os uplaods de arquivo
    function upload($arquivo, $pasta, $tipos)
    {

        $nomeOriginal = $arquivo["name"];
        $nomeFinal = md5($nomeOriginal . date("dmYHis"));
        $tipo = strrchr($arquivo["name"], ".");
        $tamanho = $arquivo["size"];




        if (move_uploaded_file($arquivo["tmp_name"], $pasta . $nomeFinal . $tipo)) {
            $nome = $nomeFinal . $tipo;
            $tipo = $tipo;
            $tamanho = number_format($arquivo["size"] / 1024, 2) . "KB";
            return  $nomeFinal . $tipo;
        } else {
            return false;
        }
    }



    public function editar_senha()
    {

        if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
            session_start();
        }

        $tipo_user = $_SESSION['tipo_user'];
        $email = $_SESSION['email'];



        if (@$_SESSION['login'] != null) {

            $senha = $this->input->post('senha');
            $senha2 = $this->input->post('senha2');

            if ($senha !=  $senha2) {
                echo "<script>alert('Senha nao confere!');history.back()</script>";
                exit;
            }

            $data = array(
                "email" => $email,
                "senha" => $this->encript($senha),
            );

            if ($tipo_user == 1) {
                $table = "cliente_Cli";
            } elseif ($tipo_user == 2) {
                $table = "tecnico";
            }

            $this->load->model('Usuario');
            $resultado = $this->Usuario->edit_senha($data, $table);
            if ($senha != $senha2) {
                exit;
            }
            if ($resultado == null) {
                echo "<script>alert('Erro ao alterar!');history.back()</script>";
                exit;
            } else {

                $this->load->view('/template/layout-base.html');
                $this->load->view('/template/index.php');
                $this->load->view('/perfil/edit_senha.html');
                $this->load->view('/template/roda-pe-base.html');
            }
        }
    }








    public function encript($data)
    {
        $senha = hash('sha256', $data);
        return $senha;
    }


    function limpaCPF_CNPJ($valor)
    {
        $valor = preg_replace('/[^0-9]/', '', $valor);
        return intval($valor);
    }
}
