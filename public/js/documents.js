/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./resources/js/documents.js ***!
  \***********************************/
$(document).ready(function () {
  $("#newtypeBtn").on("click", function () {
    $("#doctype").hide();
    $("label[for='doctype']").hide();
    $("#newtypediv").show();
    $("#newtypeBtn").hide();
    $("select[name='type']").prop("disabled", true);
  });
  $("#deletedocForm").on("submit", function () {
    Swal.fire({
      title: 'Success!',
      text: 'document deleted successfully',
      icon: 'success',
      confirmButtonText: 'OK'
    });
  });
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
});
/******/ })()
;