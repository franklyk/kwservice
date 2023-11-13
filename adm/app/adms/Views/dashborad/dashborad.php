<?php 

    echo "VIEW - Página Dashborad!<br>";
    echo $this->data . " " . $_SESSION['user_name'] . "! <br>";
    echo "<a href='".URLADM."'>Sair</a>";

?>