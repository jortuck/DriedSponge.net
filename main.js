tippy('.badge-success', {
    content: 'This is still recieving updates',
    theme: 'active',
    animateFill: false,
  })
  tippy('.badge-warning', {
    content:"I am still working on this",
    theme: 'idle',
    animateFill: false,
  })
  tippy('.badge-danger', {
    content: 'This is no longer recieving updates',
    theme: 'deprecated',
    animateFill: false,
  })
  tippy('footer button', {

    theme: 'footer',
    animateFill: false,
  })


if (document.title == "info.driedsponge.net")
{
  var d = new Date();
  document.getElementById("fulldate").innerHTML = d.toString();
} else {
    console.log("Not the index");
}


var date = new Date();
if (date.getMonth() == 9)
{
  var spookfavicon = document.getElementById('favicon');
  spookfavicon.href = "https://cdn.driedsponge.net/img/favicon-spook.ico"
  spookfavicon.rel="icon" 
  spookfavicon.type="image/x-icon"
  var css = document.getElementById('styless');
  css.href = "spook.css"
  css.rel="stylesheet" 
  document.getElementById('themefoot').innerHTML = "Spooky";
} else {
  var normalfav = document.getElementById('favicon');
  normalfav.href = "https://cdn.driedsponge.net/img/zfavicon.ico"
  normalfav.rel="icon" 
  console.log("Not november");
  normalfav.type="image/x-icon"
  var normalcss = document.getElementById('styless');
  normalcss.href = "textclass.css"
  normalcss.rel="stylesheet" 
  document.getElementById('themefoot').innerHTML = "Normal";
}themefoot