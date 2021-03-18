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
$("#choice").on("change", function () {
  var choosen = $("#choice option:selected").val();

  switch (choosen) {
    case '1':
      $("#pesel").show();
      $("#nopesel").hide();
      break;

    case '2':
      $("#pesel").hide();
      $("#nopesel").show();
      break;

    default:
      $("#pesel").hide();
      $("#nopesel").hide();
      break;
  }
});
/******/ })()
;