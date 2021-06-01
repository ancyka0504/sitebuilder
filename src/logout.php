<?php
    session_start();
    session_destroy();

    header("Location: http://localhost:8888/LemanAndrea_sitebuilder/src/index.php");
