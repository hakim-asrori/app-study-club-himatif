<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Nativesession{
    public function __construct(){
        session_start();
    }
    // function untuk meng-set session
    public function set_ses($key, $value){
        $_SESSION[$key] = $value;
    }
    // function untuk memanggil session
    public function get_ses($key){
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }
    // function untuk menghapus session
    public function delete_ses($key){
        unset($_SESSION[$key]);
    }
}