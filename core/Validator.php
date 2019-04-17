<?php
    class Validator {
        function __construct() {

        }

        const REQUIRED = 1;
        const VALID = 2;
        const LENGTH = 3;

        public static function isNameCorrect(string $name = '') : array {
          $toReturn = array();

          if(strlen(trim($name)) < 1) {
            array_push($toReturn, self::REQUIRED);
          }

          if(strlen(trim($name)) > 255) {
            array_push($toReturn, self::LENGTH);
          }

          return $toReturn;
        }

        public static function isEmailCorrect(string $email = '') : array {
            $toReturn = array();

            if(strlen(trim($email)) < 1) {
              array_push($toReturn, self::REQUIRED);
            }

            if(strlen(trim($email)) > 255) {
              array_push($toReturn, self::LENGTH);
            }

            if(trim($email) != '' &&  !preg_match("/^.+@.+\..{2,}$/", $email)) {
                array_push($toReturn, self::VALID);
            }

            return $toReturn;
        }

        public static function isPhoneCorrect(string $phone = '') : array {
            $toReturn = array();

            if(strlen(trim($phone)) > 20) {
              array_push($toReturn, self::LENGTH);
            }

            if(trim($phone) != '' &&  !preg_match("/^[0-9() +\/-]+$/", $phone)) {
                array_push($toReturn, self::VALID);
            }

            return $toReturn;
        }

        public static function isBonusCorrect(string $bonus = '') : bool{
          if(!is_numeric($bonus)) {
            return false;
          }
          foreach (Bonus::getAllBonus() as $key => $value) {
            if($value->id == $bonus){
              return true;
            }
          }
          return false;
        }

        public static function isConcertCorrect(string $concert = '') : bool{
          if(!is_numeric($concert)) {
            return false;
          }
          foreach (Concert::getAllConcerts() as $key => $value) {
            if($value->id == $concert){
              return true;
            }
          }
          return false;
        }

        public static function areIdsCorrect(array $ids) : bool {
          if(!is_array($ids)) {
            return false;
          }
          $toReturn = true;
          foreach ($ids as $key => $value) {
            $toReturn = $toReturn && is_numeric($value);
          }
          return $toReturn;
        }
    }
