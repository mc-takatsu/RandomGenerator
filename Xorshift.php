<?php

/**
 * Class Xorshift
 */
class Xorshift
{
    var $w, $x, $y, $z;

    /**
     * Xorshift128アルゴリズムの擬似乱数ジェネレータを初期化
     * オリジナルはseed1=123456789,seed2=362436069,seed3=521288629,seed4=88675123を用いています
     * @param $seed
     */
    public function __construct($seed)
    {
        $this->x = $seed;
        $this->y = 362436069;
        $this->z = 521288629;
        $this->w = 88675123;
    }

    public function next()
    {
        $t = ($this->x ^ ($this->x << 11));

        $this->x = $this->y;
        $this->y = $this->z;
        $this->z = $this->w;
        return ($this->w = ($this->w ^ ($this->w >> 19)) ^ ($t ^ ($t >> 8)));
    }

    /**
     * @param $min
     * @param $max
     * @return int min <= n < max の範囲の乱数を返す
     */
    public function nextRange($min, $max)
    {
        return (($this->next() >> 1) % ($max - $min)) + $min;
    }
}