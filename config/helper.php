<?php

/**
 * Check if a user is currrently logged in or not
 */
function isLoggedIn() {
    if(!isset($_SESSION['user_id'])) {
        header("Location: ../auth/login.php");
        exit();
    }
}