<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    public function positiveDataProvider()
    {
        return [
            [
                [
                   ['name' => 'potato', 'color' => 'yellow'],
                   ['name' => 'apple', 'color' => 'green'],
                   ['name' => 'apricot', 'color' => 'yellow'],
                ],
                ['a', 'p']
            ],
            [
                [
                    [
                        "name" => "New Orleans International Airport",
                        "code" => "MSY",
                        "city" => "New Orleans",
                        "state" => "Louisiana",
                        "address" => "900 Airline Dr, Kenner, LA 70062, USA",
                        "timezone" => "America/New_York",
                    ],
                    [
                        "name" => "Portland International Jetport",
                        "code" => "PWM",
                        "city" => "Portland",
                        "state" => "Maine",
                        "address" => "1001 Westbrook St, Portland, ME 04102, USA",
                        "timezone" => "America/New_York",
                    ],
                    [
                        "name" => "Albuquerque Sunport International Airport",
                        "code" => "ABQ",
                        "city" => "Albuquerque",
                        "state" => "New Mexico",
                        "address" => "2200 Sunport Blvd, Albuquerque, NM 87106, USA",
                        "timezone" => "America/Los_Angeles",
                    ],
                    [
                        "name" => "Palm Springs Airport",
                        "code" => "PSP",
                        "city" => "Palm Springs",
                        "state" => "California",
                        "address" => "3400 E Tahquitz Canyon Way, Palm Springs, CA 92262, USA",
                        "timezone" => "America/Los_Angeles",
                    ],
                    [
                        "name" => "Ontario International Airport",
                        "code" => "ONT",
                        "city" => "Ontario",
                        "state" => "California",
                        "address" => "Ontario, CA 91761, USA",
                        "timezone" => "America/Los_Angeles",
                    ],
                ],
                ['A', 'N', 'O', 'P']
            ],
            [
                [
                    ["id" => 1, "name" => "Jonh"],
                    ["id" => 2, "name" => "Adam"],
                    ["id" => 3, "name" => "Addison"],
                ],
                ['A', 'J']
            ]
        ];
    }
}