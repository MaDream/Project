<?php
error_reporting(1);
	
	class auth extends CI_Controller 
	{

		public function index()
		{
			if ($this->session->userdata('logged_in') == 'yes')
            echo '<script type="text/javascript">
                window.location.href = "/project/123/index.php"
                </script>';
            else
            	if (!$data['error'])
            	{
					$data['title']='Форма авторизации';
	        		$this->load->view('vauth',$data);
	        	}
		}
		public function auth_user()
		{
			$this->load->model('mauth');
			$arr =	array(
                    'email' => $this->input->post('email',TRUE),
	                'password' => $this->input->post('password')
             		);
			$this->db->where('email', $arr['email']);
        	$this->db->where('password', $arr['password']);
        	$query_check_user = $this->db->get('user');
        	$userdata = $query_check_user->result_array();
        	$nick = $userdata[0]['nickname'];
			if ($this->mauth->user_verify($arr['email'], $arr['password']))
			{
                $this->session->set_userdata(array(
                            'email'         => $arr['email'],
                            'logged_in'     => 'yes',
                            'nickname'      => $nick,
                            'uid'			=> $userdata[0]['id_user'],
                    ));
                // Добавляем данные в сессию
                $this->session->set_userdata($authdata);
                echo '<script type="text/javascript">
                window.location.href = "/project/123/index.php/"
                </script>';
            }
            else 
            {
            	$data['error'] = "Неверный логин или пароль.";
            	$this->load->view('vauth',$data);
            }
		}
 	}
 ?>