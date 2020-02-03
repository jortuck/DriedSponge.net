<?php
if (isset($_POST['newpage'])) {
    header('Content-type: application/json');
    $Message = array(
        "success" => false,
        "SysError" => false,
        "basics" => false,
        "errorNAME" => false,
        "errorNAMETXT" => null,
        "errorPAGEID" => false,
        "errorPAGEIDTXT" => null,
        "message" => "Something went wrong I guess"
    );
    if (isset($_SESSION['steamid'])) {
        if (isMasterAdmin($_SESSION['steamid'])) {

            $Message["basics"] = true;
            $pageid = $_POST["pageid"];
            $pagename = $_POST['pagename'];

            if(empty($pagename)){
                $Message["errorNAME"] = true;
                $Message["errorNAMETXT"] = "The page name cannot be empty!";
            }else if(strlen($pagename) > 50){
                $Message["errorNAME"] = true;
                $Message["errorNAMETXT"] = "The page name cannot be longer than 50 characters!";
            }

            if(empty($pageid)){
                $Message["errorPAGEID"] = true;
                $Message["errorPAGEIDTXT"] = "The PageID cannot be empty!";
            }else if(strlen($pageid) > 50){
                $Message["errorPAGEID"] = true;
                $Message["errorPAGEIDTXT"] = "The PageID cannot be longer than 50 characters!";
            }else if(preg_match('/\s/',$pageid)){
                $Message["errorPAGEID"] = true;
                $Message["errorPAGEIDTXT"] = "The PageID cannot contain spaces!";
            }

            if ($Message["basics"] && !$Message["errorNAME"] && !$Message["errorPAGEID"]) {
                $pagename = $_POST['pagename'];
                $pageid = str_replace(" ", "", $pageid);
                $pageslug = $pageid;
                $newpq = SQLWrapper()->prepare("INSERT INTO content (thing,title,created,slug)VALUES (?,?,?,?)")->execute([$pageid, $pagename, $_SESSION['steamid'], $pageslug]);
                $Message['success'] = true;
                $Message['message'] = "The ".$pagename." page has successfully been created!";
            }
        } else {
            $Message["SysError"] = true;
            $Message["message"] = "Unauthorized";
        }
    } else {
        $Message["SysError"] = true;
        $Message["message"] = "Not logged in";
    }
    die(json_encode($Message));
}

if (isset($_POST['deletepage'])) {

    if (isset($_SESSION['steamid'])) {
        if (isMasterAdmin($_SESSION['steamid'])) {
            $pagesq = SQLWrapper()->prepare("SELECT thing,created,title FROM content WHERE thing = :pageid");
            $pagesq->execute([':pageid' => $_POST['pageid']]);
            $row = $pagesq->fetch();
?>
            <div class="modal" id="delete-page" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="deleteModalLabel">Delete the <?= htmlspecialchars($row["title"]); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left paragraph">
                            Are you sure you want to delete the <?= htmlspecialchars($row["title"]); ?>? Doing this will erase all of it's contents and data.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <button onclick="delpage(`<?= htmlspecialchars($row['thing']); ?>`,`<?= htmlspecialchars($row['title']); ?>`)" class="btn btn-danger">Delete</button>

                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }
}

if (isset($_POST["delpage"])) {
    header('Content-type: application/json');
    $Message = array(
        "success" => false,
        "message" => "Something went wrong I guess"
    );
    if (isset($_SESSION['steamid'])) {
        if (isMasterAdmin($_SESSION['steamid'])) {


            $pagename = $_POST['pagename'];
            $pageid = $_POST['pageid'];
            $deletepageq = SQLWrapper()->prepare("DELETE FROM content WHERE thing= :thing");
            $deletepageq->execute([':thing' => $pageid]);
            $Message = array(
                "success" => true,
                "message" => $pagename." has been deleted!"
            );
        } else {
            $Message["message"] = "Unauthorized";
        }
    } else {

        $Message["message"] = "Not logged in";
    }
    die(json_encode($Message));
}
