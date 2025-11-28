<?php


?>

<head>
    <style>
        img{
            width: 100%;
        }

    #container-nav{
        border-top: 1px solid grey;
        height: 160px;
        width: 100vw;
        position: fixed;
        bottom: 0;
        left: 0;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 0 100px;
    }

    .icon-nav{
        width: 60px;
    }
    </style>
</head>

<section id="container-nav">
    <a href="?page=dashboard">
        <div class="icon-nav">
            <img src="./assets/images/nav/Home.png" alt="Bouton Home navigation">
        </div>
    </a>
    <a href="?page=events">
        <div class="icon-nav">
            <img src="./assets/images/nav/event.png" alt="Bouton event navigation">
        </div>
    </a>
    <a href="?page=alerts">
        <div class="icon-nav">
            <img src="./assets/images/nav/alert.png" alt="Bouton alert navigation">
        </div>
    </a>
    <a href="?page=profile">
        <div class="icon-nav">
            <img src="./assets/images/nav/profil.png" alt="Bouton profil navigation">
        </div>
    </a>
</section>