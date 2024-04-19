<?php
 require 'constants.php';
 $connetion =new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(mysqli_error($connetion)) {
    die(mysqli_error($connetion));
}
