# potflip

A simple potion flipping helper

# Notice

**RSbuddy no longer seems maintained.**

> On Jan 6th 2022, I noted the response from rsbuddy.com/exchange/summary.json is malformed and incomplete.
> Until this is resolved, this repo/project is no longer functional.

# Usage

```
git clone git@github.com:ramity/potflip.git
cd potflip
php download.php
php filter.php
php calculate.php
```

(Example output from calculate.php)

```
Potion                    | BuyRange        | MaxProfit  | SellRange            | margin

Prayer potion(3)          | 5951 - 5984.25  | 44         | 7934.67 - 7979       | 0.006
Stamina potion(1)         | 1174 - 1186     | 48         | 4696 - 4744          | 0.010
Ranging potion(1)         | 234 - 273       | 156        | 936 - 1092           | 0.167
Ranging potion(3)         | 732 - 819       | 116        | 976 - 1092           | 0.119
Super combat potion(3)    | 7241 - 7269.75  | 38         | 9654.67 - 9693       | 0.004
Super combat potion(2)    | 4840 - 4846.5   | 13         | 9680 - 9693          | 0.001
Magic potion(3)           | 152 - 152.25    | 0          | 202.67 - 203         | 0.002
Magic potion(2)           | 73 - 101.5      | 57         | 146 - 203            | 0.390
Magic potion(1)           | 42 - 50.75      | 35         | 168 - 203            | 0.208
Energy potion(2)          | 228 - 266       | 76         | 456 - 532            | 0.167
Energy potion(3)          | 371 - 399       | 37         | 494.67 - 532         | 0.075
Antifire potion(1)        | 54 - 66.25      | 49         | 216 - 265            | 0.227
Antifire potion(3)        | 107 - 198.75    | 122        | 142.67 - 265         | 0.857
Bastion potion(3)         | 4382 - 4409.25  | 36         | 5842.67 - 5879       | 0.006
Attack potion(3)          | 6 - 12          | 8          | 8 - 16               | 1.000
Attack potion(2)          | 5 - 8           | 6          | 10 - 16              | 0.600
Attack potion(1)          | 3 - 4           | 4          | 12 - 16              | 0.333
Strength potion(3)        | 177 - 177.75    | 1          | 236 - 237            | 0.004
Strength potion(2)        | 101 - 118.5     | 35         | 202 - 237            | 0.173
Restore potion(3)         | 60 - 69.75      | 13         | 80 - 93              | 0.163
Combat potion(3)          | 500 - 561.75    | 82         | 666.67 - 749         | 0.124
Combat potion(1)          | 139 - 187.25    | 193        | 556 - 749            | 0.347
Super antifire potion(3)  | 8000 - 8661     | 881        | 10666.67 - 11548     | 0.083
```
