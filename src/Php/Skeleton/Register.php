<?php

namespace Php\Skeleton;


class Register
{
    /**
     * xの客までのカウントダウン
     *
     * @var int
     */
    private $countdownToLock;
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
        $this->countdownToLock = false;
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
     * xの客が来た時（レジがロックされちゃうまでカウントダウン開始）
     */
    public function startCountDownToLock()
    {
        $this->countdownToLock = $this->shoppers;
        $this->addShoppers(1);

    }

    /**
     * xの客の処理にあたったとき
     */
    protected function lock()
    {
        $this->isLocked = true;
    }

    /**
     * @return bool
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * 客に対応する（待ち客数を減らす）
     */
    public function process()
    {
        if (!$this->isLocked) {
            // 処理できる人数
            $process = $this->processPerIteration;

            // カウントダウン中ならカウントダウンを減らす
            if (false !== $this->countdownToLock) {
                if ($this->countdownToLock > $this->processPerIteration) {
                    $this->countdownToLock -= $this->processPerIteration;
                } else {
                    $process = $this->countdownToLock;
                    $this->lock();
                }
            }

            // 0になるまで待ち客を減らす
            $this->shoppers -= $process;
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