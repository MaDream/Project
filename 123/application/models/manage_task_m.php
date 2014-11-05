
<?php

class manage_task_m extends CI_Model 
{
 
    /**
     * Функция добавляет данные в таблицу
     */
    public function get_task_data($tid)
    {
        $this->db->where('idTask', $tid);
        $query = $this->db->get('task');
        return $query->result_array();
    }
    public function get_subtasks($tid)
    {
    	$this->db->where('parentTask', $tid);
    	$query = $this->db->get('task');
    	return $query->result_array();
    }
    public function check_userowner($tid)
    {
        $q = $this->db->query('SELECT owner FROM taskuser WHERE idtask ='.$tid.' AND iduser ='.$this->session->userdata('uid'));
        $res = $q->result_array();
        return $res[0]['owner'];
    }
    public function get_comments($tid)
    {
    	$query = $this->db->query('SELECT comment.idUser, idcomment, email, commentary FROM user, comment WHERE comment.idUser = user.id_user AND comment.idTask = '.$tid);
    	return $query->result_array();
    }
    public function update_task($data, $tid)
    {
    	$this->db->set('name', $data['name']);
    	$this->db->set('specification', $data['specification']);
    	$this->db->set('endTime', $data['endTime']);
    	$this->db->set('taskTime', $data['taskTime']);
    	$this->db->set('output', $data['output']);
    	$this->db->where('idTask', $tid);
        $this->db->update('task', $data);
    }
    public function insert_subtask($data)
    {
        $this->db->insert('task', $data);
    }
    public function insert_comment($data)
    {
    	$this->db->insert('comment', $data);
    }
    public function del_comment($cid)
    {
    	$this->db->query('DELETE FROM comment WHERE idcomment = '.$cid);
    }
    public function share($tid, $email)
    {
    	$this->db->where('email', $email);
    	$q = $this->db->get('user');
    	$id = $q->result_array();
    	$arr= array(
                    'idUser' => $id[0]['id_user'],
                    'idTask' => $tid,
                    'owner' => 0,
        );
    	$this->db->insert('taskuser', $arr);
    }
    public function get_parentlevel($tid)
    {
        $query = $this->db->query('SELECT level FROM task WHERE idTask = '.$tid);
        $res = $query->result_array();
        return $res[0]['level'];
    }
}

?>