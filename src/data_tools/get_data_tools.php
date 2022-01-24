<?php
namespace Long\Cat\Test\Task\Data\Tools\Get\Data\Tools;

function getSportName($connection, $sportId)
{
    return $connection->query("SELECT name FROM sports WHERE id='{$sportId}'")->fetchAll()[0]['name'];
}

function getAthletesNames($connection, $athletesIdList)
{
    $athletesIdListInArr = json_decode($athletesIdList);
    $athletesNamesList = [];

    foreach ($athletesIdListInArr as $key => $value) {
        $athleteId = (int) $value;
        $athletesNamesList[] = $connection->query("SELECT name FROM athletes WHERE id='{$athleteId}'")->fetchAll()[0];
    }

    return $athletesNamesList;
}

function getMedalTypeName($connection, $medalId)
{
    return $connection->query("SELECT type FROM medal_types WHERE id='{$medalId}'")->fetchAll()[0]['type'];
}