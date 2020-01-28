<?php
if (isset($_SESSION['steamid']) && isAdmin($_SESSION['steamid'])) {
?>
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
      <?php

      $discordusers = "SELECT discordid,steamid,stamp,discorduser,givenrole FROM discord WHERE verifyid = 'VERIFIED'";
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
<?php
} else {
  header("Location: /home/");
}

?>