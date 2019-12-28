<?php
if ( date("m") == "10" ){
  $themetxt = "Spooky";
  
} else {
  $themetxt = "Default";
  
}
if ( date("m") == "12" ){
  $themetxt = "Winter";
  
} else {
  $themetxt = "Default";
  
}
?>

<footer>
    <div class="page-footer">
            <h4 class="socials">Socials</h4>
                    
                        <a href="https://steamcommunity.com/id/driedsponge" target="_blank"><button style="color: black"  type="button" class="btn btn-success"><i class="fab fa-steam fa-2x"></i></button></a>
                        <a href="https://www.reddit.com/user/DriedSponge78" target="_blank"><button style="color: rgb(255, 69, 0)"  type="button" class="btn btn-success"><i class="fab fa-reddit fa-2x"></i></button></a>
                        <a href="https://www.youtube.com/channel/UCuGIXCXxUJNaq8NjFsYM21A" target="_blank"><button style="color: red" type="button" class="btn btn-success"><i class="fab fa-youtube fa-2x"></i></button></a>
                        <a href="https://gitlab.com/DriedSponge" target="_blank"><button style="color: orangered"  type="button" class="btn btn-success"><i class="fab fa-gitlab fa-2x"></i></button></a>
                       <button type="button" class="btn btn-success" style="color: #7289DA" data-toggle="modal"  data-target="#keymodal"><i class="fab fa-discord fa-2x"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="keymodal" tabindex="-1" role="dialog" aria-labelledby="keytitle" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="keytitle">Discord</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <iframe src="https://discordapp.com/widget?id=506684375543447573&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <p><cite>Copyright © 2019 DriedSponge.net &bull; Current theme: <?php echo $themetxt; ?></p>
                            
        </div>
      </footer>
      <script>
      document.getElementById('logout').innerHTML = "Logout <?php echo $steamprofile['personaname']; ?>";
      </script>
