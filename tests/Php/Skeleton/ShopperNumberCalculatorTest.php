<?php

namespace Php\Skeleton;

use PHP\Skeleton\ShopperNumberCalculator;

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
            ['12x34x.', '1,0,1,0,2']
        ];
    }
}
