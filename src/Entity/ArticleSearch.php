<?php


namespace App\Entity;


class ArticleSearch
{
    /**
     * @var int|null
     */
   private $maxPrice;

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     *
     * @return ArticleSearch
     */
    public function setMaxPrice(int $maxPrice): ArticleSearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinTaille(): ?int
    {
        return $this->minTaille;
    }

    /**
     * @param int|null $minTaille
     *
     * @return ArticleSearch
     */
    public function setMinTaille(int $minTaille): ArticleSearch
    {
        $this->minTaille = $minTaille;
        return $this;
    }

    /**
     * @var int|null
     */
   private $minTaille;


}