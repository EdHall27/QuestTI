<?php
class Log extends CI_Model
{
    public $id;
    public $id_tb;
    public $NomeEntidade;
    public $TipoMov;
    public $data_mod;
    public $responsavel;
    public $para;
    public $quantidade;




    public function setLog($data)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }


    public function inserirLog($table)
    {
        //aqui pega os dados que estao na instancia da
        //classe e insere no banco

        return $this->db->insert($table, $this);
    }


    public function BuscaLogId($table, $id)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $this->setLog($query->result_array());
    }




    public function TodosLogs()
    {
        $table = "logs";
        $query = $this->db->select("*");
        $query = $this->db->get($table);
        return  $query->result_array();
    }

    public function PesquisaLog($op, $user, $Entidade)
    {
        @session_start();
        $table = "logs";

        // escolhe por qual campo vai filtrar
        switch ($op) {
            case "exlusão":
                $valor = 1;
                break;
            case 2:
                $valor = 2;
                break;
            case "transferência":
                $valor = 3;
                break;
            case "Login":
                $valor = 4;
                break;
            case "Logoff":
                $valor = 5;
                break;

            case "cadastro":
                $valor = 6;
                break;
            case "alteração":
                $valor = 7;
                break;
            case "muda status":
                $valor = 8;
                break;
            case "Stscapturado":
                $valor = 9;
                break;
            case "StsFimTec":
                $valor = 10;
                break;
            case "Stsavaliado":
                $valor = 11;
                break;
            case "Stspago":
                $valor = 12;
                break;
            case "Stsfinalizado":
                $valor = 13;
                break;
            case "Stscancelado":
                $valor = 14;
                break;

            case "BloqueadoAcesso":
                $valor = 15;
                break;

            case "LiberadoAcesso":
                $valor = 16;
                break;
            default:
                break;
        }


        $query = $this->db->select("*");
        $query = $this->db->where('TipoMov', $valor);
        $query = $this->db->where('NomeEntidade', $Entidade);

        if ($user == 0) {
            $query = $this->db->where('responsavel', $_SESSION['email']);
        }
        if ($user == 1) {
            $query = $this->db->where('para', $_SESSION['email']);
        }

        $query = $this->db->order_by('id', 'DESC');
        $query = $this->db->get($table);

        return  $query->result_array();
    }



    public function CompilaDados($dados)
    {
        return count($dados);
    }





    public function PesqStatusfav($user,$tipomov)
    {

        $table = "logs";
        $query = $this->db->select("*");
        $query = $this->db->where('TipoMov', $tipomov);
        $query = $this->db->where('responsavel', $user);
        $query = $this->db->where('quantidade'," 4");
        $query = $this->db->or_where('quantidade'," 5");
        $query = $this->db->get($table);


        return  $query->result_array();
    }

    public function PesqStatus($user, $tipomov)
    {
        $table = "logs";
        $query = $this->db->select("*");
        $query = $this->db->where('responsavel', $user);
        $query = $this->db->where('TipoMov', $tipomov);
        $query = $this->db->get($table);


        return  $query->result_array();
    }
}
