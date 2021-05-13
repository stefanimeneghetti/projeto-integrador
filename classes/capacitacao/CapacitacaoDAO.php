<?php
    require_once "./classes/connection.php";
    require_once "Capacitacao.php";

    class CapacitacaoDAO {
        
        public $db_connection;

        public function __construct(){
            $this->db_connection = Connection::connect();
        }

        public function all() {
            try{
                $query = $this->db_connection->prepare("select p.nome as nome_profissional, p.email as email_profissional, 
                                                        s.nome as nome_servico, s.id as id_servico from
                                                        profissionais p join capacitacao_profissionais c 
                                                        on p.email = c.profissional join servicos s on
                                                        c.servico = s.id;");
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Capacitacao");
                return $data;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function findByProfissional($emailProfissional) {
            try{
                $query = $this->db_connection->prepare("select p.nome as nome_profissional, p.email as email_profissional, 
                                    s.nome as nome_servico, s.id as id_servico from
                                    profissionais p join capacitacao_profissionais c 
                                    on p.email = c.profissional join servicos s on
                                    c.servico = s.id where c.profissional=:emailProfissional");
                $query->bindParam(":emailProfissional", $emailProfissional);
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Capacitacao");
                return $data;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function findByServico($idServico) {
            try{
                $query = $this->db_connection->prepare("select p.nome as nome_profissional, p.email as email_profissional, 
                                                s.nome as nome_servico, s.id as id_servico from
                                                profissionais p join capacitacao_profissionais c 
                                                on p.email = c.profissional join servicos s on
                                                c.servico = s.id where c.servico=:idServico");
                $query->bindParam(":idServico", $idServico, PDO::PARAM_INT);
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_CLASS, "Capacitacao");
                return $data;
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function create(Capacitacao $capacitacao) {
            try{
                $query = $this->db_connection->prepare("insert into capacitacao_profissionais (profissional, servico) values (:emailProfissional, :idServico)");
                $query->bindParam(":idServico", $capacitacao->getServico());
                $query->bindParam(":emailProfissional", $capacitacao->getProfissional());
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

        public function delete($emailProfissional, $idServico) {
            try{
                $query = $this->db_connection->prepare("delete from capacitacao_profissionais where servico=:idServico and profissional=:emailProfissional");
                $query->bindParam(":idServico", $idServico);
                $query->bindParam(":emailProfissional", $emailProfissional);
                return $query->execute();
            }
            catch(PDOException $e){
                echo "Erro no acesso aos dados: ". $e->getMessage();
            }
        }

    }

?>