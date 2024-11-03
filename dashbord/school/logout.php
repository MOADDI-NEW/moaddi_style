<?php

session_start();  // strst the Session
session_unset();  // unset the Data
session_destroy(); // destroy the session
header('location: ../index');
exit();
