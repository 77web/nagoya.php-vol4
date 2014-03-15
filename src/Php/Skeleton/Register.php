<?php

namespace Php\Skeleton;


class Register
{
    /**
     * xの客が来てしまったかどうか
     *
     * @var bool
     */
    private $isLocked;

    /**
     * 1回に処理できる客の数
     *
     * @var int
     */
    private $processPerIteration;

    /**
     * 待っている客の数
     *
     * @var int
     */
    private $shoppers;

    /**
     * @param int $processPerIteration
     */
    public function __construct($processPerIteration)
    {
        $this->processPerIteration = $processPerIteration;
        $this->shoppers = 0;
        $this->isLocked = false;
    }

    /**
     * 待っている客を追加する
     *
     * @param int $newShoppers
     */
    public function addShoppers($newShoppers)
    {
        $this->shoppers += $newShoppers;
    }

    /**
     * xの客が来た時（レジがロックされちゃう）
     */
    public function lock()
    {
        $this->addShoppers(1);
        $this->isLocked = true;
    }

    /**
     * 客に対応する（待ち客数を減らす）
     */
    public function process()
    {
        if (!$this->isLocked) {

            $this->shoppers -= $this->processPerIteration;
            if (0 > $this->shoppers) {
                $this->shoppers = 0;
            }
        }
    }

    /**
     * 客の数を返す
     *
     * @return int
     */
    public function getShoppers()
    {
        return $this->shoppers;
    }
} 