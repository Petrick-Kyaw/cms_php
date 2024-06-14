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

});
