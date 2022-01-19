<?php
require_once '../../../src/db_config/db_connect.php';

//Здесь смотрим, передалось ли какое-то значение и если оно есть - записываем в БД
if (count($_POST) > 0) {
    $country = htmlspecialchars($_POST['country']);
    $query = "INSERT INTO countries (name) VALUES ('{$country}')";
    $conn->query($query);

    $redirectUrl = '../forms/control_country_data.php';
    header('Location: ' . $redirectUrl);
}

$query = "SELECT * FROM countries ORDER BY name";
$countriesList = $conn->query($query)->fetchAll();

return $countriesList;