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
        <div class="container auth">
            <h1 class="center">Менеджер Контента</h1>
            <div class="row">
                <h2 class="center">Регистрация</h2>
                <?php 
                  if (isset($error))
                    echo $error;
                ?>
                <div class="col-md-6 col-md-offset-3">
                    <form class="form-horizontal" role="form" method = "post" action = "/project/123/index.php/reg/reg_user">
                      <?php echo validation_errors(); ?>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name = "email" placeholder="Email" required>
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Никнейм</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name = "nickname"  placeholder="Login" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Повторите пароль</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="passwordc" placeholder="Password" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Зарегистрироваться</button>
                              <a href="auth" class="btn btn-info right">Авторизация</a>
                              <a href="/project/123/index.php" class="btn btn-default right">На главную</a>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>  
        <script type="text/javascript" src="/project/123/application/assets/js/bootstrap.js"></script>    
    </body>
</html>