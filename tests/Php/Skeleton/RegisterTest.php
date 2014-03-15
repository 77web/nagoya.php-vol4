<?php

namespace Php\Skeleton;


class RegisterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function お客を追加する()
    {
        $regi = new Register(5);

        $regi->addShoppers(10);
        $this->assertEquals(10, $regi->getShoppers());

        $regi->addShoppers(1);
        $this->assertEquals(1, $regi->getShoppers());
    }
    /**
     * @test
     */
    public function お客を処理する()
    {
        $regi = new Register(5);
        $regi->addShoppers(10);

        $regi->process();

        $this->assertEquals(5, $regi->getShoppers());
    }

    /**
     * @test
     */
    public function ロックされたらお客はもう処理できない()
    {
        $regi = new Register(5);
        $regi->addShoppers(10);

        $regi->lock();

        $regi->process();

        $this->assertEquals(10, $regi->getShoppers());
    }

    /**
     * @test
     */
    public function ロックされてもお客は追加できる()
    {
        $regi = new Register(5);
        $regi->addShoppers(10);

        $regi->lock();

        $regi->addShoppers(10);

        $this->assertEquals(20, $regi->getShoppers());
    }
}
 