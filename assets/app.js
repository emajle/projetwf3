/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

const $ = require("jquery");
global.$ = global.jQuery = $;
window.Popper = require("popper.js")
require("bootstrap");

const cookieBox = document.querySelector("#card-welcome"),
    acceptBtn = cookieBox.querySelector("#accept");
acceptBtn.onclick = () => {
    document.cookie = "Cookie=ESGT; max-age=" + 60 * 60 * 24 * 30;
    if (document.cookie) {
        cookieBox.classList.add("hide");
    } else {
        alert("Cookie can't be set !");
    }
}

let checkCookie = document.cookie.indexOf("Cookie=ESGT");
checkCookie != -1 ? cookieBox.classList.add("hide") : cookieBox.classList.remove("hide");

window.addEventListener("DOMContentLoaded", event => {
    const audio = document.querySelector("audio");
    audio.volume = 0.8;
    audio.play();
});
