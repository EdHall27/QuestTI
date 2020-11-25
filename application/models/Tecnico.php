<?php
require_once('Usuario.php');
class Tecnico extends Usuario
{
    public $id_tec;
    public $area_atuacao;
    public $certificado;
    public $avaliacao;
    public $cpf_tec;



    public function settable($data)
    {
        $table = "tecnico";
        return $table;
    }




    // aqui recebe em qual tabela e o array com dados a serem inseridos
    public function inserir($table)
    {
        return $this->db->insert($table, $this);
    }



    public function updatebyid($data, $table)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        $this->db->where('id_tec', $data['id_tec']);
        $this->db->set($this);
        return $this->db->update($table, $this);
    }



    public function UpdateAvaliacao($data, $email)
    {

        $table = "tecnico";
        $this->db->where('email', $email);
        $this->db->set($data);
        return $this->db->update($table, $data);
    }



    public function buscarId($table, $id)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('id_tec', $id);
        $query = $this->db->get($table);

        if (sizeof($query->result_array()) == 1) {
            return $this->setUserArray($query->result_array());
        } elseif (sizeof($query->result_array(0)) == 0) {
            return false;
        } else {
            return $this->setUser($query->result_array());
        }
    }


    //aqui pea o cpf e confere se existe usuario e retorna esse usuario
    public function buscar_cpf($data, $table)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('cpf_tec', $data['cpf_tec']);
        $query = $this->db->get($table);

        if (sizeof($query->result_array()) == 1) {
            return $this->setUserArray($query->result_array());
        } elseif (sizeof($query->result_array(0)) == 0) {
            return false;
        } else {
            return $this->setUser($query->result_array());
        }
    }


    public function buscarTodos($table)
    {

        $query = $this->db->select("*");
        $query =  $this->db->order_by("avaliacao", "DESC");
        $query = $this->db->get($table);


        //aqui fica melhor retornar um array pois 
        // fica mais facil trabalhar com um array de dados do que de objetos

        return  $query->result_array();
    }
}
