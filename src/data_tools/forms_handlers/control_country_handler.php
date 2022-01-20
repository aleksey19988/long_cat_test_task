<?php
require_once '../../../src/db_config/db_connect.php';

//Здесь смотрим, передалось ли какое-то значение и если оно есть - записываем в БД
if (count($_POST) > 0) {
    $country = htmlspecialchars($_POST['country']);
    $query = "INSERT INTO countries (name) VALUES ('{$country}')";
    $conn->query($query);//Переменную $conn взяли из подключенного файла db_connect.php

    $currentUrlInArr = explode('/', "$_SERVER[REQUEST_URI]");
    $currentFileNameInArr = explode('_',$currentUrlInArr[count($currentUrlInArr) - 1]);//Разбиваем имя файла для дальнейшего пормирования url-адреса и последующего редиректа
    $redirectUrl = '';

    for ($i = 0; $i < count($currentUrlInArr) - 2; $i++) {//Тут частично собиираем прототип конечного адреса для редиректа (ещё не полностью)
        $redirectUrl .= "{$currentUrlInArr[$i]}/";
    }

    $redirectUrl = "http://$_SERVER[HTTP_HOST]{$redirectUrl}forms/{$currentFileNameInArr[0]}_{$currentFileNameInArr[1]}_data.php";
    header('Location: ' . $redirectUrl);
} elseif (count($_GET) > 0) {
    $country = htmlspecialchars($_GET['country']);

    if (strlen($country) <= 0) {
        print_r("Страна не найдена!\n");
    } else {
        $query = "SELECT * FROM countries WHERE name='{$country}'";
        $queryResult = $conn->query($query);//Переменную $conn взяли из подключенного файла db_connect.php
        if (count($queryResult->fetchAll()) < 1) {
            print_r("В таблице не найдена страна!");
        } else {
            $query = "DELETE FROM countries WHERE name='{$country}'";

            $queryResult = $conn->query($query);//Переменную $conn взяли из подключенного файла db_connect.php
            $currentUrlWithoutParameters = explode('?',"$_SERVER[REQUEST_URI]")[0];//Убрали GET-параметры
            $currentUrlInArr = explode('/',"$currentUrlWithoutParameters");
            $currentFileNameInArr = explode('_',$currentUrlInArr[count($currentUrlInArr) - 1]);//Разбиваем имя файла для дальнейшего пормирования url-адреса и последующего редиректа
            $redirectUrl = '';

            for ($i = 0; $i < count($currentUrlInArr) - 2; $i++) {//Тут частично собиираем прототип конечного адреса для редиректа (ещё не полностью)
                $redirectUrl .= "{$currentUrlInArr[$i]}/";
            }

            $redirectUrl = "http://$_SERVER[HTTP_HOST]{$redirectUrl}forms/{$currentFileNameInArr[0]}_{$currentFileNameInArr[1]}_data.php";
            header('Location: ' . $redirectUrl);

        }
    }
}

$query = "SELECT * FROM countries ORDER BY name";
$countriesList = $conn->query($query)->fetchAll();

return $countriesList;