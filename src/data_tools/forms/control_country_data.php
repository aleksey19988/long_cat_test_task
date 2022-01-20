<?php
require_once '../forms_handlers/control_country_handler.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Добавить страну</title>
</head>

<body>
    <div class="container">
        <h2 class="mt-5 mb-5">Добавить страну</h2>
        <form action="../forms_handlers/control_country_handler.php" method="post">
            <div class="mb-3">
                <label for="add-country" class="form-label">Название страны</label>
                <input type="text" class="form-control" id="add-country" name="country" required>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
    <div class="container mt-5">
        <h2>Список всех стран</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Страна</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($countriesList as $arr => $country): ?>
                    <tr>
                        <td value="<?= $country['name']; ?>" id="countryName"><?= $country['name']; ?></td>
                        <td id="getCountryName()"><button type="button" class="btn btn-outline-dark deleteBtn" onclick="getNeighbor(this)">Удалить</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<script src="../forms_handlers/deleteLine.js"></script>