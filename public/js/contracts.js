/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./resources/js/contracts.js ***!
  \***********************************/
var modal = document.querySelector('.modal');
var showModal = document.querySelector('.show-modal');
var closeModal = document.querySelectorAll('.close-modal');
showModal.addEventListener('click', function () {
  modal.classList.remove('hidden');
});
closeModal.forEach(function (close) {
  close.addEventListener('click', function () {
    modal.classList.add('hidden');
  });
});
$("#copyaddress").on("change", function () {
  var state = $("#corrstate").val();
  var city = $("#corrcity").val();
  var code = $("#corrcode").val();
  var street = $("#corrstreet").val();
  var house = $("#corrhouse").val();
  var flat = $("#corrflat").val();
  $("#state").val(state);
  $("#city").val(city);
  $("#code").val(code);
  $("#street").val(street);
  $("#house").val(house);
  $("#flat").val(flat);
});
/******/ })()
;