document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
});

$("#metals").click(function(){
    $(".hola").show();
    $(".formulary").hide();
});
$("#noMetals").click(function(){
    $(".hola2").show();
    $(".hola1").hide();
    $(".patient").hide();
    $(".formulary").hide();
});