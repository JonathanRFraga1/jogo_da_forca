<?php

$senha = 'jrf18112001';

$password = password_hash($senha, PASSWORD_DEFAULT);

echo $password;

?>