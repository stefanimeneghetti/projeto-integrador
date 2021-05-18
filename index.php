<?php
include_once("views/layout/header.php");
?>   
    <?php include_once("views/layout/side-bar.php"); ?>
    <main>
    <?php
    if(isset($_GET['acao'])){
        include_once("views/{$_GET['acao']}.php");
    }
    else{
        include_once("views/dashboard.php");
    }
    ?>
    </main>
<?php
include_once("views/layout/footer.php");
?>