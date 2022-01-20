<?php
require_once '../forms_handlers/control_sport_handler.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Добавить вид спорта</title>
</head>

<body>
<div class="container">
    <h2 class="mt-5 mb-5">Добавить вид спорта</h2>
    <form action="../forms_handlers/control_sport_handler.php" method="post">
        <div class="mb-3">
            <label for="add-sport" class="form-label">Название вида спорта</label>
            <input type="text" class="form-control" id="add-sport" name="sport" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
<div class="container mt-5">
    <h2>Список всех видов спорта</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Вид спорта</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($sportsList as $arr => $sport): ?>
            <tr>
                <td value="<?= $sport['name']; ?>" id="sportName"><?= $sport['name']; ?></td>
                <td id=""><button type="button" class="btn btn-outline-dark deleteBtn" onclick="getNeighbor(this)">Удалить</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>

</html>
<script src="../forms_handlers/deleteLine.js"></script>
