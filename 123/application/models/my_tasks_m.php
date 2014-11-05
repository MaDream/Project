<?php
 
class my_tasks_m extends CI_Model 
{
 
    /**
     * Функция добавляет данные в таблицу
     */
    public function get_utasks($user)
    {
        $this->db->where('email', $user);
        $query_check_user = $this->db->get('user');
        $userdata = $query_check_user->result_array();
        $uid = $userdata[0]['id_user'];
        $query = $this->db->query   ('SELECT task.idTask, name, endTime, progress, done
            FROM task, taskuser 
            WHERE idUser ='.$uid.' AND taskuser.idtask = task.idtask AND parenttask IS NULL');
        return $query->result_array();
    }
    public function insert_task($data)
    {
        //Тут бы проверить сгенерированный айди на уникальность...
        $this->db->insert('task', $data);
        $query = $this->db->query   ('SELECT idTask FROM task ORDER BY idTask DESC LIMIT 1');
        $res = $query->result_array();
        $arr= array(
                    'idUser' => $this->session->userdata('uid'),
                    'idTask' => $res[0]['idTask'],
                    'owner' => 1,
        );
        $this->db->insert('taskuser', $arr);
    }
    public function del_task($id)
    {
        $this->db->query('DELETE FROM task WHERE idTask = '.$id);
        $this->db->query('DELETE FROM taskuser WHERE idTask = '.$id);
        $query = $this->db->query('SELECT idTask FROM task WHERE parentTask = '.$id);
        $res = $query->result_array();
        if (isset($res))
        {
            for ($i = 0; $i < count($res); $i++)
                if (isset($res[$i]['idTask']))
                        $this->db->query('DELETE FROM task WHERE idTask = '.$res[$i]['idTask']);
        }
    }
    public function done($tid)
    {
        $this->db->query('UPDATE task SET done = 1 WHERE idTask ='.$tid);
    }
    public function check_userowner($tid)
    {
        $q = $this->db->query('SELECT owner FROM taskuser WHERE idtask ='.$tid.' AND iduser ='.$this->session->userdata('uid'));
        $res = $q->result_array();
        return $res[0]['owner'];
    }
    public function create($tid)
    {
        $query = $this->db->query('SELECT * FROM task WHERE idTask = '.$tid);
        $res = $query->result_array();
        if (isset($res))
        {
            $task_data = array (
                    'name' => $res[0]['name'],
                    'endTime' => $res[0]['endTime'],
                    'taskTime' => $res[0]['taskTime'],
                    'theStartTime' => $res[0]['theStartTime'],
                    'done' => $res[0]['done'],
                    'progress' => $res[0]['progress'],
                    'output' => $res[0]['output'],
                    'parentTask' => $res[0]['parentTask'],
                    'specification' => $res[0]['specification']
                );
            $this->db->insert('task', $task_data);
            $query = $this->db->query('SELECT idTask FROM task ORDER BY idTask DESC LIMIT 1');
            $res = $query->result_array();
            $arr= array(
                    'idUser' => $this->session->userdata('uid'),
                    'idTask' => $res[0]['idTask'],
                    'owner' => 1,
            );
            $this->db->insert('taskuser', $arr);
            $query = $this->db->query('SELECT * FROM task WHERE parentTask = '.$tid);
            $res = $query->result_array();
            for ($i1 = 0; $i1 < count($res); $i1++) 
            {
                 $subtask_data[$i1] = array (
                    'name' => $res[$i1]['name'],
                    'endTime' => $res[$i1]['endTime'],
                    'taskTime' => $res[$i1]['taskTime'],
                    'theStartTime' => $res[$i1]['theStartTime'],
                    'done' => $res[$i1]['done'],
                    'progress' => $res[$i1]['progress'],
                    'output' => $res[$i1]['output'],
                    'parentTask' => $arr['idTask'],
                    'specification' => $res[$i1]['specification']
                );
                $this->db->insert('task', $subtask_data[$i1]);
                $q1 = $this->db->query('SELECT idTask FROM task ORDER BY idTask DESC LIMIT 1');
                $r1 = $q1->result_array();
                $arr['idTask'] = $r1[0]['idTask'];
                $subquery = $this->db->query('SELECT * FROM task WHERE parentTask = '.$res[$i1]['idTask']);
                $subres = $subquery->result_array();
                if (isset ($subres[0]['idTask']))
                {
                    for ($i2 = 0; $i2 < count($res); $i2++) 
                    {
                         $subtask_data[$i2] = array (
                            'name' => $res[$i2]['name'],
                            'endTime' => $res[$i2]['endTime'],
                            'taskTime' => $res[$i2]['taskTime'],
                            'theStartTime' => $res[$i2]['theStartTime'],
                            'done' => $res[$i2]['done'],
                            'progress' => $res[$i2]['progress'],
                            'output' => $res[$i2]['output'],
                            'parentTask' => $arr['idTask'],
                            'specification' => $res[$i2]['specification']
                        );
                        $this->db->insert('task', $subtask_data[$i2]);
                        $q2 = $this->db->query('SELECT idTask FROM task ORDER BY idTask DESC LIMIT 1');
                        $r2 = $q2->result_array();
                        $arr['idTask'] = $r2[0]['idTask'];
                        $subquery = $this->db->query('SELECT * FROM task WHERE parentTask = '.$res[$i2]['idTask']);
                        $subres = $subquery->result_array();
                        if (isset ($subres[0]['idTask']))
                        {
                            for ($i3 = 0; $i3 < count($res); $i3++) 
                            {
                                $subtask_data[$i3] = array (
                                    'name' => $res[$i3]['name'],
                                    'endTime' => $res[$i3]['endTime'],
                                    'taskTime' => $res[$i3]['taskTime'],
                                    'theStartTime' => $res[$i3]['theStartTime'],
                                    'done' => $res[$i3]['done'],
                                    'progress' => $res[$i3]['progress'],
                                    'output' => $res[$i3]['output'],
                                    'parentTask' => $arr['idTask'],
                                    'specification' => $res[$i3]['specification']
                                );
                                $this->db->insert('task', $subtask_data[$i3]);
                                 $q3 = $this->db->query('SELECT idTask FROM task ORDER BY idTask DESC LIMIT 1');
                                $r3 = $q3->result_array();
                                $arr['idTask'] = $r3[0]['idTask'];
                                $subquery = $this->db->query('SELECT * FROM task WHERE parentTask = '.$res[$i3]['idTask']);
                                $subres = $subquery->result_array();
                                if (isset ($subres[0]['idTask']))
                                {
                                    for ($i4 = 0; $i4 < count($res); $i4++) 
                                    {
                                         $subtask_data[$i4] = array (
                                            'name' => $res[$i4]['name'],
                                            'endTime' => $res[$i4]['endTime'],
                                            'taskTime' => $res[$i4]['taskTime'],
                                            'theStartTime' => $res[$i4]['theStartTime'],
                                            'done' => $res[$i4]['done'],
                                            'progress' => $res[$i4]['progress'],
                                            'output' => $res[$i4]['output'],
                                            'parentTask' => $arr['idTask'],
                                            'specification' => $res[$i4]['specification']
                                        );
                                        $this->db->insert('task', $subtask_data[$i4]);
                                         $q4 = $this->db->query('SELECT idTask FROM task ORDER BY idTask DESC LIMIT 1');
                                        $r4 = $q4->result_array();
                                        $arr['idTask'] = $r4[0]['idTask'];
                                        $subquery = $this->db->query('SELECT * FROM task WHERE parentTask = '.$res[$i4]['idTask']);
                                        $subres = $subquery->result_array();
                                        if (isset ($subres[0]['idTask']))
                                        {
                                            for ($i5 = 0; $i5 < count($res); $i5++) 
                                            {
                                                 $subtask_data[$i5] = array (
                                                    'name' => $res[$i5]['name'],
                                                    'endTime' => $res[$i5]['endTime'],
                                                    'taskTime' => $res[$i5]['taskTime'],
                                                    'theStartTime' => $res[$i5]['theStartTime'],
                                                    'done' => $res[$i5]['done'],
                                                    'progress' => $res[$i5]['progress'],
                                                    'output' => $res[$i5]['output'],
                                                    'parentTask' => $arr['idTask'],
                                                    'specification' => $res[$i5]['specification']
                                                );
                                                $this->db->insert('task', $subtask_data[$i5]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }   
            }
        }
        $this->db->query('DELETE FROM taskuser WHERE idtask = '.$tid.' AND iduser = '.$this->session->userdata('uid'));
    }
    public function remove($tid)
    {
        $this->db->query('DELETE FROM taskuser WHERE idTask = '.$tid.' AND idUser = '.$this->session->userdata('uid'));
    }
    public function get_allsubtasks()
    {
        $query = $this->db->query('SELECT name FROM task, taskuser, user WHERE parentTask != NULL AND task.idTask = taskuser.idTask AND taskuser.idUser = user.id_user AND idUser = '.$this->session->userdata('uid'));
        return $query->result_array();
    }
}

?>