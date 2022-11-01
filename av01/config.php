<?php

$db_name = "alunos01";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
//Variáveis sendo preparadas para serem usadas como classes.

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);
//sendo criado o objeto pdo.