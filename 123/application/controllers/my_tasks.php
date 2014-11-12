<?php
//error_reporting(0);
class my_tasks extends CI_Controller 
{
 
	public function index()
	{
        if ($this->session->userdata('logged_in') != 'yes')
            echo '<script type="text/javascript">
                window.location.href = "/project/123/index.php"
                </script>';
		$this->load->model('my_tasks_m');
		$data['resault'] = $this->my_tasks_m->get_utasks($this->session->userdata('email'));
		for ($i = 0; $i < count($data['resault']); $i++)
			$data['owner'][$i] = $this->my_tasks_m->check_userowner($data['resault'][$i]['idTask']);
		$data['title'] = 'Список задач';
		$data['subtasks'] = $this->my_tasks_m->get_allsubtasks();
        $this->load->view('my_tasks_v', $data);
	}
	public function new_task()
	{
		$arr= array(
                    'name' => $this->input->post('name',TRUE),
                    'endTime' => $this->input->post('endDate'),
	                'taskTime' => $this->input->post('time'),
	                'theStartTime' => date("Y-m-d H:i"),
	                'done' => 0,
	                'progress' => 0,
	                'level' => 0
             );
		$arr['progress'] = $arr['taskTime'];
		// Проверка формы на валидацию.
	    $this->form_validation->set_rules('name', 'Название задачи', 'trim|required|xss_clean ');
 
	    if ($this->form_validation->run() == FALSE)
	    {
		//  Если форма не прошла валидацию, отсылаем пользователя заполнять ее заново
	        $data['title']='Данные не корректны';
		    $this->load->model('my_tasks_m');
			$data['resault'] = $this->my_tasks_m->get_utasks($this->session->userdata('email'));
		    $this->load->view('my_tasks_v', $data);
	    }
	    else
	    {
			$this->load->model('my_tasks_m');
			$this->my_tasks_m->insert_task($arr);
			echo '<script type="text/javascript">
                window.location.href = "/project/123/index.php/my_tasks"
                </script>';
		}
	}
	public function delete($id)
	{
		$this->load->model('my_tasks_m');
		$this->my_tasks_m->del_task($id);
		echo '<script type="text/javascript">
                window.location.href = "/project/123/index.php/my_tasks"
                </script>';
	}
	public function done($id)
	{
		$this->load->model('my_tasks_m');
		$this->my_tasks_m->done($id);
		echo '<script type="text/javascript">
                window.location.href = "/project/123/index.php/my_tasks"
                </script>';
	}
	public function create($tid)
	{
		$this->load->model('my_tasks_m');
		$this->my_tasks_m->create($tid);
		echo '<script type="text/javascript">
                window.location.href = "/project/123/index.php/my_tasks"
                </script>';
	}
	public function remove($tid)
	{
		$this->load->model('my_tasks_m');
		$this->my_tasks_m->remove($tid);
		echo '<script type="text/javascript">
                window.location.href = "/project/123/index.php/my_tasks"
                </script>';
	}
}
?>