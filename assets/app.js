/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
// import $ from 'jquery';
let $ = require('jquery')
require('select2')

$('select').select2()
let $contactBtn = $('#contactBtn')
$contactBtn.click(e => {
    e.preventDefault();
    $('#contactForm').slideDown();
    $contactBtn.slideUp();
})
// start the Stimulus application

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');