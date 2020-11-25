<?php
class ObsChamado extends CI_Model
{
    public $id;
    public $id_chamado;
    public $data;
    public $obs;
    public $responsavel;



    public function setObsChamado($data)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }


    public function inserirObsChamado($data)
    {
        $table = "obschamado";
        //aqui pega os dados que estao na instancia da
        //classe e insere no banco
        $this->db->set($data);
        return $this->db->insert($table, $data);
    }

    function delete($id)
    {
        $table = "obschamado";
        $retorno = $this->db->where('id', $id);
        $retorno = $this->db->delete($table);

        if ($retorno) {
            return true;
        } else {
            return false;
        }
    }




    public function updateObsId($id, $data)
    {
        $table = "obschamado";
        $this->db->where('id', $id);
        $this->db->where('responsavel', $data['responsavel']);
        $this->db->set($data);
        return $this->db->update($table, $data);
    }


    public function TodosObsChamados($id_chamado)
    {
        $table = "obschamado";
        $query = $this->db->select("*");
        $this->db->where('id_chamado', $id_chamado);
        $query = $this->db->get($table);
        return  $query->result_array();
    }





    public function  SelectObsId($id)
    {
        $table = "obschamado";
        $query = $this->db->select("*");
        $query = $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->result_array();
    }




    public function settable($table)
    {
        $table = $table;
        return $table;
    }
}
