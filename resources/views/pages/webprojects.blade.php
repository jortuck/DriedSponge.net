@extends('layouts.app')
@section('title','Web Projects')
@section('description',"Here you can find a list of all of my web projects and you may be able to view some of them.")
@section('content')
<div class="container-fluid-lg" style="justify-content:center">




    <div class="container-fluid">
      <br>
      <div data-aos="fade-right" class="content-box row">
        <div class="col-lg">
          <div class="showcase-text">
            <h2 class="text-left">Custom Image Viewer</h2>
            <p class="paragraph">For this project, I wanted to add more "style" to my image server so I used some css and html to just make it look better in general. I also used java script to add buttons to copy the image url, and download the image.</p>
            <p class="paragraph">
              <a href="https://i.driedsponge.net/3z5XE" target="_blank" class="btn btn-primary">Visit Example</a></p>
          </div>
        </div>
        <div class="col-lg">
          <img src="https://i.driedsponge.net/images/png/3z5XE.png" class="img-fluid showcase-img" alt="Example">
        </div>
      </div>
      <br>
      <br>
      <div data-aos="fade-left"  class="content-box row">
        <div class="col-lg">
          <img src="https://i.driedsponge.net/images/png/OIo3j.png" class="img-fluid showcase-img">
        </div>
        <div class="col-lg">
          <div class="showcase-text">
            <h2 class="text-left">DriedSponge.net (This site!)</h2>
            <p class="paragraph">I use this site to practice most of my code on. Most people call it a CMS because of the backend features I have on it like page creation and user management. I orginally buit it with vanilla PHP, but then I decided to recreate it with Laravel</p>
            <a target="_blank" href="https://driedsponge.net/" class="btn btn-primary">Visit Site</a>
          </div>
        </div>
      </div>
      <br>

      <br>
      <div data-aos="fade-right"  class="content-box row">
        <div class="col-lg">
          <div class="showcase-text">
            <h2 class="text-left">DriedSponge.net Bot </h2>
            <p class="paragraph">This is a discord bot that I'm working on for <a href="https://driedsponge.net/discord" target="_blank">my discord server</a>. I use to work on my java script and to learn more about linux servers. Currently for hosting, I am using my moms old laptop in which I installed ubuntu server on.</p>
            
          </div>
        </div>
        <div class="col-lg">

          <img src="https://i.driedsponge.net/images/gif/tZfna.gif" class="img-fluid showcase-img" alt="Example">

        </div>
      </div>
    </div>


  </div>

<script>
    navitem = document.getElementById('projectslink').classList.add('active')
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection