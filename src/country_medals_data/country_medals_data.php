<?php
require_once '../db_config/db_connect.php';
require_once '../data_tools/get_data_tools.php';

use function Long\Cat\Test\Task\Data\Tools\Get\Data\Tools\getSportName as getSportName;
use function Long\Cat\Test\Task\Data\Tools\Get\Data\Tools\getAthletesNames as getAthletesNames;
use function Long\Cat\Test\Task\Data\Tools\Get\Data\Tools\getMedalTypeName as getMedalTypeName;

$countryName = $_GET['country-name'];
$medalsTypeId = $_GET['medals-type-id'];
$lineNumCounter = 1;

//Получаем id страны для последующего получения медалей
$countryId = $conn->query("SELECT id FROM countries WHERE name='{$countryName}'")->fetchAll(PDO::FETCH_COLUMN)[0];

//Проверяем, на какие медали кликнул пользователь
if ($medalsTypeId !== 'all') {
    $medals = $conn->query("SELECT * FROM medals WHERE country_id='{$countryId}' AND type_id='{$medalsTypeId}'")->fetchAll();

    //Получаем название медалей и преобразуем его во множественное число для последующего использования в заголовке страницы
    $medalTypeName = $conn->query("SELECT type FROM medal_types WHERE id='{$medalsTypeId}'")->fetchAll()[0]['type'];
    $medalTypeName = substr($medalTypeName, 0, -4) . 'ые';
} else {
    $medals = $conn->query("SELECT * FROM medals WHERE country_id='{$countryId}'")->fetchAll();
    $medalTypeName = 'Все';
}

$medalsList = [];
$medalsCounter = 1;
foreach($medals as $medal => $properties) {
    $medalsList[$medalsCounter]['sportName'] = getSportName($conn, $properties['sport_id']);
    $medalsList[$medalsCounter]['medalTypeName'] = getMedalTypeName($conn, $properties['type_id']);
    $medalsList[$medalsCounter]['athletesNames'] = getAthletesNames($conn, $properties['athletes_id']);
    $medalsCounter++;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?= ucfirst($medalTypeName) ?> медали страны <?= $countryName ?></title>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/long_cat_test_task">Home page</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h1><?= ucfirst($medalTypeName) ?> медали страны <?= $countryName ?></h1>
    </div>
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Вид спорта</th>
                <th scope="col">Участник(-и)</th>
                <?php if ($medalTypeName === 'Все'):?>
                <th scope="col">Тип медали</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach($medalsList as $medal => $properties): ?>
                <tr>
                    <td><?= $lineNumCounter++ ?></td>
                    <td><?= $properties['sportName']; ?></td>
                    <td>
                        <ul>
                            <?php foreach($properties['athletesNames'] as $athlete => $athleteProperty): ?>
                                <li><?= $athleteProperty['name'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <?php if ($medalTypeName === 'Все'):?>
                    <td><?= $properties['medalTypeName']?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
