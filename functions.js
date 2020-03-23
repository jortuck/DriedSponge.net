
function Validate(inputid, feedbackid,showmsg) {
  if (showmsg == null) {
    showmsg = false;
  }
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
function Load(thing){
   url = $(thing).attr("url");
   $(thing).html("<div class='text-center'>Loading</div>");
   $.post(url, {
    load: 1
  })
  .done(function(data) {
   $(thing).html(data);
  });
}
function AlertSuccess(msg){
  toastr["success"](msg, "Congratulations!");
}

function AlertError(msg){
  toastr["error"](msg, "Congratulations!");
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
  console.log(getCookie(`${pid}-page`));
  $(`#${pid}-b-${getCookie(`${pid}-page`)}`).removeClass("active");

  if (showload == null) {
    var showload = false;
  }
  if (showload) {
    var loadthing = `#${pid}-loading`;
    Loading(true, loadthing);
    $(table).hide()
  }
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

      $(`${table} tbody`).html(data);
      document.cookie = `${pid}-col=${col}`;
      document.cookie = `${pid}-order=${order}`;
      document.cookie = `${pid}-page=${page}`;
    });
}