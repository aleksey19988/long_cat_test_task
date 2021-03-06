<?php
require_once './src/db_config/db_connect.php';
require_once './src/data_tools/sort_tools/sorted_data.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
    <title>Медальный зачёт</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-5">Медальный зачёт</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" id="position-sort" value="Место">Место</a></th>
                    <th scope="col" id="country-sort" value="Страна">Страна</th>
                    <th scope="col" id="first-position-sort" value="1-position"><img src="icons/medals/medal_1.png" alt="1 место" width="40" height="40"></th>
                    <th scope="col" id="second-position-sort" value="2-position"><img src="icons/medals/medal_2.png" alt="2 место" width="40" height="40"></th>
                    <th scope="col" id="third-position-sort" value="3-position"><img src="icons/medals/medal_3.png" alt="3 место" width="40" height="40"></th>
                    <th scope="col" id="all-medals-number-sort" value="number-of-medals">Сумма медалей</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($countriesList as $country => $properties): ?>
                <tr>
                    <td><?= $properties['position'] ?></td>
                    <td><?= $properties['name']; ?></td>
                    <td>
                        <a class="medal-type-link" href="src/country_medals_data/country_medals_data.php?country-name=<?=$properties['name']?>&medals-type-id=1"><?= $properties['medals']['1'] >= 1 ? $properties['medals']['1'] : 0; ?></a>
                    </td>
                    <td>
                        <a class="medal-type-link" href="src/country_medals_data/country_medals_data.php?country-name=<?=$properties['name']?>&medals-type-id=2"><?= $properties['medals']['2'] >= 1 ? $properties['medals']['2'] : 0; ?></a>
                    </td>
                    <td>
                        <a class="medal-type-link" href="src/country_medals_data/country_medals_data.php?country-name=<?=$properties['name']?>&medals-type-id=3"><?= $properties['medals']['3'] >= 1 ? $properties['medals']['3'] : 0; ?></a>
                    </td>
                    <td>
                        <a class="medal-type-link" href="src/country_medals_data/country_medals_data.php?country-name=<?=$properties['name']?>&medals-type-id=all"><?= $properties['medals']['count'] >= 1 ? $properties['medals']['count'] : 0; ?></a>
                    </td>
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
<script src="./src/data_tools/sort_tools/sort_listener.js"></script>