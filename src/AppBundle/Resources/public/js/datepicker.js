$(document).ready(function(){
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: true,
        formatSubmit: 'yyyy-mm-dd',
        hiddenName: true,
        selectYears: 5000,
        max: new Date()
      });
})