<?php
    class Db extends MySQLi{
        static protected $instance = null;

        public function __construct($host, $user, $password, $schema){
            parent::__construct($host, $user, $password, $schema);
        }

        static function getInstance(){
            if(self::$instance == null){
                self::$instance = new Db ('my_mariadb', 'root', 'ciccio', 'scuola');
            }
            return self::$instance;
        }

        public function select($table, $where = 1){
            if ($result = $this->query("SELECT * FROM alunni WHERE $where")) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            return [];
        }
    }
?>