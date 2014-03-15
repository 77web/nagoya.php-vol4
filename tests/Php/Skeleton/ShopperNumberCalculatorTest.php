<?php

namespace Php\Skeleton;

use PHP\Skeleton\ShopperNumberCalculator;

class ShopperNumberCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider provideData
     */
    public function フォークじゃない($shoppers, $expectedFinalShoppers)
    {
        $calculator = new ShopperNumberCalculator($shoppers);
        $finalShoppers = $calculator->run();

        $this->assertEquals($expectedFinalShoppers, $finalShoppers);
    }

    public function provideData()
    {
        return [
            ['42873x.3.', '0,4,2,0,0']
        ];
    }
}
