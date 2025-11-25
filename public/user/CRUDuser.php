<?php

session_start();
$sql = "SELECT * FROM `user` WHERE `pseudo` LIKE '$pseudo'";
$user = $pdo->query($sql)->fetchAll();
$_SESSION['id'] =
$id =

UPDATE `user` SET `pseudo` = 'jeffbnd' WHERE `user`.`id` = 1

