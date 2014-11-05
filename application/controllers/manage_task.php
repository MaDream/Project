<?php
 error_reporting(0);
//if (!defined('BASEPATH')) exit('No direct script access allowed');

class manage_task extends CI_Controller 
{
	public function redirect()
	{
		$this->manage($this->session->userdata('tid'));
	}
	public function manage($tid, $owner = 0)
	{
		if ($this->session->userdata('logged_in') != 'yes')
            echo '<script type="text/javascript">
                window.location.href = "/index.php"
                </script>';
        $this->session->set_userdata(array(
                            'email'         => $this->session->userdata('email'),
                            'logged_in'     => $this->session->userdata('logged_in'),
                            'nickname'      => $this->session->userdata('nickname'),
                            'uid'			=> $this->session->userdata('uid'),
                            'tid'			=> $tid
                    ));
		$data['title'] = 'Редактировать задачу';
		$this->load->model('manage_task_m');
		$data['resault'] = $this->manage_task_m->get_task_data($tid);
		$data['subtasks'] = $this->manage_task_m->get_subtasks($tid);
		$data['comments'] = $this->manage_task_m->get_comments($tid);
		$o = $this->manage_task_m->check_userowner($tid);
		if (isset($o))
			$data['owner'] = $o;
		else
			$data['owner'] = $owner;
		$data['tid'] = $tid;
		$this->load->view('manage_task_v', $data);
	}
	public function mng($tid, $owner = 0)
	{
		$arr= array(
                    'name' => $this->input->post('name'),
                    'specification' => $this->input->post('specification'),
	                'endTime' => $this->input->post('endDate'),
                    'taskTime' => $this->input->post('taskTime'),
                    'output' => $this->input->post('output'),
                    'progress' => $this->input->post('progress')
             );
	    $this->form_validation->set_rules('name', 'Название задачи', 'required|xss_clean ');
	    $this->form_validation->set_rules('specification', 'Описание', 'xss_clean ');
		$this->form_validation->set_rules('endDate', 'Дата окончания', 'required|xss_clean ');
		$this->form_validation->set_rules('taskTime', 'Время на выполнение', 'required|xss_clean ');
		$this->form_validation->set_rules('output', 'Предпологаемый результат', 'xss_clean ');
		$this->form_validation->set_rules('progress', 'Оставшееся время работы', 'xss_clean ');
	    if ($this->form_validation->run() == FALSE)
	    {
	        $data['error']='Данные некорректны';
	        $data['resault'] = $this->manage_task_m->get_task_data($tid);
			$data['subtasks'] = $this->manage_task_m->get_subtasks($tid);
			$data['comments'] = $this->manage_task_m->get_comments($tid);
			$o = $this->manage_task_m->check_userowner($tid);
			if (isset($o))
				$data['owner'] = $o;
			else
				$data['owner'] = $owner;
			$data['tid'] = $tid;
		    $this->load->view('manage_task_v',$data);
	    }
	    else
	    {
	    	$this->load->model('manage_task_m');
	    	$this->manage_task_m->update_task($arr, $tid);
	    	echo '<script type="text/javascript">
                window.location.href = "/index.php/manage_task/manage/'.$tid.'"
                </script>';
		}
	}
	public function new_subtask($tid, $owner = 0)
	{
		$this->load->model('manage_task_m');
		$arr= array(
                    'name' => $this->input->post('name',TRUE),
                    'endTime' => $this->input->post('endDate'),
	                'taskTime' => $this->input->post('time'),
	                'theStartTime' => date("Y-m-d"),
	                'parentTask' => $tid,
	                'level' => $this->manage_task_m->get_parentlevel($tid) + 1
             );
		if ($arr['level'] > 5)
		{
			$data['error']='Максимальный уровень вложенности 5.';
			$data['resault'] = $this->manage_task_m->get_task_data($tid);
			$data['subtasks'] = $this->manage_task_m->get_subtasks($tid);
			$data['comments'] = $this->manage_task_m->get_comments($tid);
			if (isset($o))
				$data['owner'] = $o;
			else
				$data['owner'] = $owner;
			$data['tid'] = $tid;
		    $this->load->view('manage_task_v',$data);
		}
		else
		{
		    $this->form_validation->set_rules('name', 'Название задачи', 'trim|required|xss_clean ');
		    $this->form_validation->set_rules('endDate', 'Дата, к которой необходимо решить задачу', 'trim|required|xss_clean ');
			$this->form_validation->set_rules('time', 'Время, требуемое для завершения задачи', 'required|integer|xss_clean ');
	 
		    if ($this->form_validation->run() == FALSE)
		    {
		        $data['error']='Данные некорректны';
				$data['resault'] = $this->manage_task_m->get_task_data($tid);
				$data['subtasks'] = $this->manage_task_m->get_subtasks($tid);
				$data['comments'] = $this->manage_task_m->get_comments($tid);
				if (isset($o))
					$data['owner'] = $o;
				else
					$data['owner'] = $owner;
				$data['tid'] = $tid;
				$this->load->view('manage_task_v', $data);
		    }
		    else
		    {
				$this->manage_task_m->insert_subtask($arr, $tid);
				echo '<script type="text/javascript">
	                window.location.href = "/index.php/manage_task/manage/'.$tid.'"
	                </script>';
			}
		}

	}
	public function new_comment($tid, $owner = 0)
	{
		$arr = array( 'commentary' => $this->input->post('com'), 'iduser' => $this->session->userdata('uid'), 'idtask' => $tid);
		$this->load->model('manage_task_m');
		$this->manage_task_m->insert_comment($arr);
		echo '<script type="text/javascript">
                window.location.href = "/index.php/manage_task/manage/'.$tid.'"
                </script>';
	}
	public function delete_comment($cid, $tid, $owner = 0)
	{
		$this->load->model('manage_task_m');
		$this->manage_task_m->del_comment($cid);
		echo '<script type="text/javascript">
                window.location.href = "/index.php/manage_task/manage/'.$tid.'"
                </script>';
	}
	public function share_task($tid, $owner = 0)
	{
		$email = $this->input->post('email');
		$this->load->model('manage_task_m');
		$this->manage_task_m->share($tid, $email);
		echo '<script type="text/javascript">
                window.location.href = "/index.php/manage_task/manage/'.$tid.'"
                </script>';
	}
}
?>