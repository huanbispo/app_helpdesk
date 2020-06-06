<?php

    session_start();

    echo '<pre>';
    print_r($_SESSION);
    echo '<pre>';

    session_destroy(); // será destruida
    //forçar um redirecionamento

    header('Location: /app_helpdesk/Public/index.php');


?>
