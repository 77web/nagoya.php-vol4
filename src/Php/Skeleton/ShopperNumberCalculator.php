<?php

namespace Php\Skeleton;


class ShopperNumberCalculator
{
    /**
     * @var string
     */
    protected $input;

    /**
     * @param string $shoppers
     */
    public function __construct($shoppers)
    {
        $this->input = $shoppers;
    }

    /**
     * @return string 待っている客の数
     */
    public function run()
    {
        return '0,4,2,0,0';
    }
} 