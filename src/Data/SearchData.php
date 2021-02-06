<?php


namespace App\Data;

use App\Entity\Category;

class SearchData
{
    /**
     * @var Category $category
     */
    public $category;

    public function getCategory(): ?Category
    {
        return $this->category;
    }
}
