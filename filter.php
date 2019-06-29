<?php
$file = file_get_contents("summary.json");
$json = json_decode($file, true);

// This array will be populated with finished potions ranging from (1-4)
$potions = [];

foreach($json as $key => $row)
{
    $id = $row["id"];
    $name = $row["name"];
    $members = $row["members"];
    $sp = $row["sp"];
    $buyAverage = $row["buy_average"];
    $buyQuantity = $row["buy_quantity"];
    $sellAverage = $row["sell_average"];
    $sellQuantity = $row["sell_quantity"];
    $overallAverage = $row["overall_average"];
    $overallQuantity = $row["overall_quantity"];

    if(strpos($name, "potion(") !== false)
    {
        // Add this row to the potions array
        $potions[] = [
            "id" => $id,
            "name" => $name,
            "members" => $members,
            "sp" => $sp,
            "buy_average" => $buyAverage,
            "buy_quantity" => $buyQuantity,
            "sell_average" => $sellAverage,
            "sell_quantity" => $sellQuantity,
            "overall_average" => $overallAverage,
            "overall_quantity" => $overallQuantity
        ];
    }
}

// Encode the potions array into a json string
$jsonString = json_encode($potions);

// Save the potions json string to a file
file_put_contents("potions.json", $jsonString);
