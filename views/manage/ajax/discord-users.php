<?php
if(isset($_SESSION['steamid']) && isAdmin($_SESSION['steamid'])){
?>
<table class="table paragraph" style="color: black;">
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
                                            $discordusersr = SQLWrapper()->prepare("SELECT discordid,steamid,stamp,discorduser,givenrole FROM discord LIMIT ".$_POST['discordcount']);
                                            $discordusersr->execute();
                                            
                                        }else{
                                            $discordusers = "SELECT discordid,steamid,stamp,discorduser,givenrole FROM discord";
                                            $discordusersr = SQLWrapper()->query($discordusers);
                                        }
                                
                                        
                                          while($row3 = $discordusersr->fetch()){ 
                                            if($row3['steamid'] !== null){
                                            $discordsteamurl = "https://steamcommunity.com/profiles/".$row3['steamid']."/"; 
                                            $discordstamp =  date("m/d/Y g:i a", $row3["stamp"]); 
                                              ?>
                                              
                                              <tr><td>
                                              <form action="/manage/users/" method="post" >
                                              <button type="submit" value="<?=htmlspecialchars($row3["discordid"]);?>" name="submit-unverify" class="btn btn-danger" >
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