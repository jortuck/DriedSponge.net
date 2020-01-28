
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
  