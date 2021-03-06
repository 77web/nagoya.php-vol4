<?php

namespace NotFork;

use NotFork\ShopperNumberCalculator;

class ShopperNumberCalculatorTest extends \PHPUnit_Framework_TestCase
{

    protected static $regiConfigs = [
        1 => 2,
        2 => 7,
        3 => 3,
        4 => 5,
        5 => 2,
    ];
    /**
     * @test
     * @dataProvider provideData
     */
    public function フォークじゃない($shoppers, $expectedFinalShoppers)
    {
        $calculator = new ShopperNumberCalculator(self::$regiConfigs, $shoppers);
        $finalShoppers = $calculator->run();

        $this->assertEquals($expectedFinalShoppers, $finalShoppers);
    }

    public function provideData()
    {
        return [
            ['42873x.3.', '0,4,2,0,0'],
            ['1', '1,0,0,0,0'],
            ['.', '0,0,0,0,0'],
            ['x', '1,0,0,0,0'],
            ['31.', '1,0,0,0,0'],
            ['3x.', '1,1,0,0,0'],
            ['12x34x.', '1,0,1,0,2'],
            ['x1111x.', '2,0,0,0,0'],
            ['4.1..9..513.266..5999769852.2.38x79.x7', '12,10,13,6,10'],
        ];
    }
}
