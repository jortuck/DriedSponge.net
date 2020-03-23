<?php
sleep(5);
if (isset($_POST['load'])) {
  if (!isset($_SESSION['steamid'])) {

?>
    <script>
      AlertError("Session expired");
    </script>
    <?php
  } else {
    if (!isAdmin($_SESSION['steamid'])) {
    ?>
      <script>
        AlertError("You're not an admin");
      </script>
      <?php
    } else {
      if (isset($_POST['page'])) {
        $page = intval($_POST['page']);
      } else {
        $page = 1;
      }
      $col = $_POST['col'];
      $ord = $_POST['order'];

      $records_per_page = 5;
      $starting_limit_number = ($page - 1) * $records_per_page;
      $limit = $starting_limit_number . "," . $records_per_page;

      $discordusers = SQLWrapper()->prepare("SELECT discordid,steamid,stamp,discorduser,givenrole FROM discord WHERE verifyid = 'VERIFIED' ORDER BY $col $ord LIMIT :start,:end");
      $discordusers->bindParam(':start', $starting_limit_number, PDO::PARAM_INT);
      $discordusers->bindParam(':end', $records_per_page, PDO::PARAM_INT);

      $discordusers->execute();
      

      $users = $discordusers->fetchAll();
      foreach ($users as $row3) {
        if ($row3['steamid'] !== null) {
          $discordsteamurl = "/sprofile/" . $row3['steamid'] . "/";
          $discordstamp =  date("m/d/Y g:i a", $row3["stamp"]);
          if ($row3["givenrole"]) {
            $row3["givenrole"] = "Yes";
          } else {
            $row3["givenrole"] = "Pending";
          }
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
    }
  }
}
