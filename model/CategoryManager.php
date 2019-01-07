<?php
class CategoryManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getCategories()
    {
        $arrayOfCategories = [];
        $query = $this->getBdd()->query('SELECT * FROM categories ORDER BY name');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $category) {
            $arrayOfCategories[] = new Categories($category);
        }
        return $arrayOfCategories;
    }

    /**
     * Get the value of _bdd
     */
    public function getBdd()
    {
        return $this->_bdd;
    }

    /**
     * Set the value of _bdd
     *
     * @return  self
     */
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;

        return $this;
    }
}
