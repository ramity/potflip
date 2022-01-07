<?php
$file = file_get_contents("potions.json");
$json = json_decode($file, true);

// A container array for all potions
$potions = [];

// A container array for saving profitable flips
$data = [];

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
    // skip if 4 dose potion is not present to perform calculations against
    if(!array_key_exists(4, $potionCountArray))
    {
      continue;
    }

    $onePotion = $potionCountArray[1];
    $twoPotion = $potionCountArray[2];
    $threePotion = $potionCountArray[3];
    $fourPotion = $potionCountArray[4];

    if($onePotion["overall_average"] != 0 && $onePotion["overall_average"] * 4 < $fourPotion["overall_average"])
    {
        $data[] = process(1, $potionType, $onePotion, $fourPotion);
    }

    if($twoPotion["overall_average"] != 0 && $twoPotion["overall_average"] * 2 < $fourPotion["overall_average"])
    {
        $data[] = process(2, $potionType, $twoPotion, $fourPotion);
    }

    if($threePotion["overall_average"] != 0 && $threePotion["overall_average"] * (4/3) < $fourPotion["overall_average"])
    {
        $data[] = process(3, $potionType, $threePotion, $fourPotion);
    }
}

usort($data, function($a, $b)
{
    return $b["fullBuyQuantity"] <=> $a["fullBuyQuantity"];
});

output($data);

function process($count, $potionType, $selectedPotion, $fullPotion)
{
    // Calculate misc fields
    $maxProfit = $fullPotion["overall_average"] - (($selectedPotion["overall_average"] / $count) * 4);
    $evenSellPrice = (($selectedPotion["overall_average"] / $count) * 4);

    // Prevent division by zero
    $margin = 0;
    if($evenSellPrice == 0)
    {
        $evenSellPrice = $fullPotion["overall_average"];
        $margin = INF;
    }
    else
    {
        $margin = ($maxProfit / $evenSellPrice);
    }

    $potion = $potionType . "({$count})";
    $buyPrice = round($selectedPotion["overall_average"], 2);
    $evenBuyPrice = round(($fullPotion["overall_average"] / 4) * $count, 2);
    $profitSellPrice = round($fullPotion["overall_average"], 2);
    $evenSellPrice = round($evenSellPrice, 2);

    $buyRange = "{$buyPrice} - {$evenBuyPrice}";
    $sellRange = "{$evenSellPrice} - {$profitSellPrice}";

    return [
        "potion" => $potion,
        "potionType" => $potionType,
        "buyRange" => $buyRange,
        "maxProfit" => $maxProfit,
        "sellRange" => $sellRange,
        "margin" => $margin,
        "fullBuyQuantity" => $fullPotion["buy_quantity"]
    ];
}

function output($data)
{
    echo "\n";
    printf("%-25s | %-15s | %-10s | %-20s | %-10s\n", "Potion", "BuyRange", "MaxProfit", "SellRange", "margin");
    echo "\n";

    foreach($data as $key => $row)
    {
        printf(
            "%-25s | %-15s | %-10d | %-20s | %-10.3f\n",
            $row["potion"],
            $row["buyRange"],
            $row["maxProfit"],
            $row["sellRange"],
            $row["margin"]
        );
    }
}
