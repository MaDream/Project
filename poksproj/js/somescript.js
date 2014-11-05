(function() {
    var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    window.requestAnimationFrame = requestAnimationFrame;
})();

var canvas = document.getElementById('game-canvas'),
    context = canvas.getContext('2d'),

PLATFORM_HEIGHT = 8,  
   PLATFORM_STROKE_WIDTH = 2,
   PLATFORM_STROKE_STYLE = 'rgb(0,0,0)',

   STARTING_PERSON_LEFT = 50,
   STARTING_PERSON_TRACK = 1,

  background  = new Image(),

    TRACK_1_BASELINE = 323,
    TRACK_2_BASELINE = 223,
    TRACK_3_BASELINE = 123,

personData = 
  {
    personImage: ,
    opacity: 1.0,
    person_x: STARTING_PERSON_LEFT,
    person_y: calculatePlatformTop(STARTING_PERSON_TRACK) - personImage.height,
    person_wep: 1;
  };

personData.personImage = new Image();

platformData = [ 
      // Экран 1.......................................................
      {
         left:      10,
         width:     230,
         height:    PLATFORM_HEIGHT,
         fillStyle: 'rgb(255,255,0)',
         opacity:   0.5,
         track:     1,
         pulsate:   false,
      },

      {  left:      250,
         width:     100,
         height:    PLATFORM_HEIGHT,
         fillStyle: 'rgb(150,190,255)',
         opacity:   1.0,
         track:     2,
         pulsate:   false,
      },

      {  left:      400,
         width:     125,
         height:    PLATFORM_HEIGHT,
         fillStyle: 'rgb(250,0,0)',
         opacity:   1.0,
         track:     3,
         pulsate:   false
      },

      {  left:      633,
         width:     100,
         height:    PLATFORM_HEIGHT,
         fillStyle: 'rgb(255,255,0)',
         opacity:   1.0,
         track:     1,
         pulsate:   false,
      },
   ];

// ------------------------- ИНИЦИАЛИЗАЦИЯ ----------------------------

function initializeImages() {
   background.src = 'pic/background1.png';
   personData.personImage.src = 'pic/person.png';

   background.onload = function (e) {
      startGame(STARTING_PERSON_LEFT);
   };
}

function drawBackground() {
   context.drawImage(background, 0, 0);
}

function calculatePlatformTop(track) {
   var top;

   if      (track === 1) { top = TRACK_1_BASELINE; }
   else if (track === 2) { top = TRACK_2_BASELINE; }
   else if (track === 3) { top = TRACK_3_BASELINE; }

   return top;
}

function drawPlatforms() {
   var pd, top;

   context.save(); // Сохранение атрибутов контекста в стеке

   for (var i = 0; i < platformData.length; ++i) {
      pd = platformData[i];
      top = calculatePlatformTop(pd.track);

      context.lineWidth = PLATFORM_STROKE_WIDTH;
      context.strokeStyle = PLATFORM_STROKE_STYLE;
      context.fillStyle = pd.fillStyle;
      context.globalAlpha = pd.opacity;

      // Если изменить порядок следующих двух вызовов, то контур будет казаться толще.

      context.strokeRect(pd.left, top, pd.width, pd.height);
      context.fillRect  (pd.left, top, pd.width, pd.height);
   }

   context.restore(); // Восстановление атрибутов контекста
}

function drawPerson(coord_x) {
   context.drawImage(personImage,
      coord_x,
     );
}

function draw(coord_x) {
   drawBackground();
   drawPlatforms();
   drawPerson(coord_x);
}

function startGame(coord_x) {
   draw(coord_x);
}

// Запуск игры

initializeImages();

function pl_action (action)
{
  if (action == "m_right")
    return 1;
  
  else if (action == "m_left")
    return 2;
  
  else if (action == "m_up")
    return 3;
  
  else if (action == "fire")
    return 0;
}

function update(){
  gravity = 1;
  friction = 1;
  // keys
    if (keys[32]) 
    {
      // space
      pl_action("m_up");
    }
    
    if (keys[68]) 
    {
      // key 'd'
      pl_action("m_right");
    }     
    
    if (keys[65]) 
    {         
      // key 'a'         
      pl_action("m_left");
    }
  initializeImages();

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