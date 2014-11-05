<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title></title>
        <link rel="stylesheet" href="/application/assets/css/bootstrap.css">
        <link rel="stylesheet" href="/application/assets/css/bootstrap-docs.css">
        <link rel="stylesheet" href="/application/assets/css/style.css">
    </head>
    <body>
        <div class="container auth">
            <h1 class="center">Менеджер Задач</h1>
            <div class="row">
                <h2 class="center">Список задач</h2>
                <div class="col-md-6 col-md-offset-3">
                   <a href="http://188.134.19.176:8001/index.php" class="btn btn-default">На главную</a>
                   <?php
                   //echo $owner[0].$owner[1].$owner[2];
                        if (isset($resault[0]['name'])) { ?>
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
                        $i = -1;
                        foreach ($resault as $row)
                        { 
                          $i++;
                              if ($row['done'] == 0) 
                              {
                                  if ($owner[$i] == 1)
                                  { ?>
                            <tr>
                                <td><?php echo $row['name']; ?> <br> <p align="center"><?php  if (isset($subtasks[$i + 1]['name'])) echo $subtasks[$i + 1]['name']; ?></p></td>
                                <td><?php echo $row['endTime']; ?></td>
                                <td><?php echo $row['progress']; if (isset($row['progress'])) echo 'ч.'; ?></td>
                                <td> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"http://188.134.19.176:8001/index.php/my_tasks/done/".$row['idTask']."\" value='Завершить' onclick = 'location.href=\"http://188.134.19.176:8001/index.php/my_tasks/done/".$row['idTask']."\"'>" ?></td>
                                <td> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"http://188.134.19.176:8001/index.php/manage_task/manage/".$row['idTask']."\" value='Изменить' onclick = 'location.href=\"http://188.134.19.176:8001/index.php/manage_task/manage/".$row['idTask']."\"'>" ?></td>
                                <td> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"http://188.134.19.176:8001/index.php/my_tasks/delete/".$row['idTask']."\" value='Удалить' onclick = 'location.href=\"http://188.134.19.176:8001/index.php/my_tasks/delete/".$row['idTask']."\"'>" ?></td>
                           </tr>
                        <?php }
                            else {?>
                               <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['endTime']; ?></td>
                                <td><?php echo $row['progress']; if (isset($row['progress'])) echo 'ч.'; ?></td>
                                <td> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"http://188.134.19.176:8001/index.php/manage_task/manage/".$row['idTask']."\" value='Просмотр' onclick = 'location.href=\"http://188.134.19.176:8001/index.php/manage_task/manage/".$row['idTask']."\"'>" ?> </td>
                                <td><?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"http://188.134.19.176:8001/index.php/my_tasks/remove/".$row['idTask']."\" value='Отказаться' onclick = 'location.href=\"http://188.134.19.176:8001/index.php/my_tasks/remove/".$row['idTask']."\"'>" ?></td>
                                <td></td>
                               </tr>
                          <?php } 
                        }
                        } ?>
                         </tbody>
                    </table>
                    <h3 class="center">Выполненные задачи</h3>
                    <table class="table table-hover">
                        <thead>
                            <td><b>Название</b></td>
                            <td><b>Дата окончания</b></td>
                            <td></td>
                        </thead>
                        <tbody>
                  <?php
                        foreach ($resault as $row)
                        { 
                              if ($row['done'] == 1)
                              { ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['endTime']; ?></td>
                                <td width="12%"> <?php echo "<input type='submit' class='btn btn-danger btn-xs' formaction = \"http://188.134.19.176:8001/index.php/my_tasks/delete/".$row['idTask']."\" value='Удалить' onclick = 'location.href=\"http://188.134.19.176:8001/index.php/my_tasks/delete/".$row['idTask']."\"'>" ?></td>
                           </tr>
                        <?php }
                        }
                        
                        ?>

                       </tbody>
                    </table>
                    <?php }
                    else echo '<br><br>'; ?>
                       <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#newTask">
  Создать задачу
</button>
                </div>
            </div>
        </div> 
        <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Новая задача</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method = 'post' action = 'http://188.134.19.176:8001/index.php/my_tasks/new_task'>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary">Создать</button>
      </div>-->
    </div>
  </div>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="/application/assets/js/bootstrap.js"></script>    
    </body>
</html>