<?php
$file = file_get_contents("potions.json");
$json = json_decode($file, true);

// A container array for all potions
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

    $bits = explode("(", $name);
    $currentType = $bits[0];
    $bits = explode(")", $bits[1]);
    $currentCount = $bits[0];

    // Add this row to the potions array
    $potions[$currentType][$currentCount] = [
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

foreach($potions as $potionType => $potionCountArray)
{
    $fourPotion = $potionCountArray[4];

    $onePotion = $potionCountArray[1];
    $twoPotion = $potionCountArray[2];
    $threePotion = $potionCountArray[3];

    // saved for reference
    //
    // if($onePotion["buy_average"] !== 0)
    // {
    //     echo "(1) " . $potionType . " {$onePotion["buy_average"]}" . "\n";
    // }
    //
    // if($twoPotion["buy_average"] !== 0)
    // {
    //     echo "(2) " . $potionType . " {$twoPotion["buy_average"]}" . "\n";
    // }
    //
    // if($threePotion["buy_average"] !== 0)
    // {
    //     echo "(3) " . $potionType . " {$threePotion["buy_average"]}" . "\n";
    // }

    if($onePotion["overall_average"] !== 0 && $onePotion["overall_average"] * 4 < $fourPotion["overall_average"])
    {
        output(1, $potionType, $onePotion, $fourPotion);
    }

    if($twoPotion["overall_average"] !== 0 && $twoPotion["overall_average"] * 2 < $fourPotion["overall_average"])
    {
        output(2, $potionType, $twoPotion, $fourPotion);
    }

    if($threePotion["overall_average"] !== 0 && $threePotion["overall_average"] * (4/3) < $fourPotion["overall_average"])
    {
        output(3, $potionType, $threePotion, $fourPotion);
    }
}

function output($count, $potionType, $selectedPotion, $fullPotion)
{
    // Calculate profit
    $profit = $fullPotion["overall_average"] - (($selectedPotion["overall_average"] / $count) * 4);

    echo "BUY:\t({$count})\t{$potionType}\t@{$selectedPotion["overall_average"]}\t{$profit}\n";
}
