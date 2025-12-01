<h2> modifier votre profil</h2> <br>

<p>votre pseudo actuelle est :</p>
<?php
echo $_SESSION['pseudo'];
?>
<a href="?page=modifyPseudo"> modifier le pseudo</a>

<p>votre email actuelle est :</p>
<?php
echo $_SESSION['email'];
?>
<a href="?page=modifyEmail"> modifier l'email</a>

<p>votre prenom actuelle est :</p>
<?php
echo $_SESSION['firstName'];
?>
<a href="?page=modifyFirstName"> modifier le prenom</a>

<p>votre nom actuelle est :</p>
<?php
echo $_SESSION['name'];
?>
<a href="?page=modifyName"> modifier le nom</a>


<a href="?page=modifyPwd"> modifier le mot de passe </a>