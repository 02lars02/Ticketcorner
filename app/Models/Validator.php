<?php
    class Validator {
        function __construct() {
            
        }

        public static function isEmailCorrect($email) {
            if(strpos($email, '@') !== false) {
                return true;
            } else {
                return false;
            }
        }

        public static function isPhoneCorrect($phone) {
            if(preg_match("/^[0-9()+\/-]+$/", $phone)) {
                return true;
            } else {
                return false;
            }
        }
    }