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
                <div class="col-md-6 col-md-offset-3">
                	<div class="index-btn">
                   		<? echo 'Здравствуйте, '.$this->session->userdata('nickname').'. <a href = "/project/123/index.php/uexit" style = "text-align: center;"> Выход </a>' ; ?>
                   		<br>
                        <a href = "/project/game/unleashedchallenge.php" style = "text-align: center;"> Игра "Unleashed Challenge" </a>                		
                	</div>
                	<br>
                	<p align = 'center'><a href="/project/123/index.php/My_tasks" class="btn btn-default right">Мои заметки</a></p>
                </div>
            </div>
        </div>  
        <script type="text/javascript" src="/project/123/application/assets/js/bootstrap.js"></script>    
    </body>
</html>