<?php
    require_once "./classes/connection.php";
    require_once "Cliente.php";

    class ClienteDAO{
        
        public $db_connection;

        public function __construct(){
            $this->db_connection = Connection::connect();
        }

        public function all() {
            try{
                $query = $this->db_connection->prepare("select * from clientes");
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Cliente");
                return $data;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function findOne($id) {
            try{
                $query = $this->db_connection->prepare("select * from clientes where id=:id");
                $query->bindParam(":id", $id, PDO::PARAM_INT);
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Cliente");
                return $data[0];
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function create (Cliente $cliente) {
            try {
                $query = $this->db_connection->prepare("insert into clientes (nome, telefone) values (:nome, :telefone)");
                $query->bindValue(":nome", $cliente->getNome());
                $query->bindValue(":telefone", $cliente->getTelefone());
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function update(Cliente $cliente) {
            var_dump($cliente);
            $query = $this->db_connection->prepare("update clientes set nome=:nome, telefone=:telefone where id=:id");
            $query->bindValue(":nome", $cliente->getNome());
            $query->bindValue(":telefone", $cliente->getTelefone());
            $query->bindParam(":id", $cliente->getId());
            return $query->execute();
        }

        public function delete($id) {
            try{
                $query = $this->db_connection->prepare("delete from clientes where id=:id");
                $query->bindParam(":id", $id);
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }
    }
?>  