$(document).ready(function() {
  $('#summernote').summernote({
    height:200
  });

  $('#selectAllBoxes').click(function(event){
    if(this.checked){
      $('.selectBoxes').each(function(){
        this.checked = true;
      });
    }else{
      $('.selectBoxes').each(function(){
        this.checked = false;
      });
    }
  });


 var div_box = "<div id='load_screen'><div id='loading'></div></div>";
 $("body").prepend(div_box);

 $("#load_screen").delay(150).fadeOut(150, function(){
  $(this).remove();
 })

});

function loadUsersOnline(){
  $.get("functions.php?onlineusers=result", function(data){
    $(".usersonline").text(data);
  });
}

setInterval(function(){
  loadUsersOnline();
},500);


