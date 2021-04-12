<?php

 
 session_start();
 unset($_SESSION['Role']);

 header('Location: login.php');

  ?>