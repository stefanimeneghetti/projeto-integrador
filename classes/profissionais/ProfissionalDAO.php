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
                $query = $this->db_connection->prepare("select * from profissionais");
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
                $query = $this->db_connection->prepare("insert into profissionais (email, nome, senha, telefone, endereco) values (:email, :nome, :senha, :telefone, :endereco)");
                $query->bindValue(":nome", $profissional->getNome());
                $query->bindValue(":email", $profissional->getEmail());
                $query->bindValue(":senha", $profissional->getSenha());
                $query->bindValue(":telefone", $profissional->getTelefone());
                $query->bindValue(":endereco", $profissional->getEmail());
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function update(Profissional $profissional) {
            $query = $this->db_connection->prepare("update profissionais set nome=:nome, email=:email, senha=:senha, telefone=:telefone, endereco=:endereco where email=:email");
            $query->bindValue(":nome", $profissional->getNome());
            $query->bindValue(":email", $profissional->getEmail());
            $query->bindValue(":senha", $profissional->getSenha());
            $query->bindValue(":telefone", $profissional->getTelefone());
            $query->bindValue(":endereco", $profissional->getEmail());
            return $query->execute();
        }

        public function delete($email) {
            try{
                $query = $this->db_connection->prepare("delete from profissionais where email=:email");
                $query->bindParam(":email", $email);
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }
    }
?>  