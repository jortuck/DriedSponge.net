<?php

if (isset($_POST['edit'])) {
    if (isset($_SESSION['steamid'])) {
        if (isAdmin($_SESSION['steamid'])) {
            $user = SQLWrapper()->prepare("SELECT * FROM blocked WHERE id64 = :id64");
            $user->execute([":id64" => $_POST['steamid']]);
            $data = $user->fetch();
            $info =  json_decode($data['info'], true);
?>
            <script>
                $("#edit-block-modal").modal('show');
                $("#edit-block-form").submit(function(event) {
                    event.preventDefault();
                    var reason = $("#edit-reason-input").val()
                    $.post("/manage/ajax/blocked-users.php", {
                            saveedit: 1,
                            reason: reason,
                            steamid: '<?= v($info['id64']); ?>'
                        })
                        .done(function(data) {
                            if (data.success) {
                                Validate("#edit-reason", "#edit-reason-feedback")
                                $("#edit-block-modal").modal('hide');
                                AlertSuccess(data.Msg)
                                Load("#blocked-users");
                            } else {
                                if (data.SysErr) {
                                    AlertError(data.Msg);
                                }
                                if (data.ResonErr) {
                                    InValidate("#edit-reason-input", "#edit-reason-feedback", data.ResonErr);
                                } else {
                                    Validate("#edit-reason-input", "#edit-reason-feedback")
                                }
                            }
                        })
                })
            </script>
            <div class="modal" tabindex="-1" id="edit-block-modal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit <?= v($info['name']); ?>'s Ban</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px">&times;</span>
                            </button>
                        </div>
                        <form id="edit-block-form">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Reason</label>
                                    <input id="edit-reason-input" class="form-control form-control-alternative" placeholder="Please add a reason, it's required." value="<?= v($data['rsn']); ?>">
                                    <div id="edit-reason-feedback"></div>
                                </div>

                            </div>
                            <div class="modal-footer" style="justify-content: center">
                                <button type="submit" class="btn btn-success">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <script>
                AlertError("You're not an admin");
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            AlertError("Session Expired");
        </script>
        <?php
    }
    die();
}





if (isset($_POST['loadusr'])) {
    header('Content-type: application/json');

    $Message = array(
        "success" => false,
        "message" => "Something went wrong I guess"
    );
    if (isset($_SESSION['steamid'])) {
        if (isAdmin($_SESSION['steamid'])) {

            $Message['success'] = true;
            $Message['message'] = $unblockid . " has been unblocked!";
        } else {
            $Message["message"] = "You're not an admin";
        }
    } else {
        $Message["message"] = "You're not logged in";
    }
    die(json_encode($Message));
}


if (isset($_POST['unblockusr'])) {
    header('Content-type: application/json');

    $Message = array(
        "success" => false,
        "message" => "Something went wrong I guess"
    );
    if (isset($_SESSION['steamid'])) {
        if (isAdmin($_SESSION['steamid'])) {
            $user = isBlocked($_POST['id64']);
            if ($user['banned'] == true) {
                    $unblockid = $_POST['id64'];

                    $adminname = $steamprofile['personaname'];
                    $logdata = array(
                        "User" => SInfo($_SESSION['steamid']),
                        "Msg" => "<a href='/sprofile/" . $_SESSION['steamid'] . "/' target='_blank'>$adminname</a> unblocked <a href='/sprofile/" . $unblockid . "/' target='_blank'>" . $unblockid . "</a>"
                    );
                    if (AdminLog($logdata)) {
                        try{
                            $sqlunblock = SQLWrapper()->prepare("DELETE FROM blocked WHERE id64= :id");
                            $sqlunblock->execute([':id' => $unblockid]);
                            $Message['success'] = true;
                            $Message['message'] = $unblockid . " has been unblocked!";
                        } catch (PDOException $e){
                            SendError("MySQL Error", $e->getMessage());
                            $Message["message"] = "There was an error saving the data! Try again later!";
                        }
                        
                    } else {
                        $Message["message"] = "There was an error logging the action so please try again later";
                    }
            } else {
                $Message["message"] = "The user is not blocked!";
            }
        } else {
            $Message["message"] = "You're not an admin";
        }
    } else {
        $Message["message"] = "You're not logged in";
    }
    die(json_encode($Message));
}




if (isset($_POST['blockusr'])) {
    header('Content-type: application/json');

    $Message = array(
        "success" => false,
        "SysError" => false,
        "basics" => false,
        "errorID64" => false,
        "errorRSN" => false,
        "errorID64TXT" => null,
        "errorRSNTXT" => null,
        "message" => "Something went wrong I guess"
    );
    if (isset($_SESSION['steamid'])) {
        if (isAdmin($_SESSION['steamid'])) {
            $Message["basics"] = true;
            $admin = $_SESSION['steamid'];
            $blockid = $_POST['id64'];
            $blockrsn = $_POST['rsn'];

            if (IsEmpty($blockid)) {
                $Message['errorID64'] = true;
                $Message['errorID64TXT'] = "You must specify which user to block!";
            } else {
                $user =  SInfo($_POST['id64']);
                if ($user['success'] == false) {
                    $Message['errorID64'] = true;
                    $Message['errorID64TXT'] = "The user does not exist on steam!";
                }
            }

            if (IsEmpty($blockrsn)) {
                $Message['errorRSN'] = true;
                $Message['errorRSNTXT'] = "You must specify a valid reson!";
            } else if (strlen($blockrsn) > 100) {
                $Message['errorRSN'] = true;
                $Message['errorRSNTXT'] = "The reason must be under 100 characters";
            }

            if ($Message["basics"] && !$Message["errorRSN"] && !$Message['errorID64']) {
                $blockstamp = time();
                if (isBlocked($user['id64'])['banned'] == true) {
                    $Message["SysError"] = true;
                    $Message['message'] = "This user is already blocked!";
                } else {
                    $info = json_encode($user);
                    $admininfo = SInfo($_SESSION['steamid']);
                    $sqlblock = SQLWrapper()->prepare("INSERT INTO blocked (id64, rsn, stamp,info,AdminInfo)
                 VALUES (?,?,?,?,?)")->execute([$user['id64'], $blockrsn, $blockstamp, $info, json_encode($admininfo)]);
                    $Message['blockdate'] =  date("m/d/Y g:i a", $blockstamp);
                    $Message["success"] = true;
                    $Message['message'] = $user['name'] . " has been blocked";
                    $adminname = $steamprofile['personaname'];
                    $logdata = array(
                        "User" => $admininfo,
                        "Msg" => "<a href='/sprofile/" . $_SESSION['steamid'] . "/' target='_blank'>$adminname</a> blocked <a href='/sprofile/" . $user['id64'] . "/' target='_blank'>" . $user['name'] . "</a> for <strong>$blockrsn</strong>"
                    );
                    AdminLog($logdata);
                }
            }
        } else {
            $Message["SysError"] = true;
            $Message["message"] = "You're not an admin";
        }
    } else {
        $Message["SysError"] = true;
        $Message["message"] = "You're not logged in";
    }
    die(json_encode($Message));
}

if (isset($_POST['load'])) {
    if (isset($_SESSION['steamid'])) {
        if (isAdmin($_SESSION['steamid'])) {


            $sql = "SELECT info, rsn, stamp,AdminInfo FROM blocked";
            $result = SQLWrapper()->query($sql);
            while ($row = $result->fetch()) {
                $info = json_decode($row['info'], true);
                $id64 = $info['id64'];
                $url = $info['url'];
                $name = $info['name'];
                $blocknormalstamp =  date("m/d/Y g:i a", $row["stamp"]);
                $admin = json_decode($row['AdminInfo'],true);
        ?>

                <tr id="blocked-<?= htmlspecialchars($id64); ?>">

                    <td><a target="_blank" href="/sprofile/<?= htmlspecialchars($id64); ?>"><?= htmlspecialchars($name); ?></a></td>
                    <td><?= htmlspecialchars($row["rsn"]); ?></td>
                    <td><?= htmlspecialchars($blocknormalstamp); ?></td>
                    <td class="td-actions text-center">
                        <?php if($admin['id64']== $_SESSION['steamid'] or isMasterAdmin($_SESSION['steamid'])){ ?>
                        <button data-tippy-content="Edit Information" onclick="EditBlock(`<?= htmlspecialchars($id64); ?>`)" class="btn btn-success btn-icon btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <?php } ?>
                        <button data-tippy-content="Unblock" onclick="UnBlock(`<?= htmlspecialchars($id64); ?>`)" value="<?= htmlspecialchars($id64); ?>" name="submit-unblock" class="btn btn-danger btn-icon btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>

                    </td>
                </tr>

            <?php
            }
            ?>
        <?php
        } else {
        ?>
            <script>
                AlertError("You're not an admin");
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            AlertError("Session expired");
        </script>
<?php
    }
}

if (isset($_POST['saveedit'])) {
    header('Content-type: application/json');
    $Msg = array(
        "success" => false,
        "Msg" => "Something went wrong!",
        "SysErr" => false
    );
    if (isset($_SESSION['steamid'])) {
        if (isAdmin($_SESSION['steamid'])) {
            $user = isBlocked($_POST['steamid']);
            if ($user['banned'] == true) {
                if ($user['admin']['id64'] == $_SESSION['steamid'] or isMasterAdmin($_SESSION['steamid'])) {
                    if (IsEmpty($_POST['reason'])) {
                        $Msg['ResonErr'] = "You must specify a reason!";
                    } else if (strlen($_POST['reason']) > 100) {
                        $Msg['ResonErr'] = "The reason you entered must be below 100 characters!";
                    }
                    if (!isset($Msg['ResonErr'])) {
                        $admininfo = SInfo($_SESSION['steamid']);
                        $adminname = $steamprofile['personaname'];
                        $logdata = array(
                            "User" => $admininfo,
                            "Msg" => "<a href='/sprofile/" . $_SESSION['steamid'] . "/' target='_blank'>$adminname</a> changed <a href='/sprofile/" . $user['userinfo']['id64'] . "/' target='_blank'>" . $user['userinfo']['name'] . "'s</a> block reason from <strong>" . $user['reason'] . "</strong> to <strong>" . $_POST['reason'] . "</strong>"
                        );
                        if (AdminLog($logdata)) {
                            try {
                                $query = SQLWrapper()->prepare("UPDATE blocked SET rsn = :rsn WHERE id64 = :user");
                                $query->execute([":rsn" => $_POST['reason'], ":user" => $_POST['steamid']]);
                                $Msg['success'] = true;
                                $Msg['Msg'] = $user['userinfo']['name'] . "'s ban has been updated!";
                            } catch (PDOException $e) {
                                SendError("MySQL Error", $e->getMessage());
                                $Msg["SysErr"] = true;
                                $Msg["Msg"] = "There was an error saving the data! Try again later!";
                            }
                        } else {
                            $Msg["SysErr"] = true;
                            $Msg["Msg"] = "There was an error logging the action, so it will not be performed! Try later!";
                        }
                    }
                } else {
                    $Msg["SysErr"] = true;
                    $Msg["Msg"] = "You must be the creator of the ban to edit it!";
                }
            } else {
                $Msg["SysErr"] = true;
                $Msg["Msg"] = "This user is not banned!";
            }
        } else {
            $Msg["SysErr"] = true;
            $Msg["Msg"] = "You're not an admin!";
        }
    } else {
        $Msg["SysErr"] = true;
        $Msg["Msg"] = "Session expired!";
    }
    die(json_encode($Msg));
}
