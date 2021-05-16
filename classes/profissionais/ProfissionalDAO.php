<?php
    require_once "./classes/connection.php";
    require_once "Profissional.php";

    class ProfissionalDAO{
        
        public $db_connection;

        public function __construct(){
            $this->db_connection = Connection::connect();
        }

        public function all() {
            try{
                $query = $this->db_connection->prepare("select * from profissionais where ativo=1");
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Profissional");
                return $data;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function findOne($email) {
            try{
                $query = $this->db_connection->prepare("select * from profissionais where email=:email");
                $query->bindParam(":email", $email);
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Profissional");
                return $data[0];
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function create (Profissional $profissional) {
            try {
                $query = $this->db_connection->prepare("insert into profissionais (email, nome, senha, telefone, 
                        endereco, ativo) values 
                        (:email, :nome, :senha, :telefone, :endereco, 1)");
                $query->bindValue(":email", $profissional->getEmail());
                $query->bindValue(":nome", $profissional->getNome());
                $query->bindValue(":senha", $profissional->getSenha());
                $query->bindValue(":telefone", $profissional->getTelefone());
                $query->bindValue(":endereco", $profissional->getEndereco());
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function update(Profissional $profissional, $oldmail) {
            $query = $this->db_connection->prepare("update profissionais set nome=:nome, 
                    email=:email, senha=:senha, telefone=:telefone, 
                    endereco=:endereco, ativo=1 where email=:oldmail");
            $query->bindValue(":nome", $profissional->getNome());
            $query->bindValue(":email", $profissional->getEmail());
            $query->bindValue(":oldmail", $oldmail);
            $query->bindValue(":senha", $profissional->getSenha());
            $query->bindValue(":telefone", $profissional->getTelefone());
            $query->bindValue(":endereco", $profissional->getEndereco());
            var_dump($query);
            return $query->execute();
        }

        public function delete($email) {
            try{
                $query = $this->db_connection->prepare("delete from profissionais where email=:email");
                $query->bindParam(":email", $email);
                $result = $query->execute();
                if($result != true) {
                    $query = $this->db_connection->prepare("update profissionais set ativo=0 where email=:email");
                    $query->bindParam(":email", $email);
                    $result = $query->execute();
                }
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }
    }
    