<?php
require_once '../../../src/db_config/db_connect.php';

//Здесь смотрим, передалось ли какое-то значение и если оно есть - записываем в БД
if (count($_POST) > 0) {
    $athlete = htmlspecialchars($_POST['athlete']);
    $query = "INSERT INTO athletes (name) VALUES ('{$athlete}')";
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
    $athlete = htmlspecialchars($_GET['athlete']);

    if (strlen($athlete) <= 0) {
        print_r("Не был передан спортсмен!\n");
    } else {
        $query = "SELECT * FROM athletes WHERE name='{$athlete}'";
        $queryResult = $conn->query($query);//Переменную $conn взяли из подключенного файла db_connect.php
        if (count($queryResult->fetchAll()) < 1) {
            print_r("В таблице не найден такой смортсмен!");
        } else {
            $query = "DELETE FROM athletes WHERE name='{$athlete}'";

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

$query = "SELECT * FROM athletes ORDER BY name";
$athletesList = $conn->query($query)->fetchAll();

return $athletesList;