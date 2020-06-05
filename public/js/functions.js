function Validate(inputid,showmsg) {
    if (showmsg == null) {
      showmsg = false;
    }
    var feedbackid = $(inputid).attr("feedback");
      $(feedbackid).addClass("valid-feedback")
      $(feedbackid).removeClass("invalid-feedback")
      if(showmsg){
        $(feedbackid).html("Looks good!");
      }else{
        $(feedbackid).html("");
      }


    $(inputid).removeClass("is-invalid")
    $(inputid).addClass("is-valid")

  }
      function InValidate(inputid,msg){
          var feedbackid = $(inputid).attr("feedback");
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
  function Load(thing,tippy){
    if(tippy==null){
      var tippy = false
    }
     url = $(thing).attr("url");
     $(thing).html("<div class='text-center'>Loading</div>");
     $.post(url, {
      load: 1
    })
    .done(function(data) {
     $(thing).html(data);
      if(tippy){
        tippy('[data-tippy-content]');
      }
    });
  }
  function AlertSuccess(msg){
    toastr["success"](msg, "Congratulations!");
  }

  function AlertError(msg){
    toastr["error"](msg, "Error!");
  }
  function Copy(string) {
    navigator.clipboard.writeText(string)
    toastr["success"](`<b>${string}</b> was successfully copied to clipboard`, "Congratulations!")
  }

  function getCookie(cname) {
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

  function AjaxPagination(pid,page,showload,col,order) {
    var table = `[pid=${pid}]`;
    var url = $(table).attr('url');
    $(`#${pid}-b-${getCookie(`${pid}-page`)}`).removeClass("active");

    if (showload == null) {
      var showload = false;
    }
    if (showload) {
      var loadthing = `#${pid}-loading`;
      Loading(true, loadthing);
      $(table).hide()
    }
    $(`#${pid}-blist`).hide()

    if (col == null) {
      var col = getCookie(`${pid}-col`);
    }

    if (order == null) {
      var order = getCookie(`${pid}-order`);
    }
    $.post(url, {
        load: 1,
        page: page,
        col: col,
        order: order
      })
      .done(function(data) {
        $(`#${pid}-num`).html(page);
        $(`#${pid}-b-${page}`).addClass("active");
        if (showload) {
          Loading(false, loadthing);
          $(table).show()
        }
        $(`#${pid}-blist`).show()

        $(`${table} tbody`).html(data);
        document.cookie = `${pid}-col=${col}`;
        document.cookie = `${pid}-order=${order}`;
        document.cookie = `${pid}-page=${page}`;
          tippy('[data-tippy-content]', {
              placement: "top",
          });
      });
  }
  function MaterialInvalidate(id,msg) {
      console.log(msg)
      $(`${id} + label + span`).attr('data-error',msg)
      $(id).removeClass('valid')
      $(id).addClass('invalid')
  }
function MaterialValidate(id) {
    $(id).removeClass('invalid')
    $(id).addClass('valid')
}
function AlertMaterializeSuccess(msg) {
    M.toast({html:msg,classes:'green'})
}
function AlertMaterializeError(msg) {
    M.toast({html:msg,classes:'red'})
}
function setCookie(name, value) {
    var d = new Date();
    d.setTime(d.getTime() + (365*24*60*60*1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}
