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
                $query->bindValue(":preco", $atendimento->getQuantidade_paga());
                $query->bindValue(":descricao", $atendimento->getDescricao());
                $query->bindValue(":quantidade_paga", $atendimento->getQuantidade_paga());
                $query->bindValue(":cliente", $atendimento->getCliente());
                $query->bindValue(":status", $atendimento->getStatus());
                $query->bindValue(":profissional", $atendimento->getProfissional());
                $query->bindValue(":servico", $atendimento->getServico());
                return $query->execute();
            }
            catch(PDOException $e){
                return "Erro no acesso aos dados: ". $e->getMessage();
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

        public function getPossibleAppointmentTimes($professionalId, $service, $date) {
            try {
                $appointments = $this->db_connection->prepare("select a.data as start, s.duracao as duration from atendimentos a
                                                               join servicos s on a.servico = s.id where a.profissional=:id
                                                               and a.data between :daybeg and :dayend order by a.data");
                $appointments->bindParam(":id", $professionalId);
                $daybeg = date('Y-m-d', strtotime($date)) . " 06:00:00";
                $dayend = date('Y-m-d', strtotime($date)) . " 23:30:00";
                $appointments->bindParam(":daybeg", $daybeg);
                $appointments->bindParam(":dayend", $dayend);
                $appointments->execute();
                $data = $appointments->fetchAll(PDO::FETCH_ASSOC);
                $app_timeframes = array();
                $serviceDuration = $this->dateToSecs((new ServicoDAO())->findOne($service)->getDuracao());
                $offset = $this->dateToSecs("0:30:0");
                for($timeframeHour = 6; $timeframeHour < 24; $timeframeHour++)
                {
                    for($timeframeMinute = 0; $timeframeMinute < 60; $timeframeMinute += 30)
                    {
                            $timeframeStart = $timeframeHour . ":" . $timeframeMinute. ":0";
                            $timeframeStartInt = $this->dateToSecs($timeframeStart);
                            $timeframeEndInt = $timeframeStartInt + $serviceDuration;
                            $i = 1;
                            foreach($data as $app)
                            {
                                $appointmentStartInt = $this->dateToSecs(date('H:i:s', strtotime($app['start'])));
                                $appointmentEndInt = $this->dateToSecs($app['duration']) + $appointmentStartInt;
                                if(($timeframeStartInt < $appointmentEndInt && $timeframeStartInt > $appointmentStartInt) ||
                                   ($timeframeEndInt < $appointmentEndInt && $timeframeEndInt > $appointmentStartInt) ||
                                   ($timeframeStartInt < $appointmentStartInt && $timeframeStartInt + $offset > $appointmentEndInt))
                                   {
                                       $i = 0;
                                       break;
                                   }
                            }
                            if($i == 1)
                                $app_timeframes[] = date('H:i', strtotime($timeframeStart));
                    }
                }
                
                return $app_timeframes;
            }
            catch(PDOException $e){ 
                return "Erro no acesso aos dados: ". $e->getMessage();
            }
        }
        private function dateToSecs($date) {
            $date = explode(":", $date);
            return ((int) $date[2]) + (((int) $date[1]) * 60) + (((int) $date[0]) * 3600);
        }
    }

?>