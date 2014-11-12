(function() {
    var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    window.requestAnimationFrame = requestAnimationFrame;
})();
 
var canvas = document.getElementById("game-canvas"),
    ctx = canvas.getContext("2d"),
    background  = new Image(),
    width = 1220,
    height = 360,
    player = {
      x : width/2,
      y : height - 100,
      width : 25,
      height : 25,
      speed: 3,
      velX: 0,
      velY: 0,
      jumping: false
    },
    blocks = {
      x : width/3,
      y : height - 240,
      width : 200,
      height : 200,
    },
    arr = [ {
      x : 100,
      y : height-100,
      width : 50,
      height : 50,
    },
    {
      x : 0,
      y : height - 140,
      width : 100,
      height : 100,
    },{
      x : 20,
      y : height-20,
      width : 50,
      height : 50,
    },{
      x : 720,
      y : 200,
      width : 50,
      height : 50,
    },{
      x : 80,
      y : 30,
      width : 50,
      height : 50,
    }
    ],
    keys = [],
    friction = 0.8,
    gravity = 0.3,
    blockX = false;
 
canvas.width = width;
canvas.height = height;
 
function update(){
  background.src = 'pic/background1.png';
  background.onload = function (e) {
      context.drawImage(background, 0, 0);
  };
  
  //context.save();
  
  //context.restore();
  // check keys
    if (keys[38] || keys[32]) {
        // up arrow or space
      if(!player.jumping){
       player.jumping = true;
       player.velY = -player.speed * 2.5;
      }
    }
    if (keys[39] && blockX == false) {
        // right arrow
        if (player.velX < player.speed) {             
            player.velX++;         
         }     
    }     
    if (keys[37] && blockX == false) {         
        // left arrow         
        if (player.velX > -player.speed) {
            player.velX--;
        }
    }
 
    player.velX *= friction;
 
    player.velY += gravity;
 
    player.x += player.velX;
    
    player.y += player.velY;

    if (player.x >= width-player.width) {
        player.x = width-player.width;
    } else if (player.x <= 0) {         
        player.x = 0;     
    }    
    if(player.y >= height - player.height){
        player.y = height - player.height;
        player.jumping = false;
    }
    else    
      if (player.x == blocks.x-player.width ) {
        player.x = blocks.x-player.width;
        player.velX = 0;
    } else if (player.x == blocks.x + blocks.width) {         
        player.x = blocks.x + blocks.width;   
        player.velX = 0;  
    } 
    else if(player.x+player.width >= blocks.x && player.x <= blocks.x+blocks.width){
      if(player.y >= blocks.y - player.height && player.y < blocks.y){
        player.y = blocks.y - player.height;
        player.jumping = false;
        player.velY = 0;
        }
        else      if(player.y <= blocks.y + blocks.height && player.y > blocks.y + blocks.height-player.width){
          player.y = blocks.y + blocks.height;
          player.jumping = true;
        }
        if(player.y> blocks.y - player.height && player.y < blocks.y + blocks.height){
          player.velX = 0;
          blockX = true;
        }
        else blockX = false;
    }
    for(var i=0; i<arr.length;i++){
      if(player.x+player.width >= arr[i].x && player.x <= arr[i].x+arr[i].width){
      if(player.y >= arr[i].y - player.height && player.y < arr[i].y){
        player.y = arr[i].y - player.height;
        player.jumping = false;
        player.velY = 0;
        }
        else      if(player.y <= arr[i].y + arr[i].height && player.y > arr[i].y + arr[i].height-player.width){
          player.y = arr[i].y + arr[i].height;
          player.jumping = true;
        }
        if(player.y> arr[i].y - player.height && player.y < arr[i].y + arr[i].height){
          player.velX = 0;
          blockX = true;
        }
        else blockX = false;
    }
    }
/*    if(player.x >= 100 && player.x <= 120 && player.y <= 330 && player.y > 200){
      player.velX = 0;
      blockX = true;
    }
    else blockX = false;*/
  ctx.clearRect(0,0,width,height);
  ctx.fillStyle = "black";
  for(var i=0; i<arr.length;i++)
  ctx.fillRect(arr[i].x,arr[i].y,arr[i].width,arr[i].height);
  ctx.fillStyle = "red";
  ctx.fillRect(player.x, player.y, player.width, player.height);
  ctx.fillRect(blocks.x, blocks.y, blocks.width, blocks.height);
  /*ctx.fillStyle = "green";
  ctx.fillRect(arr[0].x,arr[0].y,arr[0].width,arr[0].height);
  ctx.fillStyle = "black";
  ctx.fillRect(arr[1].x,arr[1].y,arr[1].width,arr[1].height);*/
  requestAnimationFrame(update);
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