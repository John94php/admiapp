/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./resources/js/mails.js ***!
  \*******************************/
$(document).ready(function () {
  $("#msgcountBtn").prop("disabled", true);
  var i = 1;
  $("#addfield").on("click", function () {
    $("#folderdiv").clone().appendTo('.modal-body');
    $("#folderdiv").attr('id', 'folderdiv' + i);
    $("input[name='mail_folder[" + i + "']");
    i++;
  });
  $("#msgcount").on("change", function () {
    $("#msgcountBtn").prop("disabled", false);
    var id = $("#msgcount option:selected").val();

    if (id == 0) {
      $("#msgcountBtn").prop("disabled", true);
    }
  });
});
/******/ })()
;