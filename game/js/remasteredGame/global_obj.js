/**
 * Created by dev on 2/14/17.
 */

function getRandom(min, max) {
    return Math.round(Math.random() * (max - min) + min);
}

let canvas = document.getElementById("game-canvas");
let staticContext = canvas.getContext("2d");
let dynamicContext = canvas.getContext("2d");

const PLATFORM_STROKE_WIDTH = 2;
const PLATFORM_STROKE_STYLE = 'rgb(0,0,0)';

const GROUND_HEIGHT = 40;

const PLATFORM_COUNT = getRandom(11, 16);

let SCORE = 0;

let countJ = 0;

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