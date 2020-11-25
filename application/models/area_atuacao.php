<?php
class area_atuacao extends CI_Model
{
    public function select_all()
    {
        $table = "areaatuacao";
        $query = $this->db->select("*");
        $query = $this->db->get($table);

        return  $query->result_array();
    }

    public function mudaid($nome , $table)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('NomeArea',$nome );  
        $query = $this->db->get($table);
        return  $query->result_array();
    }


    public function BuscaNome($id , $table)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('id',$id );  
        $query = $this->db->get($table);
        return  $query->result_array();
    }
}
