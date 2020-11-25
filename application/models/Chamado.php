<?php
class Chamado extends CI_Model
{
    public $id_chamado;
    public $status;
    public $descricao;
    public $cpf_cliente;
    public $cpf_tecnico;
    public $categoria;
    public $assunto;
    public $arquivo;
    public $avaliacao;
    public $data_abertura;
    public $data_fim;



    public function setChamado($data)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }


    public function inserirChamado($table)
    {
        //aqui pega os dados que estao na instancia da
        //classe e insere no banco
        return $this->db->insert($table, $this);
    }

    function delete($id)
    {
        $table = "chamado";
        $retorno = $this->db->where('id_chamado', $id);
        $retorno = $this->db->delete($table);

        if ($retorno) {
            return true;
        } else {
            return false;
        }
    }




    public function updateChamadoId($data, $table)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        $this->db->where('id_chamado', $data['id_chamado']);
        $this->db->set($data);
        return $this->db->update($table, $data);
    }


    public function TodosChamados($table)
    {
        $query = $this->db->select("*");
        $query = $this->db->get($table);
        return  $query->result_array();
    }


    public function ChamadobyStatus($table, $status)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('status', $status);
        $query = $this->db->get($table);
        return  $query->result_array();
    }



    public function ByStatusTec($status, $cpf)
    {
        $table = "chamado";
        $query = $this->db->select("*");
        $query = $this->db->where('status', $status);
        $query = $this->db->where('cpf_tecnico', $cpf);
        $query = $this->db->get($table);
        return  $query->result_array();
    }


    public function ByStatusCli($status, $cpf)
    {
        $table = "chamado";
        $query = $this->db->select("*");
        $query = $this->db->where('status', $status);
        $query = $this->db->where('cpf_cliente', $cpf);
        $query = $this->db->get($table);
        return  $query->result_array();
    }

    public function BuscaChamadoId($table, $id)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('id_chamado', $id);
        $query = $this->db->get($table);
        return $this->setChamado($query->result_array());
    }


    public function  pesquisa_usuario($data)
    {


        if ($data['tipo_user'] == 1) {
            $table = "cliente_cli";

            $query = $this->db->select("cpf_cli");
            $query = $this->db->where('email', $data['email']);
            $query = $this->db->where('tipo_user', $data['tipo_user']);
            $query = $this->db->get($table);

            return $query->result_array();
        } else if ($data['tipo_user'] == 2) {
            $table = "tecnico";

            $query = $this->db->select("cpf_tec");
            $query = $this->db->where('email', $data['email']);
            $query = $this->db->where('tipo_user', $data['tipo_user']);
            $query = $this->db->get($table);

            return $query->result_array();
        } else {
            return false;
        }
    }




    public function  ChamadoId($data)
    {
        $table = "chamado";
        $query = $this->db->select("*");
        $query = $this->db->where('id_chamado', $data['id_chamado']);
        $query = $this->db->get($table);
        return $query->result_array();
    }




    public function Muda_Sts_Solicitacao($table, $id)
    {
        $query = $this->db->set($table);
        $query = $this->db->where('id_chamado', $id);
        $query = $this->db->update($table);


        //verifica se a mudança foi feita ou nao 
        if ($query) {
            return true;
        } else {
            return false;
        }
    }


    public function  pesquisa_ByTec($data)
    {
    }

    public function  pesquisa_ByUsuario($data)
    {
    }


    public function  Avaliar($data, $id)
    {
        $table = "chamado";
        $this->db->where('id_chamado', $id);
        $this->db->set($data);
        return $this->db->update($table, $data);
    }


    public function  AdicionaPreco($data, $id)
    {
        $table = "chamado";
        $this->db->where('id_chamado', $id);
        $this->db->set($data);
        return $this->db->update($table, $data);
    }


    



    public function settable($table)
    {
        $table = $table;
        return $table;
    }
}
