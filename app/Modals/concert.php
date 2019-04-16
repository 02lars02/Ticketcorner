<?php
    class Concert {
        public $id;
        public $artist;
        public $db;
        
        function __construct($id = null, $artist = null) {
            $this->id = $id;
            $this->artist = $artist;
            $this->db = connectToDatabase();
        }

        function getAllConcerts() {
            $statement = $this->db->prepare('SELECT * FROM `concerts`');
            $statement->execute();
            $result = $statement->fetchAll();
            $concerts = array();
            foreach($result as $one) {
                array_push($concerts, new Concert($one['id'], $one['artist']));
            }
            return $concerts;
        }

        public function create() {
            $statement = $this->db->prepare('INSERT INTO `concerts` (artist) VALUES (:artist)');
            $statement->bindParam(':artist', $this->artist, PDO::PARAM_STR);

            return $statement->execute();
        }
    }
