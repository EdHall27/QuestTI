<?php
class Movimentacao extends CI_Model
{
    public $id;
    public $NomeMov;


    public function setMovimento($data)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }


    public function inserirMovimento($table)
    {
        //aqui pega os dados que estao na instancia da
        //classe e insere no banco

        return $this->db->insert($table, $this);
    }


    public function BuscaMovimentoId($table, $id)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $this->setMovimento($query->result_array());
    }

    public function BuscabyName($table, $nome)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('NomeMov', $nome);
        $query = $this->db->get($table);
        return  $query->result_array();
    }

 

    public function TodosMovimentos($table)
    {
        $query = $this->db->select("*");
        $query = $this->db->get($table);
        return  $query->result_array();
    }




}
