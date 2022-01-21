<?php
require_once './src/db_config/db_connect.php';

$linesCounter = 1;
$countries = $conn->query("SELECT * FROM countries")->fetchAll();
$medalTypeList = $conn->query("SELECT * FROM medal_types")->fetchAll();
$medalsList = $conn->query("SELECT * FROM medals")->fetchAll();

//Тут добавляем в массив каждую страну отдельно со своим id
$countriesList = [];
foreach($countries as $countriesInArr => $country) {
//    if (!array_key_exists($country['name'], $countriesList)) {
        $countriesList[$country['id']] = [
                'name' => $country['name'],
                'medals' => [
                    'count' => 0,
                ],
        ];
//    }
}

//Тут заполняю в массиве со странами подмассив medals (общее кол-во и кол-во по типу медали по отдельности)
foreach($medalsList as $medalsInArr => $medal) {
    $medalTypeId = $medal['type_id'];

    if (!array_key_exists($medalTypeId, $countriesList[$medal['country_id']]['medals'])) {
        $countriesList[$medal['country_id']]['medals'][$medalTypeId] = 1;
    } else {
        $countriesList[$medal['country_id']]['medals'][$medalTypeId] += 1;
    }
    $countriesList[$medal['country_id']]['medals']['count'] += 1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Медальный зачёт</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-5">Медальный зачёт</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Место</th>
                    <th scope="col">Страна</th>
                    <th scope="col"><img src="icons/medals/medal_1.png" alt="1 место" width="40" height="40"></th>
                    <th scope="col"><img src="icons/medals/medal_2.png" alt="2 место" width="40" height="40"></th>
                    <th scope="col"><img src="icons/medals/medal_3.png" alt="3 место" width="40" height="40"></th>
                    <th scope="col">Сумма медалей</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($countriesList as $country => $properties): ?>
                <tr>
                    <td><?= $linesCounter++ ?></td>
                    <td><?= $properties['name']; ?></td>
                    <td><?= $properties['medals']['1'] >= 1 ? $properties['medals']['1'] : 0; ?></td>
                    <td><?= $properties['medals']['2'] >= 1 ? $properties['medals']['2'] : 0; ?></td>
                    <td><?= $properties['medals']['3'] >= 1 ? $properties['medals']['3'] : 0; ?></td>
                    <td><?= $properties['medals']['count'] >= 1 ? $properties['medals']['count'] : 0; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <a class="list-group">
            <a href="src/data_tools/forms/control_country_data.php">
                <button type="button" class="list-group-item list-group-item-action" aria-current="true">
                    <p>Добавить страну</p>
                </button>
            </a>
            <a href="src/data_tools/forms/control_medal_data.php">
                <button type="button" class="list-group-item list-group-item-action" aria-current="true">
                    <p>Добавить медаль</p>
                </button>
            </a>
            <a href="src/data_tools/forms/control_sport_data.php">
                <button type="button" class="list-group-item list-group-item-action" aria-current="true">
                    <p>Добавить вид спорта</p>
                </button>
            </a>
            <a href="src/data_tools/forms/control_athlete_data.php">
                <button type="button" class="list-group-item list-group-item-action" aria-current="true">
                    <p>Добавить спортсмена</p>
                </button>
            </a>
        </div>
    </div>
</body>
</html>