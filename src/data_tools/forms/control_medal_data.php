<?php
require_once '../forms_handlers/control_medal_handler.php';
require_once '../../db_config/db_connect.php';

$medalTypeList = $conn->query("SELECT * FROM medal_types ORDER BY id")->fetchAll();
$countriesList = $conn->query("SELECT * FROM countries ORDER BY id")->fetchAll();
$sportsList = $conn->query("SELECT * FROM sports ORDER BY id")->fetchAll();
$athletesList = $conn->query("SELECT * FROM athletes ORDER BY id")->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Добавить медаль</title>
</head>

<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/long_cat_test_task">Home page</a>
    </div>
</nav>
<div class="container">
    <h2 class="mt-5 mb-5">Добавить медаль</h2>
    <form action="../forms_handlers/control_medal_handler.php" method="post">
        <div class="mb-3 form-floating">
            <select class="form-select" aria-label="medal-type" name="medal-type" id="medal-type">
                <?php foreach($medalTypeList as $arr => $medal): ?>
                    <option value="<?= $medal['type']; ?>"><?= $medal['type']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="medal-type">Выберите тип медали</label>
        </div>
        <div class="mb-3 form-floating">
            <select class="form-select" aria-label="country" name="country" id="country">
                <?php foreach($countriesList as $arr => $country): ?>
                    <option value="<?= $country['name']; ?>"><?= $country['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="country">Выберите страну</label>
        </div>
        <div class="mb-3 form-floating">
            <select class="form-select" aria-label="sport-type" name="sport-type" id="sport-type">
                <?php foreach($sportsList as $arr => $sport): ?>
                    <option value="<?= $sport['name']; ?>"><?= $sport['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="sport-type">Выберите вид спорта</label>
        </div>
        <div class="mb-3 form-floating">
            <select class="form-select" aria-label="select-athlete-1" name="athlete-1" id="select-athlete-1">
                <?php foreach($athletesList as $arr => $athlete): ?>
                    <option value="<?= $athlete['name']; ?>"><?= $athlete['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="select-athlete-1">Выберите спортсмена</label>
        </div>
        <div class="mb-3 form-floating">
            <select class="form-select" aria-label="select-athlete-2" name="athlete-2" id="select-athlete-2">
                <option value="">Выберите (необязательно)</option>
                <?php foreach($athletesList as $arr => $athlete): ?>
                    <option value="<?= $athlete['name']; ?>"><?= $athlete['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="select-athlete-2">Выберите спортсмена</label>
        </div>
        <div class="mb-3 form-floating">
            <select class="form-select" aria-label="select-athlete-3" name="athlete-3" id="select-athlete-3">
                <option value="">Выберите (необязательно)</option>
                <?php foreach($athletesList as $arr => $athlete): ?>
                    <option value="<?= $athlete['name']; ?>"><?= $athlete['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="select-athlete-3">Выберите спортсмена</label>
        </div>
        <div class="mb-3 form-floating">
            <select class="form-select" aria-label="select-athlete-4" name="athlete-4" id="select-athlete-4">
                <option value="">Выберите (необязательно)</option>
                <?php foreach($athletesList as $arr => $athlete): ?>
                    <option value="<?= $athlete['name']; ?>"><?= $athlete['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="select-athlete-4">Выберите спортсмена</label>
        </div>
        <div class="mb-3 form-floating">
            <select class="form-select" aria-label="select-athlete-5" name="athlete-5" id="select-athlete-5">
                <option value="">Выберите (необязательно)</option>
                <?php foreach($athletesList as $arr => $athlete): ?>
                    <option value="<?= $athlete['name']; ?>"><?= $athlete['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="select-athlete-5">Выберите спортсмена</label>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
<div class="container mt-5">
    <h2>Список всех медалей</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Медаль</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($medalsList as $arr => $medal): ?>
            <tr>
                <td value="<?= $medal['id']; ?>" id="medalId">#<?= $medal['id']; ?></td>
                <td id=""><button type="button" class="btn btn-outline-dark deleteBtn" onclick="getNeighbor(this)">Удалить</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>

</html>
<script src="../forms_handlers/deleteLine.js"></script>