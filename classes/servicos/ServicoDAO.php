<?php
    require_once "./classes/connection.php";
    require_once "Servico.php";

    class ServicoDAO{
        
        public $db_connection;

        public function __construct(){
            $this->db_connection = Connection::connect();
        }

        public function all() {
            try{
                $query = $this->db_connection->prepare("select * from servicos where ativo=1");
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Servico");
                return $data;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function findOne($id) {
            try{
                $query = $this->db_connection->prepare("select * from servicos where id=:id");
                $query->bindParam(":id", $id, PDO::PARAM_INT);
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Servico");
                return $data[0];
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function create (Servico $servico) {
            try{
                $query = $this->db_connection->prepare("insert into servicos (nome, duracao, preco, descricao, ativo) values (:n, :t, :p, :d, :a)");
                $query->bindValue(":n", $servico->getNome());
                $query->bindValue(":t", $servico->getDuracao());
                $query->bindValue(":p", $servico->getPreco());
                $query->bindValue(":d", $servico->getDescricao());
                $query->bindValue(":a", 1);
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function update(Servico $servico) {
            $query = $this->db_connection->prepare("update servicos set nome=:n, duracao=:t, preco=:p, descricao=:d where id=:id");
            $query->bindValue(":n", $servico->getNome());
            $query->bindValue(":t", $servico->getDuracao());
            $query->bindValue(":p", $servico->getPreco());
            $query->bindValue(":d", $servico->getDescricao());
            $query->bindValue(":id", $servico->getId());
            return $query->execute();
        }

        public function delete($id) {
            try{
                $query = $this->db_connection->prepare("delete from servicos where id=:id");
                $query->bindParam(":id", $id, PDO::PARAM_INT);
                $result = $query->execute();

                if($result != true) {
                    $query = $this->db_connection->prepare("update profissionais set ativo=0 where id=:id");
                    $query->bindParam(":id", $id, PDO::PARAM_INT);
                    $result = $query->execute();
                }
                return $result;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }
    }
?>  