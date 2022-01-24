<?php
namespace Long\Cat\Test\Task\Data\Tools\Sort\Tools\Sorted\Data;

use http\Header;

require_once './src/db_config/db_connect.php';

$lineNumCounter = 1;

$sortParameters = [
    'parameter' => $_GET['parameter'],
    'direction' => $_GET['direction'],
];

$countries = null;

if ($sortParameters['parameter'] === 'Страна') {
    $countries = $conn->query("SELECT * FROM countries ORDER BY '${$sortParameters['direction']}'")->fetchAll();
} else {
    $countries = $conn->query("SELECT * FROM countries ORDER BY 'ASC'")->fetchAll();
}

$medalTypeList = $conn->query("SELECT * FROM medal_types")->fetchAll();
$medalsList = $conn->query("SELECT * FROM medals")->fetchAll();

//Тут добавляем в массив каждую страну отдельно со своим id
$countriesList = [];
foreach($countries as $countriesInArr => $country) {
    $countriesList[$country['id']] = [
        'position' => $lineNumCounter,
        'name' => $country['name'],
        'medals' => [
            'count' => 0,
        ],
    ];
    $lineNumCounter++;
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

return $countriesList;