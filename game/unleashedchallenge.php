<?php
    // I'm not sure but as I remember here should be the link to
    // highscore table loaded from MySQL but this is not the final version
    // Well, it was my first git-project
    // and I was developing (more likely monkey coding T.T) solo
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<style>
    		@import"css/Game.css";
  		</style>
	</head>
	<body>
		<div id = "head">
			<font color = "#ffffff">Unleashed Challenge</font>
		</div>
		<div id = "glob">
				<a href = "/project/123/index.php" style = "text-align: center;"> ��������� </a> 
				<canvas id='game-canvas' width='1000' height='500' style= "background-color: #ffffff">
					Your browser doesn't support HTML5 Canvas.
				</canvas>
				<script src="js/legacyGame.js"></script>
		</div>
		<style>
			body 
			{
				background-color: #483D8B;
			}
		</style>
	</body>
</html>