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
        $this->assertEquals(11, $regi->getShoppers());
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
    public function Xが来た後カウントダウンしてゼロになったらロックする()
    {
        $regi = new Register(5);
        $regi->addShoppers(10);

        $regi->startCountdownToLock();
        $this->assertEquals(11, $regi->getShoppers());

        $regi->process();
        $this->assertFalse($regi->getIsLocked());
        $this->assertEquals(6, $regi->getShoppers());

        $regi->process();
        $this->assertTrue($regi->getIsLocked());
        $this->assertEquals(1, $regi->getShoppers());
    }

    /**
     * @test
     */
    public function ロックされていてもお客は追加できるがそれ以上処理されることはない()
    {
        $regi = new Register(5);

        $regi->startCountDownToLock();
        $this->assertFalse($regi->getIsLocked());
        $this->assertEquals(1, $regi->getShoppers());

        $regi->process();
        $this->assertTrue($regi->getIsLocked());
        $this->assertEquals(1, $regi->getShoppers());

        $regi->addShoppers(3);
        $this->assertTrue($regi->getIsLocked());
        $this->assertEquals(4, $regi->getShoppers());

        $regi->process();
        $this->assertTrue($regi->getIsLocked());
        $this->assertEquals(4, $regi->getShoppers());
    }

    /**
     * @test
     */
    public function 残り客数がゼロになったらそれ以上処理せず待ち客数ゼロ()
    {
        $regi = new Register(10);

        $regi->process();
        $this->assertEquals(0, $regi->getShoppers());

        $regi->addShoppers(1);
        $regi->process();
        $this->assertEquals(0, $regi->getShoppers());

    }
}
 