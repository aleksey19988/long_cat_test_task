<?php
require_once '../../../src/db_config/db_connect.php';

//Здесь смотрим, передалось ли какое-то значение и если оно есть - записываем в БД
if (count($_POST) > 0) {
    $maxAthletesCount = 5;

    $medalType = htmlspecialchars($_POST['medal-type']);
    $countryName = htmlspecialchars($_POST['country']);
    $sportName = htmlspecialchars($_POST['sport-type']);

    $athletesNames = [];
    for ($i = 1; $i <= $maxAthletesCount; $i++) {
        $athleteName = $_POST["athlete-{$i}"];
        if (strlen($athleteName) > 1) {
            $athletesNames[] = $athleteName;
        }
    }

    $athletesId = [];

    foreach ($athletesNames as $name) {
        $athleteId = $conn->query("SELECT id FROM athletes WHERE name='{$name}'")->fetchAll(PDO::FETCH_COLUMN, 0);
        $athletesId[] = $athleteId[0];
    }

    $countryId = (int) $conn->query("SELECT id FROM countries WHERE name='{$countryName}'")->fetchAll(PDO::FETCH_COLUMN, 0)[0];//смотрим в столбец ID и получаем значение
    $medalTypeId = (int) $conn->query("SELECT id FROM medal_types WHERE type='{$medalType}'")->fetchAll(PDO::FETCH_COLUMN, 0)[0];
    $sportId = (int) $conn->query("SELECT id FROM sports WHERE name='{$sportName}'")->fetchAll(PDO::FETCH_COLUMN, 0)[0];
    $athletesIdJSON = json_encode($athletesId);

    $conn->query("INSERT INTO medals (type_id, country_id, sport_id, athletes_names) VALUES ('{$medalTypeId}', '{$countryId}', '{$sportId}', '{$athletesIdJSON}')");

    $currentUrlInArr = explode('/', "$_SERVER[REQUEST_URI]");
    $currentFileNameInArr = explode('_',$currentUrlInArr[count($currentUrlInArr) - 1]);//Разбиваем имя файла для дальнейшего пормирования url-адреса и последующего редиректа
    $redirectUrl = '';

    for ($i = 0; $i < count($currentUrlInArr) - 2; $i++) {//Тут частично собиираем прототип конечного адреса для редиректа (ещё не полностью)
        $redirectUrl .= "{$currentUrlInArr[$i]}/";
    }

    $redirectUrl = "http://$_SERVER[HTTP_HOST]{$redirectUrl}forms/{$currentFileNameInArr[0]}_{$currentFileNameInArr[1]}_data.php";
    header('Location: ' . $redirectUrl);
} elseif (count($_GET) > 0) {
    $medalId = htmlspecialchars($_GET['medalId']);

    if (strlen($medalId) <= 0) {
        print_r("Медаль не найдена!\n");
    } else {
        $query = "SELECT * FROM medals WHERE id='{$medalId}'";
        $queryResult = $conn->query($query);//Переменную $conn взяли из подключенного файла db_connect.php
        if (count($queryResult->fetchAll()) < 1) {
            print_r("В таблице не найдена медаль!");
        } else {
            $query = "DELETE FROM medals WHERE id='{$medalId}'";

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

$query = "SELECT * FROM medals ORDER BY id";
$medalsList = $conn->query($query)->fetchAll();

return $medalsList;