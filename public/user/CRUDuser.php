<?php

session_start();
$sql = "SELECT * FROM `user` WHERE `pseudo` LIKE '$pseudo'";
$user = $pdo->query($sql)->fetchAll();
$id = $user[0];
$_SESSION['id'] = $user[0];
$_SESSION ['pseudo'] = $user[1];


$modifyPseudo = $pdo->query( "update `user` SET `pseudo` = $newPseudo WHERE `user`.`id` = $id");
$modifyPwd = $pdo->query( "update `user` SET `pwd` = $newPwd WHERE `user`.`id` = $id");
$modifyMail = $pdo->query( "update `user` SET `mail` = $newMail WHERE `user`.`id` = $id");
$modifyAge = $pdo->query( "update `user` SET `age` = $newAge WHERE `user`.`id` = $id");
$modifyName = $pdo->query( "update `user` SET `name` = $newName WHERE `user`.`id` = $id");
$modifyFirstName = $pdo->query( "update `user` SET `firstName` = $newFirstName WHERE `user`.`id` = $id");

