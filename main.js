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



