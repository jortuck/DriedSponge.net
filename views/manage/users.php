<!DOCTYPE html>


<html>

<head>
  <!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

  <meta name="description" content="Admins only guys">
  <meta name="keywords" content="driedsponge.net mange">
  <meta name="author" content="Jordan Tucker">
  <meta property="og:site_name" content="DriedSponge.net | Mangement" />

  <?php
  include("views/includes/meta.php");
  ?>

  <title>Manage - Users</title>

  <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</head>

<body>

  <?php
  include("views/includes/navbar.php");

  ?>


  <div class="app">
    <div class="container-fluid-lg">
      <div class="container-fluid">

        <?php
        if (isset($_SESSION['steamid'])) {

          if (isAdmin($_SESSION['steamid'])) {


            if (isset($_POST['submit-fire'])) {
              if (isMasterAdmin($_SESSION['steamid'])) {
                $fireid = $_POST['submit-fire'];
                $sqlfire = SQLWrapper()->prepare("DELETE FROM staff WHERE id64= :id");
                $sqlfire->execute([':id' => $fireid]);
                header("Location: ?fired=$fireid");
              } else {
                header("Location: ?not-sponge");
              }
            }

            if (isset($_POST['submit-hire'])) {
              if (isMasterAdmin($_SESSION['steamid'])) {
                $hireid = $_POST['id64'];
                $hirestamp = time();
                $sqlhireexistquery = SQLWrapper()->prepare("SELECT id64 FROM staff WHERE id64= :id");
                $sqlhireexistquery->execute([':id' => $hireid]);
                $hirerows = $sqlhireexistquery->fetch();
                if (!empty($hirerows)) {
                  header("Location: ?already-staff");
                } else {
                  $adminhire = SQLWrapper()->prepare("INSERT INTO staff (id64)
                                VALUES (?)")->execute([$hireid]);
                  header("Location: users.php?hired=$hireid");
                }
              } else {
                header("Location: users.php?not-sponge");
              }
            }

        ?>
            <?php
            include("views/includes/manage/navtab.php");
            ?>
            <br>
            <hgroup>
              <h1 class="display-2"><strong>User Management</strong></h1>
            </hgroup>
            <br>
            <div class="content-box">
              <h1>User Blacklist</h1>
              <script>
                $(document).ready(function() {
                  $("#block-user-form").submit(function(event) {
                    event.preventDefault();
                    Loading(true, "#block-load");
                    $("#block-user-form").hide()
                    var id64 = $("#block-id64").val();
                    var rsn = $("#block-rsn").val();
                    $.post("/manage/ajax/blocked-users.php", {
                        blockusr: 1,
                        id64: id64,
                        rsn: rsn
                      })
                      .done(function(data) {
                        Loading(false, "#block-load");
                        $("#block-user-form").show()
                        if (data.success) {
                          toastr["success"](data.message, "Congratulations!")
                          Validate("#block-id64");
                          Validate("#block-rsn");
                          Load("#blocked-users");

                        } else {
                          if (data.SysError) {
                            toastr["error"](data.message, "Error:")
                          } else if (data.basics) {
                            if (data.errorID64 && data.errorID64TXT !== null) {
                              InValidate("#block-id64", data.errorID64TXT);
                            } else {
                              Validate("#block-id64");
                            }
                            if (data.errorRSN && data.errorRSNTXT !== null) {
                              InValidate("#block-rsn", data.errorRSNTXT);
                            } else {
                              Validate("#block-rsn");
                            }

                          }
                        }
                      });
                  });
                });
              </script>
              <div id="block-load"></div>
              <form id="block-user-form" method="post">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="block-id64" style="color: black;">User</label>
                    <input id="block-id64" feedback="#block-id64-feedback" name="block-id64" class="form-control form-control-alternative" placeholder="Enter SteamID64/SteamID/SteamID3/Community ID/Profile URL">
                    <div id="block-id64-feedback"></div>
                  </div>
                  <br>
                  <div class="form-group col-md-6">
                    <label for="block-rsn" style="color: black;">Reason</label>
                    <input maxlength="100" feedback="#block-rsn-feedback" id="block-rsn" name="block-rsn" type="text" class="form-control form-control-alternative" placeholder="Enter reason">
                    <div id="block-rsn-feedback"></div>
                  </div>
                  <br>
                  <div class="form-group col-md-6">
                    <button name="submit-block" type="submit" class="btn btn-success">Add User</button>
                  </div>
                </div>
              </form>

              <br>
              <h2>Current Users</h2>
              <table class="table paragraph text-center" style="color: black;">
                <thead>
                  <tr>
                    <th scope="col">User</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Timestamp</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <script>
                  $(document).ready(function() {
                    Load("#blocked-users");
                  })

                  function UnBlock(steamid) {
                    $.post("/manage/ajax/blocked-users.php", {
                        unblockusr: 1,
                        id64: steamid
                      })
                      .done(function(data) {
                        if (data.success) {
                          toastr["success"](data.message, "Congratulations!")
                          $(`#blocked-${steamid}`).remove()
                        } else {
                          toastr["error"](data.message, "Error:")
                        }
                      });
                  }

                  function EditBlock(steamid) {
                    $.post("/manage/ajax/blocked-users.php", {
                        edit: 1,
                        steamid: steamid
                      })
                      .done(function(data) {
                        $("#modal").html(data);
                      });
                  }
                </script>
                <tbody id="blocked-users" url="/manage/ajax/blocked-users.php">


                </tbody>
              </table>
            </div>
            <br>
            <?php if (isMasterAdmin($steamprofile['steamid'])) {
            ?>
              <div class="content-box">
                <h1>Admins</h1>
                <form method="post">
                  <label for="id642" style="color: black;">SteamID64</label>
                  <input id="id642" name="id64" type="number" class="form-control form-control-alternative" placeholder="Enter SteamID64" required>
                  <br>
                  <button name="submit-hire" type="submit" class="btn btn-success">Add User</button>
                </form>
                <br>
                <p class="subsubhead" style="color: black; text-align: left;">Current Admins</p>
                <table class="table paragraph" style="color: black;">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">ID64</th>
                      <th scope="col">Timestamp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql2 = "SELECT id64, UNIX_TIMESTAMP(stamp) AS stamp FROM staff";
                    $result2 = SQLWrapper()->query($sql2);
                    while ($row2 = $result2->fetch()) {
                      $admurl = "/sprofile/" . $row2['id64'] . "/";
                      $admnormalstamp =  date("m/d/Y g:i a", $row2["stamp"]);
                    ?>

                      <tr>
                        <td>
                          <form action="users.php" method="post">
                            <button type="submit" value="<?= htmlspecialchars($row2["id64"]); ?>" name="submit-fire" class="btn btn-danger">
                              Fire!
                            </button>
                          </form>
                        </td>
                        <td><a href="<?= htmlspecialchars($admurl) ?>" target="_blank"><?= htmlspecialchars($row2["id64"]); ?></a></td>
                        <td><?= htmlspecialchars($admnormalstamp); ?></td>
                      </tr>

                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <br>
            <?php } ?>
            <div class="content-box">
              <h1>Verified Discord Users</h1>
              <script>
                $(document).ready(function() {
                  $("#verify-discord").submit(function(event) {
                    event.preventDefault();
                    var steam = $("#verify-steam").val();
                    var discordtag = $("#verify-discordtag").val();
                    var discordid = $("#verify-discordid").val();
                    $.post("/manage/ajax/manage-discord-user.php", {
                        verify: 1,
                        steam: steam,
                        discordtag: discordtag,
                        discordid: discordid
                      })
                      .done(function(data) {
                        if (data.success) {
                          AjaxPagination("du", 1, true);
                          AlertSuccess(data.Msg);
                          Validate("#verify-discordid")
                          Validate("#verify-discordtag")
                          Validate("#verify-steam")

                        } else {
                          if (data.SysErr) {
                            AlertError(data.Msg);
                          }
                          if (data.SteamErr) {
                            InValidate("#verify-steam", data.SteamErr)
                          } else {
                            Validate("#verify-steam")
                          }
                          if (data.TagErr) {
                            InValidate("#verify-discordtag", data.TagErr)
                          } else {
                            Validate("#verify-discordtag")
                          }
                          if (data.IDErr) {
                            InValidate("#verify-discordid", data.IDErr)
                          } else {
                            Validate("#verify-discordid")
                          }
                        }
                      })
                  });
                })
              </script>
              <div id="verify-discord-load"></div>
              <form id="verify-discord">
                <div id="verify-form-message"></div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="verify-steam" style="color: black;">Steam Profile</label>
                    <input id="verify-steam" feedback="#verify-steam-feedback" name="verify-steam" class="form-control form-control-alternative" placeholder="Enter SteamID64/SteamID/SteamID3/Community ID/Profile URL">
                    <div id="verify-steam-feedback"></div>
                  </div>
                  <br>
                  <div class="form-group col-md-6 ">
                    <label for="verify-discordtag" style="color: black;">Discord Name and Tag</label>
                    <input id="verify-discordtag" feedback="#verify-discordtag-feedback" name="verify-discordtag" type="text" class="form-control form-control-alternative" placeholder="ex: DriedSponge#0001">
                    <div id="verify-discordtag-feedback"></div>
                  </div>
                  <br>
                </div>
                <label for="verify-discordid" style="color: black;">Discord ID</label>
                <input id="verify-discordid" feedback="#verify-discordid-feedback" type="text" class="form-control form-control-alternative" placeholder="Enter their discord ID">
                <div id="verify-discordid-feedback"></div>
                <br>
                <button id="submit-verify" type="submit" class="btn btn-success"><i class="fas fa-check"></i> Manually Verify</button>
              </form>
              <br>
              <h2>Currently Verified Users - Page <span id="du-num">1</span></h2>
              <div class="input-group input-group-alternative mb-4">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
                <input id="search-discord" placeholder="ID64, Timestamp, Discord Name, Given Roles" class="form-control  form-control-alternative">
              </div>
              <br>
              <div id="du-loading"></div>
              <table id="discordusers" class="table paragraph text-center" style="color: black;" url="/manage/ajax/discord-users.php" pid="du">
                <thead>
                  <tr class="text-center">
                    <th scope="col">ID64</th>
                    <th scope="col">Timestamp</th>
                    <th scope="col">Discord Name</th>
                    <th scope="col">Given Roles?</th>
                    <th scope="col">Actions</th>

                  </tr>
                </thead>

                <tbody>

                </tbody>
                <script>
                  $(document).ready(function() {
                    AjaxPagination("du", 1, true, "stamp", "DESC");
                  })
                </script>
              </table>
              <script>
                function Unverify(discordid, username) {
                  $.post("/manage/ajax/manage-discord-user.php", {
                      unverify: 1,
                      username: username,
                      discordid: discordid
                    })
                    .done(function(data) {
                      if (data.success) {
                        toastr["success"](data.message, "Congratulations!")
                        $(`#discord-users-${discordid}`).remove()
                      } else {
                        toastr["error"](data.message, "Error:")
                      }
                    });
                }

                $(document).ready(function() {

                  $("#search-discord").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("table .search-discorduser").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                  });
                });
              </script>
              <nav>
                <ul id="du-blist" class="pagination justify-content-center">
                  <?php
                  $records_per_page = 5;

                  $sql = SQLWrapper()->prepare("SELECT * FROM discord WHERE verifyid = 'VERIFIED'");
                  $sql->execute();

                  $results = $sql->rowCount();


                  $number_of_pages = ceil($results / $records_per_page);

                  for ($page = 1; $page <= $number_of_pages; $page++) {
                  ?>
                    <li id="du-b-<?= v($page); ?>" class="page-item"><button class="page-link" onclick="AjaxPagination('du',<?= v($page); ?>,true)"><?= v($page); ?></button></li>
                  <?php
                  }
                  ?>
                </ul>
              </nav>
            </div>
            <br>

          <?php } else { ?>
            <hgroup>
              <h1 class="display-2"><strong>You are not management, get out!</strong></h1>
              <?php
              header("Location: /home/");
              ?>
              <br>
            </hgroup>

          <?php
          }
        } else {
          ?>
          <div class="content-box">
            <h1>Please login to manage.</h1>
            <p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
    <div id="modal"></div>
  </div>
  <!-- end of app -->
  <?php
  include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
  ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/popper.js@1"></script>
  <script src="https://unpkg.com/tippy.js@4"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  <script>
    navitem = document.getElementById('userstab').classList.add('active')
  </script>
</body>

</html>