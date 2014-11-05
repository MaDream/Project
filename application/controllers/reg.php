<?php
 error_reporting(0);
if (!defined('BASEPATH')) exit('No direct script access allowed');

class reg extends CI_Controller {
 
	public function index()
	{
        if ($this->session->userdata('logged_in') == 'yes')
            echo '<script type="text/javascript">
                window.location.href = "/index.php"
                </script>';
		$data['title']='Форма регистрации';
        $this->load->view('vReg',$data);
	}
    public function reg_user()
    {
	// Собираем в массив все POST данные
  	$arr= array(
                    'email' => $this->input->post('email',TRUE),
                    'nickname' => $this->input->post('nickname'),
	                'password' => $this->input->post('password'),

             );
    $data['error'] = $this->input->post('email').$this->input->post('nickname').$this->input->post('password').$this->input->post('passwordc');
	// Проверка формы на валидацию.
    $this->form_validation->set_rules('email', 'Адрес электронной почты пользователя', 'trim|required|valid_email|xss_clean ');
    $this->form_validation->set_rules('nickname', 'Имя пользователя', 'trim|required|min_length[5]|max_length[12]|xss_clean ');
	$this->form_validation->set_rules('password', 'Пароль', 'required|matches[passwordc]|xss_clean ');
	$this->form_validation->set_rules('passwordc', 'Повтор пароля', 'required|xss_clean ');
 
    if ($this->form_validation->run() == FALSE)
    {
	//  Если форма не прошла валидацию, отсылаем пользователя заполнять ее заново
        $data['error']='Данные не корректны';
	    $this->load->view('vReg',$data);
    }
    else
    {
	// Подключаем модель которая будет обрабатывать запросы
	$this->load->model('mreg');
            // Если пользователь с таким логином не найден
            if ($this->mReg->user_verify($arr['email'])){
                // Создаем массив с данными сессии и записываем нового пользователя в БД
 
	    // Добавляем данные о пользователе в БД
	    
        	    $this->mReg->insert('user',$arr);
                // Редериктим на нужную нам страницу
                echo '<script type="text/javascript">
                window.location.href = "/index.php"
                </script>';
            }
            // Если пользователь существует отправляем его заполнять форму заново
            else {
                $data['error']='Email занят';
	            $this->load->view('vReg',$data);
            }
        }
    }

}