/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./resources/js/mails.js ***!
  \*******************************/
$(document).ready(function () {
  var i = 1;
  $("#addfield").on("click", function () {
    $("#folderdiv").clone().appendTo('.modal-body');
    $("#folderdiv").attr('id', 'folderdiv' + i);
    console.log(i);
    i++;
  });
});
/******/ })()
;