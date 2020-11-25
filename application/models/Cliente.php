<?php
require_once('Usuario.php');
class Cliente extends Usuario
{
    public $id;
    public $cpf_cli;



 #block
    public function setStatus($data)
    {
        $this->status = $data;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setcelular($data)
    {
        $this->celular = $data;
    }

    public function getcelular()
    {
        return $this->celular;
    }


    public function settelefone($data)
    {
        $this->celular = $data;
    }

    public function gettelefone()
    {
        return $this->telefone;
    }


    public function setcep($data)
    {
        $this->cep = $data;
    }

    public function getcep()
    {
        return $this->cep;
    }

    public function setcpf($data)
    {
        $this->cpf = $data;
    }

    public function getcpf()
    {
        return $this->cpf;
    }

    public function settable($data)
    {
        $table = "cliente_cli";
        return $table;
    }
#endblock




    // aqui recebe em qual tabela e o array com dados a serem inseridos
    public function inserir($table)
    {
        return $this->db->insert($table, $this);
    }



    public function updatebyid($data, $table)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->db->where('id', $data['id']);
        $this->db->set($this);
        return $this->db->update($table, $this);
    }

    //aqui pea o cpf e confere se existe usuario e retorna esse usuario
    public function buscar_cpf($data, $table)
    {

        //pode retornar um array com 1 objeto ou varios ou false

        $query = $this->db->select("*");
        $query = $this->db->where('cpf_cli', $data['cpf_cli']);
        $table = $this->settable($table);
        $query = $this->db->get($table);
        if (sizeof($query->result_array()) == 1) {
            return $this->setUserArray($query->result_array());
        } elseif (sizeof($query->result_array()) == 0) {
            return false;
        } else {
            return $this->setUser($query->result_array());
        }
    }
}
