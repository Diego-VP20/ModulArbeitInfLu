<?php

// Self-explanatory...

session_start();
session_unset();
session_destroy();
header('location: ../session/login.php?error=logout');