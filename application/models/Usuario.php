<?php


class Usuario extends CI_Model
{
    public $tipo_user;
    public $nome;
    public $email;
    public $senha;
    public $endereco;
    public $cep;
    public $celular;
    public $telefone;
    public $status;
    public $termo;

    #block
    public function setid($id)
    {
        $this->id = $id;
    }

    public function getid()
    {
        return $this->id;
    }


    public function setTipo_user($tipo)
    {
        $this->tipo_user = $tipo;
    }

    public function getTipo_user()
    {
        return $this->tipo_user;
    }


    public function setnome($nome)
    {
        $this->nome = $nome;
    }

    public function getnome()
    {
        return $this->nome;
    }




    public function setemail($email)
    {
        $this->email = $email;
    }

    public function getemail()
    {
        return $this->email;
    }



    public function setsenha($senha)
    {
        $this->senha = $senha;
    }

    public function getsenha()
    {
        return $this->senha;
    }


    public function setendereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getendereco()
    {
        return $this->endereco;
    }



    # endblock



    public function setUser($data)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe

        //aqui ele recebe [0] pois somente e possivel
        // instanciar um objeto pro vez caso necessario 
        //instanciar mais de um objeto irá ter que modificar o metodo para atender 


        foreach ($data as $key => $value) {

            if ($value  != NULL) {
                $this->$key = $value;
            }
        }
        return $this;
    }


    public function setUserArray($data)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe

        //aqui ele recebe [0] pois somente e possivel
        // instanciar um objeto pro vez caso necessario 
        //instanciar mais de um objeto irá ter que modificar o metodo para atender 


        foreach ($data[0] as $key => $value) {

            if ($value  != NULL) {
                $this->$key = $value;
            }
        }
        return $this;
    }


    //passamos a tebela por parametro pois se for um atributo da classe ele entende , que é um item a ser inserido na base de dados , porém não é isso que queremos

    public function inserir($table)
    {

        /* inserindo os dados do array manualmente
        $this->celular = $data['celular'];
        $this->telefone = $data['telefone'];
        $this->tipo_user = $data['tipo_user'];
        $this->nome = $data['nome'];
        $this->email = $data['email'];
        $this->senha = $data['senha'];
        $this->endereco = $data['endereco'];
        $this->status=$data['status'];
        $this->cep=$data['cep'];
        */
        $this->db->insert($table, $this);
    }

    public function updatebyid($data, $table)
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


    public function edit_senha($data, $table)
    {
        //aqui faz um for pegando das chaves do array e comparando com
        // os atributos da classe e depois chama o set para dar o update da nova instacia de classe
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->db->where('email', $data['email']);
        $this->db->set($data);
        return $this->db->update($table, $data);
    }



    public function buscarTodos($table)
    {

        $query = $this->db->select("*");
        $query = $this->db->get($table);


        //aqui fica melhor retornar um array pois 
        // fica mais facil trabalhar com um array de dados do que de objetos

        return  $query->result_array();
    }

    public function buscarByStatus($table, $status)
    {

        $query = $this->db->select("*");
        $this->db->where('status', $status);
        $query = $this->db->get($table);

        return  $query->result_array();
    }

    public function buscarId($table, $id)
    {

        $query = $this->db->select("*");
        $query = $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $this->setUser($query->result_array());
    }









    public function autenticar($data, $table)
    {

        //hash descriptografa a senha que vem do banco

        $email = $data['email'];
        $senha = $data['senha'];
        $status = 0;
        $senha = $this->descrip($senha);

        $query = $this->db->where('email', $email);
        $query = $this->db->where('senha', $senha);
        $query = $this->db->get($table);
        $usuario = $query->row_array();

        if ($usuario['status'] == 1) {

            if (!isset($_SESSION)) {  //Verificar se a sessão não já está aberta.
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;

                //pega o tip ode usuario e login

                $usuario = $query->row_array();
                $_SESSION['tipo_user'] = $usuario["tipo_user"];
                $_SESSION['login'] = $usuario["nome"];

                return true;
            } else {
                return false;
            }
        } else {
        }
    }




    public function buscar_email($data, $table)
    {
        //aqui pea o email e confere se existe usuario e retorna esse usuario
        $query = $this->db->select("*");
        $query = $this->db->where('email', $data['email']);
        $query = $this->db->get($table);


        //verifica para ver qual forma de insert fazer se for um array 
        // cria uma instancia , se nao cria um array de objetos
        if (sizeof($query->result_array()) == 1) {
            return $this->setUserArray($query->result_array());
        } elseif (sizeof($query->result_array()) == 0) {
            return false;
        } else {
            return $this->setUser($query->result_array());
        }
    }
    //aqui pea o cpf e confere se existe usuario e retorna esse usuario
    public function buscar_cpf($data, $table)
    {
        $query = $this->db->select("*");
        $query = $this->db->where('cpf', $data['cpf']);
        $query = $this->db->get($table);


        if (sizeof($query->result_array()) == 1) {
            return $this->setUserArray($query->result_array());
        } elseif (sizeof($query->result_array(0)) == 0) {
            return false;
        } else {
            return $this->setUser($query->result_array());
        }
    }


    public function updatetermo($data, $email, $table)
    {
        $this->db->where('email', $email);
        $this->db->set($data);
        return $this->db->update($table, $data);
    }




    //classe para criptografar senha
    public function descrip($data)
    {
        $senha = hash('sha256', $data);
        return $senha;
    }
}
