<?php

if (isset($_POST['edit'])) {
    if (isset($_SESSION['steamid'])) {
        if (isAdmin($_SESSION['steamid'])) {
            $user = SQLWrapper()->prepare("SELECT * FROM blocked WHERE id64 = :id64");
            $user->execute([":id64" => $_POST['steamid']]);
            $data = $user->fetch();
            $info =  json_decode($data['info'],true);
?>
            <script>    
                $("#edit-block-modal").modal('show');
            </script>
            <div class="modal" tabindex="-1" id="edit-block-modal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit <?=v($info['name']);?>'s Ban</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px">&times;</span>
                            </button>
                        </div>
                        <form>
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label>Reason</label>
                                    <input class="form-control form-control-alternative" placeholder="Please add a reason, it's required." value="<?=v($data['rsn']);?>">
                                </div>
                            
                        </div>
                        <div class="modal-footer" style="justify-content: center">
                            <button type="button" class="btn btn-success">Save changes</button>
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

            $unblockid = $_POST['id64'];
            $sqlunblock = SQLWrapper()->prepare("DELETE FROM blocked WHERE id64= :id");
            $sqlunblock->execute([':id' => $unblockid]);
            $Message['success'] = true;
            $Message['message'] = $unblockid . " has been unblocked!";
            $adminname = $steamprofile['personaname'];

            $logdata = array(
                "User"=> SInfo($_SESSION['steamid']),
                "Msg"=>"<a href='/sprofile/".$_SESSION['steamid']."/' target='_blank'>$adminname</a> unblocked <a href='/sprofile/".$unblockid."/' target='_blank'>".$unblockid."</a>"
            );

            ResourceLog("Action",$logdata,true);
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
                    $sqlblock = SQLWrapper()->prepare("INSERT INTO blocked (id64, rsn, stamp,info)
                 VALUES (?,?,?,?)")->execute([$user['id64'], $blockrsn, $blockstamp, $info]);
                    $Message['blockdate'] =  date("m/d/Y g:i a", $blockstamp);
                    $Message["success"] = true;
                    $Message['message'] = $user['name'] . " has been blocked";
                    $adminname = $steamprofile['personaname'];
                    $logdata = array(
                        "User"=> SInfo($_SESSION['steamid']),
                        "Msg"=>"<a href='/sprofile/".$_SESSION['steamid']."/' target='_blank'>$adminname</a> blocked <a href='/sprofile/".$user['id64']."/' target='_blank'>".$user['name']."</a> for <strong>$blockrsn</strong>"
                    );

                    ResourceLog("Action",$logdata,true);
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


            $sql = "SELECT info, rsn, stamp FROM blocked";
            $result = SQLWrapper()->query($sql);
            while ($row = $result->fetch()) {
                $info = json_decode($row['info'], true);
                $id64 = $info['id64'];
                $url = $info['url'];
                $name = $info['name'];
                $blocknormalstamp =  date("m/d/Y g:i a", $row["stamp"]);
        ?>

                <tr id="blocked-<?= htmlspecialchars($id64); ?>">

                    <td><a target="_blank" href="/sprofile/<?= htmlspecialchars($id64); ?>"><?= htmlspecialchars($name); ?></a></td>
                    <td><?= htmlspecialchars($row["rsn"]); ?></td>
                    <td><?= htmlspecialchars($blocknormalstamp); ?></td>
                    <td class="td-actions text-center">
                        <button data-tippy-content="Edit Information" onclick="EditBlock(`<?= htmlspecialchars($id64); ?>`)" class="btn btn-success btn-icon btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
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
