<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title></title>
        <link rel="stylesheet" href="/project/123/application/assets/css/bootstrap.css">
        <link rel="stylesheet" href="/project/123/application/assets/css/bootstrap-docs.css">
        <link rel="stylesheet" href="/project/123/application/assets/css/style.css">
    </head>
    <body>
        <div class="container">
            <h1 class="center">Менеджер Контента</h1>
            <div class="row">
            <?php if (isset($error)) echo $error; ?>
                <div class="col-md-6 col-md-offset-3">
                    <div style="margin-bottom: 20px;">
                        <a href="/project/123/index.php" class="btn btn-default">На главную</a>
                        <a href="/project/123/index.php/my_tasks" class="btn btn-info">К списку заметок</a>
                    </div>
                    <?php if ($owner == 1) 
                    { 
                        ?>
                    <h3>Редактировать заметку </h3>
                    <?php foreach ($resault as $row) 
                    { ?>
                    <?php echo "<form class='form-horizontal' method = 'post' action = '/project/123/index.php/manage_task/mng/".$tid."/".$owner."'>"; ?>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Название</label>
                        <div class="col-sm-10">
                          <?php echo "<input type='text' class='form-control' value = ".$row['name']." name = 'name'>"; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Описание</label>
                        <div class="col-sm-10">
                            <?php echo '<textarea class="form-control" name = "specification">'.$row['specification'].'</textarea>'?>
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Дата создания</label>
                        <div class="col-sm-10">
                          <?php echo '<div class="alert alert-info center">'.$row['theStartTime'].'</div>'; ?>
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Дата окончания</label>
                        <div class="col-sm-10">
                          <?php echo "<input type='date' class='form-control' value = ".$row['endTime']." name = 'endTime'>"; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Редактировать</button>
                        </div>
                      </div>
                    </form>
              <?php }
                  }
                    else
                    { ?>
                         <h3>Просмотр заметки</h3>
                       <?php foreach ($resault as $row) 
                   {?>

                     
                                            <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Название</label>
                        <div class="col-sm-10">
                          <?php echo '<div class="alert alert-info center">'.$row['name'].'</div>'; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Описание</label>
                        <div class="col-sm-10">
                            <?php echo '<div class="alert alert-info center">'.$row['specification'].'</div>'; ?>
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Дата создания</label>
                        <div class="col-sm-10">
                          <?php echo '<div class="alert alert-info center">'.$row['theStartTime'].'</div>'; ?>
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Дата окончания</label>
                        <div class="col-sm-10">
                          <?php echo '<div class="alert alert-info center">'.$row['endTime'].'</div>'; ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Общее время</label>
                        <div class="col-sm-10">
                          <?php echo '<div class="alert alert-info center">'.$row['taskTime'].'ч.'.'</div>'; ?>
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Результат</label>
                        <div class="col-sm-10">
                           <?php echo '<div class="alert alert-info center">'.$row['output'].'</div>'; ?>
                        </div>
                      </div>
                         <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Оставшееся время</label>
                        <div class="col-sm-10">
                           <?php echo '<div class="alert alert-info center">'.$row['progress'].'ч.'.'</div>'; ?>
                        </div>
                      </div>
              <?php }
                  }
                  if (isset($comments[0]['email']))
                        echo '<h3>Коммертарии:</h3>';
              ?>

                    
                    <?php foreach ($comments as $row)
                    { ?>
                    <div class="row">
                        <div class="panel panel-default" style="width: 600px;">
                          <div class="panel-heading"> <?php echo $row['email'];  if($row['idUser'] == $this->session->userdata('uid')) echo "<button type='submit' class='btn btn-danger btn-xs'><i class='glyphicon glyphicon-remove' onclick = 'location.href=\"/project/123/index.php/manage_task/delete_comment/".$row['idcomment']."/".$tid."\"' /></i></button>";?> <!-- <small class="text-aligne: right">04.12.2014</small> --></div>
                          <div class="panel-body" >
                            <p><?php echo $row['commentary'];  ?></p>
                          </div>
                        </div>
                     <?php } ?>
                        <div class="panel panel-default">
                        <?php echo "<form class='form-horizontal' method = 'post' action = '/project/123/index.php/manage_task/new_comment/".$tid."'>"; ?>
                            <div class="form-group" >
                                <label for="inputPassword3" class="col-sm-2 control-label">Новый комментарий</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name = 'com'></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-success">Отправить</button>
                                </div>
                          </div>
                        </form>
                    </div>
                    
                                         <?php
                        if (isset($subtasks[0]['name'])) { ?>
                   <table class="table table-hover">
                        <thead>
                            <td><b>Название</b></td>
                            <td><b>Закончить</b></td>
                            <td><b>Осталось</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        foreach ($subtasks as $row)
                        {
                              if ($row['done'] == 0) 
                              {
                                  if ($owner == 1)
                                  { ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['endTime']; ?></td>
                                <td><?php echo $row['progress']; if (isset($row['progress'])) echo 'ч.'; ?></td>
                                <td> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"/project/123/index.php/my_tasks/done/".$row['idTask']."/".$owner."\" value='Завершить' onclick = 'location.href=\"/project/123/index.php/my_tasks/done/".$row['idTask']."\"'>" ?></td>
                                <td> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"/project/123/index.php/manage_task/manage/".$row['idTask']."/".$owner."\" value='Изменить' onclick = 'location.href=\"/project/123/index.php/manage_task/manage/".$row['idTask']."/".$owner."\"'>" ?></td>
                                <td> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"/project/123/index.php/my_tasks/delete/".$row['idTask']."/".$owner."\" value='Удалить' onclick = 'location.href=\"/project/123/index.php/my_tasks/delete/".$row['idTask']."\"'>" ?></td>
                           </tr>
                        <?php }
                            else {?>
                               <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['endTime']; ?></td>
                                <td><?php echo $row['progress']; if (isset($row['progress'])) echo 'ч.'; ?></td>
                                <td> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"/project/123/index.php/manage_task/manage/".$row['idTask']."/".$owner."\" value='Просмотр' onclick = 'location.href=\"/project/123/index.php/manage_task/manage/".$row['idTask']."\"'>" ?> </td>
                                <td></td>
                                <td></td>
                               </tr>
                          <?php } 
                        }
                        } ?>
                         </tbody>
                    </table>
                    <h3 class="center">Устаревшие заметки</h3>
                    <table class="table table-hover">
                        <thead>
                            <td><b>Название</b></td>
                            <td><b>Дата окончания</b></td>
                            <td></td>
                        </thead>
                        <tbody>
                  <?php
                        foreach ($subtasks as $row)
                        { 
                              if ($row['done'] == 1)
                              { ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['endTime']; ?></td>
                                <td width="12%"> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"/project/123/index.php/my_tasks/delete/".$row['idTask']."/".$owner."\" value='Удалить' onclick = 'location.href=\"/project/123/index.php/my_tasks/delete/".$row['idTask']."\"'>" ?></td>
                           </tr>
                        <?php }
                        }
                        
                        ?>

                       </tbody>
                    </table>
                    <?php } ?>
                    <?php if ($owner == 1) { ?>
                  <?php } ?>
                    <!--</div>-->
                    <?php if ($resault['level'] == 0)
                    { ?>
                    <h3>Поделиться</h3>
                    <?php echo "<form class='form-horizontal' method = 'post' action = '/project/123/index.php/manage_task/share_task/".$tid."/".$owner."'>"; ?>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name = 'email'>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-success">Предоставить</button>
                                </div>
                          </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>  
        
        <!-- Modal -->
<div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Новая заметка</h4>
      </div>
      <div class="modal-body">
        <?php echo "<form class='form-horizontal' method = 'post' action = '/project/123/index.php/manage_task/new_subtask/".$tid."/".$owner."'>"; ?>
                       <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label" >Название</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name = 'name'>
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label" >Дата окончания</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name = 'endDate'>
                        </div>
                      </div>
                         <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Время работы</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" name = 'time'><span>ч.</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Создать</button>
                        </div>
                      </div>
                    </form>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button> -->
      </div>
    </div>
  </div>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="/project/123/application/assets/js/bootstrap.js"></script>    
    </body>
</html>