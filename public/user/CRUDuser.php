<?php

session_start();
$sql = "SELECT * FROM `user` WHERE `pseudo` LIKE '$pseudo'";
$user = $pdo->query($sql)->fetchAll();
$id = $user[0];
$_SESSION['id'] = $id;


$modifyPseudo = $pdo->query( "update `user` SET `pseudo` = $newPseudo WHERE `user`.`id` = $id");
$modifyPwd = $pdo->query( "update `user` SET `pseudo` = $newPwd WHERE `user`.`id` = $id");
$modifyMail = $pdo->query( "update `user` SET `pseudo` = $newMail WHERE `user`.`id` = $id");
$modifyAge = $pdo->query( "update `user` SET `pseudo` = $newAge WHERE `user`.`id` = $id");
$modifyName = $pdo->query( "update `user` SET `pseudo` = $newName WHERE `user`.`id` = $id");
$modifyFirstName = $pdo->query( "update `user` SET `pseudo` = $newFirstName WHERE `user`.`id` = $id");

