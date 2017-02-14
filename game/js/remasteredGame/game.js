/**
 * Created by dev on 2/14/17.
 */

import './functions'

(function() {
    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = window.mozRequestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.msRequestAnimationFrame;
})();

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
     drawDynamic(player.right, player.of);
     }
     }
     }
     //player.y += player.velY;

     //drawDynamic(player.right, player.of);
     }
     }*/
    if (keys[38] || keys[32])
    {
        if(!player.air)
        {
            player.air = true;
            addY(player.y - 150);
            drawDynamic(player.right, player.of);
        }
    }
    if (player.y < 410)
    {
        // if (!platform) 
        {

            player.air = true;
            player.y += gravity;
            drawDynamic(player.right, player.of);
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
            drawDynamic(player.right, player.of);
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
            drawDynamic(player.right, player.of);
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
        drawDynamic(player.right, player.of);
        setInterval('player.of = 0', 1);
    }

    drawDynamic(player.right, player.of);
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