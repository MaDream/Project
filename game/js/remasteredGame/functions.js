/**
 * Created by dev on 2/14/17.
 */

import './global_obj';

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
    staticContext.drawImage(gameGS.background, 0, 0);
}

function drawPlatforms()
{
    let pd;

    staticContext.save(); // Сохранение атрибутов контекста в стеке

    //PLATFORM_DATA to randomize
    /*left: 0,
     width: 0,
     height: 0
     baseline*/

    for (let i = 0; i < TRACK_COUNT; ++i) {
        pd = platformData;

        pd.left = getRandom(5, 400);
        pd.width = getRandom(33, 101);
        pd.height = getRandom(5, 26);
        pd.baseline = getRandom(100, 400);

        staticContext.lineWidth = PLATFORM_STROKE_WIDTH;
        staticContext.strokeStyle = PLATFORM_STROKE_STYLE;
        staticContext.fillStyle = pd.fillStyle;
        staticContext.globalAlpha = pd.opacity;

        staticContext.strokeRect(pd.left, pd.baseline, pd.width, pd.height);
        staticContext.fillRect  (pd.left, pd.baseline, pd.width, pd.height);
    }
    for (let y = 425; y < 500; y += 37)
        for (let x = 0; x < 1000; x += 37)
            staticContext.drawImage(gameGS.texture1, x, y)
    staticContext.restore(); // Восстановление атрибутов контекста
}

function drawPlayer(pl_pos)
{
    if (pl_pos)
        dynamicContext.drawImage(player.pl_img, player.x, player.y);
    else
        dynamicContext.drawImage(player.plr_img, player.x, player.y);
}

function drawStatic()
{
    drawBackground();
    drawPlatforms();
}

function drawDynamic(pl_pos, en_fire)
{
    drawPlayer(pl_pos);
    if (en_fire == 1)
        dynamicContext.drawImage(player.fire, player.x + 15, player.y);
    else if (en_fire == 2)
        dynamicContext.drawImage(player.firer, player.x - 40, player.y);
}

function startGame()
{
    drawStatic();
    drawDynamic(pl_pos, 0);
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
    drawDynamic(player.right, player.of);
}
function addY(peak)
{
    while (player.y >= peak)
        addA();
}
function platform()
{
    let pd, top;
    for (let i = 0; i < platformData.length; ++i)
    {
        pd = platformData[i];
        top = calculatePlatformTop(pd.track);
        if ( (player.y + 15 == top || player.y + 16 == top || player.y + 17 == top)
            && (player.x >= pd.left && player.x <= (pd.left + pd.width)))
            return 1;
    }
    return 0;
}