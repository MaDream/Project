(function() {
    var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    window.requestAnimationFrame = requestAnimationFrame;
})();

function getRandom(min, max) {
    return Math.round(Math.random() * (max - min) + min);
}

var
  canvas = document.getElementById("game-canvas");
  context = canvas.getContext("2d");

  PLATFORM_STROKE_WIDTH = 2;
  PLATFORM_STROKE_STYLE = 'rgb(0,0,0)';

  GROUND_HEIGHT = 40;

  TRACK_COUNT = getRandom(11, 16);

  SCORE = 0;

  countJ = 0;

gameGS = {
    background: new Image(),
    texture1 : new Image(),
    bl1_img: new Image(),
    bl2_img: new Image(),
    bl3_img: new Image(),
    bl4_img: new Image(),
    bl5_img: new Image()
};
enemy = {
    en1_img: new Image(),
    en1_hp: 3,
    en1_dmg: 1,
    en1_spd: 3,
    en2_img: new Image(),
    en2_hp: 4,
    en2_dmg: 2,
    en2_spd: 2
};
player = {
    pl_img: new Image(),
    plr_img : new Image(),
    of : 0,
    x: 0,
    y: 0,
    save_y : 0,
    hp : 5,
    fire : new Image(),
    firer : new Image(),
    speed: 4,
    right : true,
    air : true,
    velX : 0,
    velY : 0
};
platformData =
    {
        baseline: 0,
        left: 0,
        width: 0,
        height: 0,
        fillStyle: 'rgb(255,255,0)',
        opacity: 0.5,
        pulsate: false
    };
keys = [];
friction = 0.8;
gravity = 3;
blockX = false;

function initializeImages() 
{
   gameGS.background.src = 'pic/background1.png';
   player.pl_img.src = 'pic/person.png';
   player.plr_img.src = 'pic/personr.png';
   gameGS.texture1.src = 'pic/texture1.png';
   player.fire.src = 'pic/wep1.png';
   player.firer.src = 'pic/wep1r.png';

   gameGS.background.onload = function (e) {
      startGame();
   };
}

function drawBackground() 
{
   context.drawImage(gameGS.background, 0, 0);
}

function drawPlatforms() 
{
   var pd;

   context.save(); // Сохранение атрибутов контекста в стеке

    //PLATFORM_DATA to randomize
    /*left: 0,
    width: 0,
    height: 0
    baseline*/

   for (var i = 0; i < TRACK_COUNT; ++i) {
      pd = platformData;

      pd.left = getRandom(5, 400);
      pd.width = getRandom(33, 101);
      pd.height = getRandom(5, 26);
      pd.baseline = getRandom(10, 180);

      context.lineWidth = PLATFORM_STROKE_WIDTH;
      context.strokeStyle = PLATFORM_STROKE_STYLE;
      context.fillStyle = pd.fillStyle;
      context.globalAlpha = pd.opacity;

      context.strokeRect(pd.left, pd.baseline, pd.width, pd.height);
      context.fillRect  (pd.left, pd.baseline, pd.width, pd.height);
   }
    for (var y = 425; y < 500; y += 37)
        for (var x = 0; x < 1000; x += 37)
            context.drawImage(gameGS.texture1, x, y)
   context.restore(); // Восстановление атрибутов контекста
}

function drawPlayer(pl_pos)
{
  if (pl_pos)
      context.drawImage(player.pl_img, player.x, player.y);
    else
      context.drawImage(player.plr_img, player.x, player.y);
}

function draw(pl_pos, en_fire)
{
   drawBackground();
   drawPlatforms();
   drawPlayer(pl_pos);
   if (en_fire == 1)
      context.drawImage(player.fire, player.x + 15, player.y);
   else if (en_fire == 2)
      context.drawImage(player.firer, player.x - 40, player.y);
}

function startGame() 
{
   draw(pl_pos, 0);
}
function addScore (bonus_type)
{
  if (bonus_type == 'second')
    SCORE += 1;
  else if (bonus_type == 'kill_t1')
    SCORE += 500;
  else if (bonus_type == 'kill_t2')
    SCORE += 1000;
  else if (bonus_type == 'kill_t3')
    SCORE += 2000;
  else if (bonus_type == 'kill_t4')
    SCORE += 4000;
  else if (bonus_type == 'kill_t5')
    SCORE += 8000;
  else if (bonus_type == 'kill_boss')
    SCORE += 50000;
  else if (bonus_type == 'bonus_t1')
    SCORE += 500;
  else if (bonus_type == 'bonus_t2')
    SCORE += 1000;
  else if (bonus_type == 'bonus_t3')
    SCORE += 2000;
}
function addA()
{
  player.y -= 5;
  draw (player.right, player.of);
}
function addY(peak)
{
  while (player.y >= peak) 
    addA();
}
function platform()
{
  var pd, top;
   for (var i = 0; i < platformData.length; ++i) 
    {
      pd = platformData[i];
      top = calculatePlatformTop(pd.track);
      if ( (player.y + 15 == top || player.y + 16 == top || player.y + 17 == top)
        && (player.x >= pd.left && player.x <= (pd.left + pd.width)))
        return 1;
    }
    return 0;
}



function update()
{
  initializeImages();
  /*if (keys[38] || keys[32]) 
    {
      if(!player.air)
      {
        player.air = true;
        var pd, top;
        for (var i = 0; i < platformData.length; ++i) 
        {
            pd = platformData[i];
            top = calculatePlatformTop(pd.track);
            for (var j = 0; j < 150; j++)
            {
              if (! (player.y == top && player.x < pd.left + pd.width && player.x > pd.left))
              {
                player.y++;
                draw(player.right, player.of);
              }
            }
        }
            //player.y += player.velY;
        
        //draw(player.right, player.of);
      }
    }*/
  if (keys[38] || keys[32]) 
    {
      if(!player.air)
      {
        player.air = true;
        addY(player.y - 150);
        draw(player.right, player.of);
      }
    }
  if (player.y < 410)
  {
   // if (!platform) 
    {

      player.air = true;
      player.y += gravity;
      draw(player.right, player.of);
      player.velY = 0;
    }
  }
  else 
  {
    countJ = 0;
	  player.air = false;
  }

  //player.velX *= friction;
  //player.x += player.velX;
    if (keys[39]) 
    {
        // right arrow
        player.right = true;
         var c1 = 0;
         if (player.x < 985)
         {
     	  player.x += 2 + c1;
	      draw(player.right, player.of);      
	       if (c1 < player.speed * 8)
		        c1++;  
         }
    }     
    if (keys[37]) 
    {         
        // left arrow   
         player.right = false;
	       var c2 = 0;
         if (player.x > 0)
         {      
     	  player.x -= 2 + c2;
	      draw(player.right, player.of);     
	if (c2 < player.speed * 8)
		c2++;     
          }
    }
    
    if (keys[70])
    // 'f'
    {
    if (player.right)
      player.of = 1;
    else
      player.of = 2;
    draw(player.right, player.of);
    setInterval('player.of = 0', 1);
    }

  draw(player.right, player.of);
  //setTimeout ('addScore("second")', 1000);
  setInterval('addScore("second")', 2500);
  requestAnimationFrame(update);
  context.save();
  context.textBaseline = 'center';
  context.fillStyle = "#FFF";
  context.font = "italic 30pt Arial";
  context.fillText(SCORE, 770, 32);
  context.restore();
}


document.body.addEventListener("keydown", function(e) {
    keys[e.keyCode] = true;
});
 
document.body.addEventListener("keyup", function(e) {
    keys[e.keyCode] = false;
});
 
window.addEventListener("load",function(){
    update();
});