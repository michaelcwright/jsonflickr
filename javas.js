$(document).ready(function(){

	/*  
	  var winHeight = $(window).height();
	  $('.containerv').css("height", winHeight); 
	  
	  $(window).resize(function() {
	  winHeight = $(window).height();
	  $('.containerv').css("height", winHeight); 
	  });*/

$('#form1').submit(function(e) {
  //if ($("#mySelect option:selected").length)
  var numberPage = $('#pageNumber').val();
    if(numberPage == 25)
  {
	alert('25');
	  $('#fix').css("height", "1000px"); 
  }
    if(numberPage == 100)
  {
	alert('100');
	  $('.containerv').css("height", "2000px"); 
  }
    if(numberPage == 250)
  {
	alert('250');
	  $('.containerv').css("height", "3000px"); 
  }
    //$("#mySelect option[value='3']").attr('selected', 'selected');

});
	  
		     

});

