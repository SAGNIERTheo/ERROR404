<style>
    body {
        font-family: "Segoe UI", Roboto, sans-serif;
        background: #f5f7fa;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .form-container {
        background: white;
        width: 450px;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 2px solid #2A2B2D;
    }

    h2 {
        text-align: center;
        color: #0049F0;
        margin-bottom: 25px;
        font-size: 28px;
        border-bottom: 2px solid #0049F0;
        padding-bottom: 10px;
    }

    label {
        font-weight: 600;
        color: #2A2B2D;
        display: block;
        margin-bottom: 6px;
        margin-top: 15px;
    }

    input, textarea {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 2px solid #ccc;
        font-size: 15px;
        transition: 0.3s;
    }

    input:focus, textarea:focus {
        border-color: #0049F0;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 73, 240, 0.4);
    }
    .btn-submit {
        margin-top: 25px;
        width: 100%;
        padding: 14px;
        background: #0049F0;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
        transition: 0.2s;
    }

    .btn-submit:hover {
        background: #0037b8;
    }
</style>


<div class="form-container">
    <h2>Créer un événement</h2>

    <form action="" method="POST">

        <label for="name">Nom de l'événement</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Prix (€)</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="startDate">Date & heure de début</label>
        <input type="datetime-local" id="startDate" name="startDate" required>

        <label for="endDate">Date & heure de fin</label>
        <input type="datetime-local" id="endDate" name="endDate" required>

        <label for="location">Lieu</label>
        <input type="text" id="location" name="location" required>

        <label for="closeRegister">Fin des inscriptions</label>
        <input type="date" id="closeRegister" name="closeRegister" required>

        <label for="img">Lien de l'image</label>
        <input type="url" id="img" name="img" placeholder="https://exemple.com/image.jpg" required>

        <button type="submit" class="btn-submit">Créer l'événement</button>
    </form>

</div>

<?php

if(isset($_POST) && !empty($_POST)){
    if(!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['startDate']) && !empty($_POST['endDate']) && !empty($_POST['location']) && !empty($_POST['closeRegister']) && !empty($_POST['img'])){
        $name = htmlspecialchars(trim($_POST['name']));
        $price = htmlspecialchars(trim($_POST['price']));
        $startDate =htmlspecialchars(trim($_POST['endDate']));
        $location = htmlspecialchars(trim($_POST['location']));
        $closeRegister = htmlspecialchars(trim($_POST['closeRegister']));
        $img = htmlspecialchars(trim($_POST['img']));
    }
}