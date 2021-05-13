<?php
    require_once "./classes/connection.php";
    require_once "Atendimento.php";

    class AtendimentoDAO {
        
        public $db_connection;

        public function __construct(){
            $this->db_connection = Connection::connect();
        }

        public function create(Atendimento $atendimento) {
            try {
                $query = $this->db_connection->prepare("insert into atendimentos 
                        (data, preco, descricao, quantidade_paga, cliente, status, profissional, servico) values
                        (:data, :preco, :descricao, :quantidade_paga, 
                        :cliente, :status, :profissional, :servico)");
                $query->bindValue(":data", $atendimento->getData());
                $query->bindValue(":preco", $atendimento->getPreco());
                $query->bindValue(":descricao", $atendimento->getDescricao());
                $query->bindValue(":quantidade_paga", $atendimento->getQuantidade_paga());
                $query->bindValue(":cliente", $atendimento->getCliente());
                $query->bindValue(":status", $atendimento->getStatus());
                $query->bindValue(":profissional", $atendimento->getProfissional());
                $query->bindValue(":servico", $atendimento->getServico());
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function update(Atendimento $atendimento) {
            try {
                $query = $this->db_connection->prepare("update atendimentos set
                        data=:data, preco=:preco, descricao=:descricao, quantidade_paga=:quantidade_paga, 
                        cliente=:cliente, status=:status, profissional=:profissional, servico=:servico
                        where id=:id");
                $query->bindValue(":data", $atendimento->getData());
                $query->bindValue(":preco", $atendimento->getPreco());
                $query->bindValue(":descricao", $atendimento->getDescricao());
                $query->bindValue(":quantidade_paga", $atendimento->getQuantidade_paga());
                $query->bindValue(":cliente", $atendimento->getCliente());
                $query->bindValue(":status", $atendimento->getStatus());
                $query->bindValue(":profissional", $atendimento->getProfissional());
                $query->bindValue(":servico", $atendimento->getServico());
                $query->bindValue(":id", $atendimento->getId());
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function delete($id) {
            try{
                $query = $this->db_connection->prepare("delete from atendimentos where id=:id");
                $query->bindParam(":id", $id);
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

    }

?>