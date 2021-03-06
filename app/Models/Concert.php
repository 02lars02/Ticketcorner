<?php
    class Concert {
        public $id;
        public $artist;
        
        function __construct($id = null, $artist = null) {
            $this->id = $id;
            $this->artist = $artist;
        }

        public static function getAllConcerts() {
            $statement = connectToDatabase()->prepare('SELECT * FROM `concerts`');
            $statement->execute();
            $result = $statement->fetchAll();
            $concerts = array();
            foreach($result as $one) {
                array_push($concerts, new Concert($one['id'], $one['artist']));
            }
            return $concerts;
        }

        public function create() {
            $statement = connectToDatabase()->prepare('INSERT INTO `concerts` (artist) VALUES (:artist)');
            $statement->bindParam(':artist', $this->artist, PDO::PARAM_STR);

            return $statement->execute();
        }

        public static function getById($id)
        {
        $statement = connectToDatabase()->prepare('SELECT * FROM `concerts` WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch();

        return new Concert($result['id'], $result['artist']);
        }
    }
