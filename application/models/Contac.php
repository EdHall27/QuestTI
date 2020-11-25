<?php
class Contac extends CI_Model
{
    public $id;
    public $cpf;
    public $titular;
    public $tipo_conta;
    public $saldo;
    public $credito;  // caso tenha liberação  além do saldo disponivel com um  limite determinado




    public function setconta($data)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }


    public function inserirconta()
    {
        $table = "contac";
        //aqui pega os dados que estao na instancia da
        //classe e insere no banco
        return $this->db->insert($table, $this);
    }





    // para nao adicionar caso ja exista uma conta com o mesmo dono e sendo do mesmo tipo de conta

    public function verificaExists($data)
    {
        $table = "contac";
        $query = $this->db->select("*");
        $query = $this->db->where('cpf', $data['cpf']);
        $query = $this->db->where('titular', $data['titular']);
        $query = $this->db->where('tipo_conta', $data['tipo_conta']);
        $query = $this->db->get($table);

        return  $query->result_array();
    }


    public function verificaTitular($email)
    {
        $table = "contac";
        $query = $this->db->select("*");
        $query = $this->db->where('titular', $email);
        $query = $this->db->get($table);
        return  $query->result_array();
    }


    public function verificaCpf($cpf)
    {
        $table = "contac";
        $query = $this->db->select("*");
        $query = $this->db->where('cpf', $cpf);
        $query = $this->db->get($table);
        return  $query->result_array();
    }

    public function updateSaldo($email, $data)
    {
        $table = "contac";

        $this->db->where('titular', $email);
        $this->db->set($data);
        return $this->db->update($table, $data);
    }


}
