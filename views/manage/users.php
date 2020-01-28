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
  <script src="https://driedsponge.net/functions.js"></script>
  <script>
    var discordcount = 3;

    function loadmoredis() {
      discordcount = discordcount + 2;
      $('#discordusers').load('/manage/ajax/discord-users.php', {
        discordcount: discordcount
      });
    };

    function loadalldis() {
      discordcount = discordcount + 2;
      $('#discordusers').load('/manage/ajax/discord-users.php');
    };
  </script>

</head>

<body>

  <?php
  include("views/includes/navbar.php");

  ?>
  <style>
    .dropdown-head-link {
      color: black;
      text-decoration: none;

    }

    .dropdown-head-link:hover {
      color: black;
      text-decoration: underline;

    }
  </style>

  <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">

      <div class="container">

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
              <h1 class="display-4"><strong>User Management</strong></h1>
            </hgroup>
            <br>
            <div class="card">
              <div class="card-header">
                <h3>User Blacklist</h3>
              </div>
              <div class="card-body">
                <script>
                  $(document).ready(function() {
                    $("#block-user-form").submit(function(event) {
                      event.preventDefault();
                      var id64 = $("#block-id64").val();
                      var rsn = $("#block-rsn").val();
                      $.post("/manage/ajax/blocked-users.php", {
                          blockusr: 1,
                          id64: id64,
                          rsn: rsn
                        })
                        .done(function(data) {
                          if (data.success) {
                            toastr["success"](data.message, "Congratulations!")
                            Validate("#block-id64","#block-id64-feedback");
                            Validate("#block-rsn","#block-rsn-feedback");
                            $("#blocked-users").append(`
                                    <tr id="blocked-${id64}"><td>
                                    <button onclick="UnBlock('${id64}')" value="${id64}" name="submit-unblock" class="btn btn-danger" >
                                      Remove User
                                    </button>

                                  </td><td><a target="_blank" href="/sprofile/${id64}">${id64}</a></td><td>${rsn}</td><td>${data.blockdate}</td></tr> 
                                    `);

                          } else {


                            if (data.SysError) {
                              toastr["error"](data.message, "Error:")
                            } else if (data.basics) {
                              if (data.errorID64 && data.errorID64TXT !== null) {
                                InValidate("#block-id64","#block-id64-feedback",data.errorID64TXT);
                              } else {
                                Validate("#block-id64","#block-id64-feedback");
                              }
                              if (data.errorRSN && data.errorRSNTXT !== null) {
                                InValidate("#block-rsn","#block-rsn-feedback",data.errorRSNTXT);
                              } else {
                                Validate("#block-rsn","#block-rsn-feedback");
                              }

                            }
                          }
                        });
                    });
                  });
                </script>
                <form id="block-user-form" method="post">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="block-id64" style="color: black;">SteamID64</label>
                      <input id="block-id64" name="block-id64" class="form-control" placeholder="Enter SteamID64">
                      <div id="block-id64-feedback"></div>
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                      <label for="block-rsn" style="color: black;">Reason</label>
                      <input maxlength="100" id="block-rsn" name="block-rsn" type="text" class="form-control" placeholder="Enter reason">
                      <div id="block-rsn-feedback"></div>
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                      <button name="submit-block" type="submit" class="btn btn-primary">Add User</button>
                    </div>
                  </div>
                </form>

                <br>
                <p class="subsubhead" style="color: black; text-align: left;">Current Users</p>
                <table id="blocked-users" class="table paragraph text-center" style="color: black;">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">ID64</th>
                      <th scope="col">Reason</th>
                      <th scope="col">Timestamp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <script>
                      function UnBlock(steamid) {
                        console.log(steamid);
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
                    </script>
                    <?php
                    $sql = "SELECT id64, rsn, stamp FROM blocked";
                    $result = SQLWrapper()->query($sql);
                    while ($row = $result->fetch()) {
                      $blackurl = "/sprofile/" . $row['id64'] . "/";
                      $blocknormalstamp =  date("m/d/Y g:i a", $row["stamp"]);
                    ?>

                      <tr id="blocked-<?= htmlspecialchars($row['id64']); ?>">
                        <td>
                          <button onclick="UnBlock(`<?= htmlspecialchars($row['id64']); ?>`)" value="<?= htmlspecialchars($row["id64"]); ?>" name="submit-unblock" class="btn btn-danger">
                            Remove User
                          </button>

                        </td>
                        <td><a target="_blank" href="<?= htmlspecialchars($blackurl); ?>"><?= htmlspecialchars($row["id64"]); ?></a></td>
                        <td><?= htmlspecialchars($row["rsn"]); ?></td>
                        <td><?= htmlspecialchars($blocknormalstamp); ?></td>
                      </tr>

                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <br>
            <?php if (isMasterAdmin($steamprofile['steamid'])) {
            ?>
              <div class="card">
                <div class="card-header">
                  <h3>Admins</h3>
                </div>
                <div class="card-body">
                  <!-- Admin manager -->
                  <form action="users.php" method="post">
                    <label for="id642" style="color: black;">SteamID64</label>
                    <input id="id642" name="id64" type="number" class="form-control" placeholder="Enter SteamID64" required>
                    <br>

                    <button name="submit-hire" type="submit" class="btn btn-primary">Add User</button>

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
              </div>
              <br>
            <?php } ?>
            <div class="card">
              <div class="card-header">
                <h3>Verified Discord Users</h3>
              </div>
              <div class="card-body">
                <!-- Discord manager -->
                <script>
                  $(document).ready(function() {
                    $("#verify-discord").submit(function(event) {
                      event.preventDefault();
                      var id64 = $("#verify-id64").val();
                      var tag = $("#verify-discordtag").val();
                      var discordid = $("#verify-discordid").val();
                      var submit = $("#submit-verify").val();
                      $("#verify-form-message").load("/manage/ajax/manage-discord-user.php", {
                        id64: id64,
                        tag: tag,
                        discordid: discordid,
                        method: "jQuery",
                        submit: submit
                      });
                    });
                  });
                </script>
                <form id="verify-discord" action="/manage/ajax/manage-discord-user.php" method="post">
                  <div id="verify-form-message"></div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="verify-id64" style="color: black;">SteamID64</label>
                      <input id="verify-id64" name="verify-id64" class="form-control" placeholder="Enter SteamID64">
                      <div id="verify-id64-feedback"></div>
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                      <label for="verify-discordtag" style="color: black;">Discord Name and Tag</label>
                      <input id="verify-discordtag" name="verify-discordtag" type="text" class="form-control" placeholder="ex: DriedSponge#0001">
                      <div id="verify-discordtag-feedback"></div>
                    </div>
                    <br>
                  </div>
                  <label for="verify-discordid" style="color: black;">Discord ID</label>
                  <input id="verify-discordid" name="discordid" type="text" class="form-control" placeholder="Enter their discord ID">
                  <div id="verify-discordid-feedback"></div>
                  <br>
                  <button id="submit-verify" name="submit-verify" type="submit" class="btn btn-primary">Manually Verify</button>
                </form>
                <br>
                <p class="subsubhead" style="color: black; text-align: left;">Currently Verified Users</p>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                  </div>
                  <input id="search-discord" placeholder="ID64, Timestamp, Discord Name, Given Roles" class="form-control">
                </div>
                <br>
                <div id="discordusers">
                  <table id="discord-users" class="table paragraph" style="color: black;">
                    <thead>
                      <tr class="text-center">
                        <th scope="col"></th>
                        <th scope="col">ID64</th>
                        <th scope="col">Timestamp</th>
                        <th scope="col">Discord Name</th>
                        <th scope="col">Given Roles?</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
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
                      </script>
                      <?php
                      $discordusers = "SELECT discordid,steamid,stamp,discorduser,givenrole FROM discord WHERE verifyid = 'VERIFIED' LIMIT 5";
                      $discordusersr = SQLWrapper()->query($discordusers);
                      while ($row3 = $discordusersr->fetch()) {
                        if ($row3['steamid'] !== null) {
                          $discordsteamurl = "/sprofile/" . $row3['steamid'] . "/";
                          $discordstamp =  date("m/d/Y g:i a", $row3["stamp"]);
                      ?>

                          <tr class="search-discorduser" id="discord-users-<?= htmlspecialchars($row3["discordid"]); ?>">
                            <td>
                              <button onclick="Unverify(`<?= htmlspecialchars($row3['discordid']); ?>`,`<?= htmlspecialchars($row3['discorduser']); ?>`)" class="btn btn-danger">
                                Unverify
                              </button>
                            </td>
                            <td><a href="<?= htmlspecialchars($discordsteamurl) ?>" target="_blank"><?= htmlspecialchars($row3["steamid"]); ?></a></td>
                            <td><?= htmlspecialchars($discordstamp); ?></td>
                            <td><?= htmlspecialchars($row3["discorduser"]); ?><br>(<?= htmlspecialchars($row3["discordid"]); ?>)</td>
                            <td><?= htmlspecialchars($row3["givenrole"]); ?></td>
                          </tr>

                      <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                  <script>
                    $(document).ready(function() {
                      $("#search-discord").on("focus", function() {
                        loadalldis();
                      })
                      $("#search-discord").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#discord-users .search-discorduser").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                      });
                    });
                  </script>
                </div>
                <button id="load-more-dis" onclick="loadalldis()" class="btn btn-primary">Browse All</button>

              </div>
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
          <h1 class="articleh1">Please login to manage.</h1>
          <br>
          <p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
        <?php
        }
        ?>
      </div>
    </div>

  </div>
  <!-- end of app -->
  <?php
  include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
  ?>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/popper.js@1"></script>
  <script src="https://unpkg.com/tippy.js@4"></script>
  <script src="main.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  <script>
    navitem = document.getElementById('userstab').classList.add('active')
  </script>
</body>

</html>