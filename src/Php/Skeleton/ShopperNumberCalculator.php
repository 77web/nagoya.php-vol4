<?php

namespace Php\Skeleton;


class ShopperNumberCalculator
{
    /**
     * @var string
     */
    protected $shoppers;

    /**
     * @var array
     */
    protected $registers;

    /**
     * @param array $regiConfigs
     * @param string $shoppers
     */
    public function __construct($regiConfigs, $shoppers)
    {
        $this->shoppers = $shoppers;

        $this->generateRegisters($regiConfigs);
    }

    /**
     * @param array $regiConfigs
     * @return array
     */
    protected function generateRegisters($regiConfigs)
    {
        $this->registers = [];
        foreach ($regiConfigs as $number => $processPerIteration) {
            $this->registers[$number] = new Register($processPerIteration);
        }
    }

    /**
     * @return string 待っている客の数
     */
    public function run()
    {
        for ($i=0; $i < strlen($this->shoppers); $i++) {
            $current = $this->shoppers[$i];

            if ('.' === $current) {
                foreach ($this->registers as $register) {
                    /** @var Register $register */
                    $register->process();
                }
            } else {
                $regi = $this->getShortestRegister();

                if ('x' === $current) {
                    $regi->lock();
                } else {
                    $regi->addShoppers(intval($current));
                }
            }
        }

        $finalShoppers = [];

        foreach ($this->registers as $regi) {
            /** @var Register $regi */
            $finalShoppers[] = $regi->getShoppers();
        }

        return implode(',', $finalShoppers);
    }

    /**
     * 一番短い列のレジを返す
     *
     * @return Register
     */
    protected function getShortestRegister()
    {
        $shortest = 1;
        $min = $this->registers[1]->getShoppers();
        foreach ($this->registers as $number => $regi) {
            /** @var Register $regi */
            if ($min > $regi->getShoppers()) {
                $shortest = $number;
                $min = $regi->getShoppers();
            }
        }

        return $this->registers[$shortest];
    }
} 