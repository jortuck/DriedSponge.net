<?php
if(isset($_SESSION['steamid']) && isAdmin($_SESSION['steamid'])){
?>
<table id="discord-users" class="table paragraph" style="color: black;">
                                          <thead>
                                          <tr>
                                          <th scope="col"></th>
                                              <th scope="col">ID64</th>
                                              <th scope="col">Timestamp</th>
                                              <th scope="col">Discord Name</th>
                                              <th scope="col">Given Roles?</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                        <?php
                                        if(isset($_POST['discordcount'])){
                                            $nlimit = $_POST['discordcount'];
                                            $discordusersr = SQLWrapper()->prepare("SELECT discordid,steamid,stamp,discorduser,givenrole FROM discord WHERE verifyid = 'VERIFIED' LIMIT ".$_POST['discordcount']);
                                            $discordusersr->execute();
                                            
                                        }else{
                                            $discordusers = "SELECT discordid,steamid,stamp,discorduser,givenrole FROM discord WHERE verifyid = 'VERIFIED'";
                                            $discordusersr = SQLWrapper()->query($discordusers);
                                        }
                                
                                        
                                          while($row3 = $discordusersr->fetch()){ 
                                            if($row3['steamid'] !== null){
                                            $discordsteamurl = "https://steamcommunity.com/profiles/".$row3['steamid']."/"; 
                                            $discordstamp =  date("m/d/Y g:i a", $row3["stamp"]); 
                                              ?>
                                              
                                              <tr id="row-<?=htmlspecialchars($row3["steamid"]);?>"><td>
                                              <script>
                                                      $(document).ready(function(){
                                                        $("#unverify-discord-<?=htmlspecialchars($row3["discordid"]);?>").submit(function(event){
                                                          event.preventDefault();
                                                          var submit = $("#submit-unverify-<?=htmlspecialchars($row3["discordid"]);?>").val();
                                                          $("#unverify-form-message-<?=htmlspecialchars($row3["discordid"]);?>").load("/manage/ajax/manage-discord-user.php",{
                                                            method: "jQuery",
                                                            type: "unverify",
                                                            username: "<?=htmlspecialchars($row3["discorduser"]);?>",
                                                            user: "<?=htmlspecialchars($row3["steamid"]);?>"
                                                          });
                                                      });
                                                  });
                                              </script>
                                              <div id="unverify-form-message-<?=htmlspecialchars($row3["discordid"]);?>"></div>
                                              <form id="unverify-discord-<?=htmlspecialchars($row3["discordid"]);?>" action="/manage/ajax/manage-discord-user.php" method="post" >
                                                <button type="submit" id="submit-unverify-<?=htmlspecialchars($row3["discordid"]);?>" class="btn btn-danger" >
                                                  Unverify
                                                </button>
                                              </form>
                                      </td><td><a href="<?=htmlspecialchars($discordsteamurl)?>" target="_blank"><?=htmlspecialchars($row3["steamid"]);?></a></td><td><?=htmlspecialchars($discordstamp);?></td><td><?=htmlspecialchars($row3["discorduser"]);?><br>(<?=htmlspecialchars($row3["discordid"]);?>)</td><td><?=htmlspecialchars($row3["givenrole"]);?></td></tr> 
                                              
                                              <?php
                                          }
                                        }
                                        ?>
                                        </tbody>
                                          </table>
<?php
}else{
    header("Location: /home/");
}

?>