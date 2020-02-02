
    function Validate(inputid,feedbackid){
        $(feedbackid).addClass("valid-feedback")
        $(feedbackid).removeClass("invalid-feedback")
        $(feedbackid).html("Looks good!");
		$(inputid).removeClass("is-invalid")
		$(inputid).addClass("is-valid")
		
    }
    function InValidate(inputid,feedbackid,msg){
        $(inputid).addClass("is-invalid")
        $(feedbackid).addClass("invalid-feedback")
         $(feedbackid).html(msg);
		
    }
  function Loading(show,id){
      if(show){
        $(id).removeClass("d-none");
        $(id).html(`<div class="text-center"><div class="spinner-border text-primary " role="status"><span class="sr-only">Loading...</span></div><br><p class="paragraph"><b>Loading...</b></p></div>`);
      }else{
        $(id).addClass("d-none");
      }
  }
