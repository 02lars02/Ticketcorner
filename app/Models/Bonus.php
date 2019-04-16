<?php
    class Bonus {
        public $id;
        public $text;
        public $termReduction;
         
        function __construct($id = null, $text = null, $termReduction = null) {
            $this->id = $id;
            $this->text = $text;
            $this->termReduction = $termReduction;
        }

        public static function getAllBonus() {
            $statement = connectToDatabase()->prepare('SELECT * FROM `bonus`');
            $statement->execute();
            $result = $statement->fetchAll();
            $bonus = array();
            foreach($result as $bon) {
                array_push($bonus, new Bonus($bon['id'], $bon['text'], $bon['termReduction']));
            }
            return $bonus;
        }

        public function create() {
            $statement = connectToDatabase()->prepare('INSERT INTO `bonus` (artist) VALUES (:artist)');
            $statement->bindParam(':artist', $this->artist, PDO::PARAM_STR);

            return $statement->execute();
        }

        public static function getById($id) {
            $statement = connectToDatabase()->prepare('SELECT * FROM `bonus` WHERE id = :id');
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetch();

            return new Bonus($result['id'], $result['text'], $result['termReduction']);
        }
    }
?>
