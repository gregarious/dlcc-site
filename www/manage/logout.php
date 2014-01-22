<?php

session_start();
session_destroy();

header("Location: /pittsburghcc/muffintest/manage/login.php");
exit;
