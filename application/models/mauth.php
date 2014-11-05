<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class mAuth extends CI_Model {
 
    /**
     * Проверка на существование пользователя в БД
     */
    public function user_verify($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query_check_user = $this->db->get('user');
        $userdata = $query_check_user->result_array();
        // Если пользователь с таким логином не найден
        if ($userdata[0]['email'] != $email)
        	return false; // Пользователя нет, проверка не пройдена
        else
        	return true; // Пользователь существует
    }
    /**
     * Функция верификации сессии
     */
    public function sess_verify()
    {
        $this->load->library('session');
        $check_auth = $this->session->userdata('logged_in');
        if ($check_auth != true) 
        {
                echo '<script type="text/javascript">
                window.location.href = "/diplom/index.php"
                </script>';
        }
        else 
            return true;
    }
}