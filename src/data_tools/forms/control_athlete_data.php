<?php
require_once '../forms_handlers/control_athlete_handler.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Добавить спортсмена</title>
</head>

<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/long_cat_test_task">Home page</a>
    </div>
</nav>
<div class="container">
    <h2 class="mt-5 mb-5">Добавить спортсмена</h2>
    <form action="../forms_handlers/control_athlete_handler.php" method="post">
        <div class="mb-3">
            <label for="add-athlete" class="form-label">ФИО спортсмена</label>
            <input type="text" class="form-control" id="add-athlete" name="athlete" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
<div class="container mt-5">
    <h2>Список всех спортсменов</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Спортсмен</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($athletesList as $arr => $athlete): ?>
            <tr>
                <td value="<?= $athlete['name']; ?>" id="athleteName"><?= $athlete['name']; ?></td>
                <td id=""><button type="button" class="btn btn-outline-dark deleteBtn" onclick="getNeighbor(this)">Удалить</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>

</html>
<script src="../forms_handlers/deleteLine.js"></script>