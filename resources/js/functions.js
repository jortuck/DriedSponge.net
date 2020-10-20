$(()=> {
    let textNeedCount = $('textarea[data-length], input[data-length]');
    textNeedCount.selected.forEach((element) => {
        new M.CharacterCounter(element);
    })
})
window.Validate = function Validate(inputid, showmsg) {
    if (showmsg == null) {
        showmsg = false;
    }
    var feedbackid = $(inputid).attr("feedback");
    $(feedbackid).addClass("valid-feedback")
    $(feedbackid).removeClass("invalid-feedback")
    if (showmsg) {
        $(feedbackid).html("Looks good!");
    } else {
        $(feedbackid).html("");
    }


    $(inputid).removeClass("is-invalid")
    $(inputid).addClass("is-valid")

}

window.InValidate = function InValidate(inputid, msg) {
    var feedbackid = $(inputid).attr("feedback");
    $(inputid).addClass("is-invalid")
    $(feedbackid).addClass("invalid-feedback")
    $(feedbackid);
}

window.Loading = function Loading(show, id) {
    if (show) {
        $(id).removeClass("d-none");
        $(id).html(`<div class="text-center"><div class="spinner-border text-primary " role="status"><span class="sr-only">Loading...</span></div><br><p class="paragraph"><b>Loading...</b></p></div>`);
    } else {
        $(id).addClass("d-none");
    }
}


window.AlertSuccess = function AlertSuccess(msg) {
    toastr["success"](msg, "Congratulations!");
}

window.AlertError = function AlertError(msg) {
    toastr["error"](msg, "Error!");
}

window.Copy = function Copy(string) {
    navigator.clipboard.writeText(string)
    AlertMaterializeSuccess('Copied!')
}

window.getCookie = function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

window.MaterialInvalidate = function MaterialInvalidate(id, msg) {
    $(`${id} + label + span`).attr("data-error",msg)
    $(id).removeClass('valid').addClass('invalid')
}

window.MaterialValidate = function MaterialValidate(id) {
    $(id).removeClass('invalid')
    $(id).addClass('valid')
}

window.AlertMaterializeSuccess = function AlertMaterializeSuccess(msg) {
    M.toast({html: msg, classes: 'green'})
}

window.AlertMaterializeError = function AlertMaterializeError(msg) {
    M.toast({html: msg, classes: 'red'})
}

window.setCookie = function setCookie(name, value) {
    var d = new Date();
    d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}
$(()=>{
    $('.click-to-reveal').click(function () {
        console.log($(this).data('revealed') )
        if($(this).attr('data-revealed') === 'false'){
            $(this).text($(this).data('reveal-content'))
            $(this).attr('data-revealed','true')
            console.log('set true')

        }else{
            console.log('set false')
            $(this).attr('data-revealed', false);
            $(this).html('Click to reveal')
        }
    })
})

