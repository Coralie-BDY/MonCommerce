<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class ArticleSearch
{
    /**
     * @var int|null
     */
   private $maxPrice;

    /**
     * @var int|null
     */
    private $minTaille;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }
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
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $options
     *
     * @return ArticleSearch
     */
    public function setOptions(ArrayCollection $options): ArticleSearch
    {
        $this->options = $options;
        return $this;
    }




}