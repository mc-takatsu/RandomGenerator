<?php

/**
 * Class Xorshift
 */
class Xorshift
{
    var $s = array(123456789, 362436069, 521288629, 88675123);
    const MASK31 = 0x7FFFFFFF;

    /**
     * Xorshift128アルゴリズムの擬似乱数ジェネレータを初期化
     * オリジナルはseed1=123456789,seed2=362436069,seed3=521288629,seed4=88675123を用いています
     * @param $seed
     */
    public function __construct($seed)
    {
        if ($seed != 0) {
            $this->init($seed);
        }
    }

    private function init($seed)
    {
        for ($i = 0; $i < 4; $i++)
        {
            $this->s[$i] = $seed = 1812433253 * ($seed ^ ($seed >> 30)) + $i;
        }
    }

    public function next()
    {
        $t = ($this->s[0] ^ ($this->s[0] << 11));

        $this->s[0] = $this->s[1];
        $this->s[1] = $this->s[2];
        $this->s[2] = $this->s[3];
        $this->s[3] = ($this->s[3] ^ ($this->s[3] >> 19)) ^ ($t ^ ($t >> 8));
        return ($this->s[3] & self::MASK31);
    }

    /**
     * @param $min
     * @param $max
     * @return int min <= n < max の範囲の乱数を返す. 0,100を指定すると0から99の100種の値を返す
     */
    public function nextRange($min, $max)
    {
        return (($this->next() >> 1) % ($max - $min)) + $min;
    }
}