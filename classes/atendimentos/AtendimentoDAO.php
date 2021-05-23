<?php
    require_once "./classes/connection.php";
    require_once "Atendimento.php";

    class AtendimentoDAO {
        
        public $db_connection;

        public function __construct(){
            $this->db_connection = Connection::connect();
        }

        public function getByDay($day) {
            try {
                $query = $this->db_connection->prepare("select 
                        a.id, a.data, a.preco, a.descricao, a.quantidade_paga,
                        c.nome as cliente,
                        status.descricao as status,
                        p.nome as profissional,
                        s.nome as servico, s.duracao
                    from atendimentos a 
                        join clientes c on a.cliente = c.id
                        join status on status.id = a.status 
                        join profissionais p on p.id = a.profissional 
                        join servicos s on s.id = a.servico
                    where data like :day order by data asc");
                $query->bindValue(":day", $day.'%');
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, 'Atendimento');
                return $data;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function updateStatus($id, $status) {
            try {
                $query = $this->db_connection->prepare("update atendimentos set
                        status=:status where id=:id");
                $query->bindValue(":status", $status);
                $query->bindValue(":id", $id);
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function create(Atendimento $atendimento) {
            try {
                $query = $this->db_connection->prepare("insert into atendimentos 
                        (data, preco, descricao, quantidade_paga, cliente, status, profissional, servico) values
                        (:data, :preco, :descricao, :quantidade_paga, 
                        :cliente, :status, :profissional, :servico)");
                $query->bindValue(":data", $atendimento->getFullDate());
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
                $query->bindValue(":data", $atendimento->getFullDate());
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

        
        public function getStatus() {
            try {
                $query = $this->db_connection->prepare("select * from status");
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }
        
        public function getAppointmentsByProfessional($id) {
            try {
                $query = $this->db_connection->prepare("select * from atendimentos where profissional=:id");
                $query->bindParam(":id", $id);
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Atendimento");
                foreach($data as $appntmnt)
                    $appntmnt->setData($appntmnt->getFullDate());
                return $data;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

    }

?>