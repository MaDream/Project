<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class mReg extends CI_Model {
 
    /**
     * Функция добавляет данные в таблицу
     */
    public function insert($table, $arr)
    {
        $this->db->insert($table, $arr);
    }
    /**
     * Проверка на существование пользователя в БД
     */
    public function user_verify($email)
    {
        $this->db->where('email', $email);
        $query_check_user = $this->db->get('user');
        $userdata = $query_check_user->result_array();
        // Если пользователь с таким логином не найден
        if ($userdata[0]['email'] != $email)
        	return true; // Пользователя нет, проверка пройдена
        else
        	return false; // Пользователь существует
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