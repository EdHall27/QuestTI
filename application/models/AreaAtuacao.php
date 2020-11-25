<?php
class AreaAtuacao extends CI_Model
{
    public $id;
    public $NomeArea;



    public function setArea($data)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public function setAreaArray($data)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        
        //aqui ele recebe [0] pois somente e possivel
        // instanciar um objeto pro vez caso necessario 
        //instanciar mais de um objeto irá ter que modificar o metodo para atender 
        

        foreach ($data[0] as $key => $value) {
          
          if($value  != NULL){
            $this->$key = $value;
          }
            
        }
        return $this;
    }


    public function inserirArea($table)
    {
        //aqui pega os dados que estao na instancia da
        //classe e insere no banco

        return $this->db->insert($table, $this);
    }


    public function BuscaAreaId($table, $id)
    {

        $query = $this->db->select("*");
        $query = $this->db->where('id', $id);
        $query = $this->db->get($table);
        if (sizeof($query->result_array()) == 1) {
            return $this->setAreaArray($query->result_array());
        } elseif (sizeof($query->result_array()) == 0) {
            return false;
        } else {
            return $this->setArea($query->result_array());
        }
    }

    public function BuscaAreaName($table, $name)
    {

        $query = $this->db->select("*");
        $query = $this->db->where('NomeArea', $name);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function updateAreaId($data, $table)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->db->where('id', $data['id']);
        $this->db->set($data);
        return $this->db->update($table, $data);
    }




    public function TodasAreas($table)
    {
        $query = $this->db->select("*");
        $query = $this->db->get($table);
        return  $query->result_array();
    }




    public function settable($table)
    {
        $table = $table;
        return $table;
    }
}
