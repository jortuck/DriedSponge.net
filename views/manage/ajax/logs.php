<?php
if(isset($_POST['load'])){
    if(isset($_SESSION['steamidd'])){

    }else{
    ?>
    <script>
        AlertError("Session expired!");
    </script>
    <?php
    }
}
