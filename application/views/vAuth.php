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
                <h2 class="center">Авторизация</h2>
                <div style="margin-bottom: 20px; align='center'">
                    <?php 
                        if (isset($error))
                            echo $error; 
                    ?>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <form class="form-horizontal" role="form"  method = "post" action = "http://188.134.19.176:8001/index.php/auth/auth_user">
                      <?php echo validation_errors(); ?>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Войти</button>
                            <a href="http://188.134.19.176:8001/index.php/reg" class="btn btn-info right">Регистрация</a>
                            <a href="http://188.134.19.176:8001/index.php" class="btn btn-default right">На главную</a>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>  
        <script type="text/javascript" src="/application/assets/js/bootstrap.js"></script>    
    </body>
</html>