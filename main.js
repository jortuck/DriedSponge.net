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





var date = new Date();
if (date.getMonth() == 9)
{
  var spookfavicon = document.getElementById('favicon');
  spookfavicon.href = "https://cdn.driedsponge.net/img/favicon-spook.ico"
  var css = document.getElementById('styless');
  css.href = "spook.css"
  document.getElementById('themefoot').innerHTML = "Spooky";
} else {
  document.getElementById('themefoot').innerHTML = "Normal";
}themefoot