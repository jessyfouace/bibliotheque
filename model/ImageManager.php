<?php
class ImageManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getImages()
    {
        $query = $this->getBdd()->query('SELECT idImage FROM images ORDER BY idImage DESC LIMIT 1');
        $query->execute();
        $images = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($images as $image) {
            return new Images($image);
        }
    }

    public function addImage(Images $image)
    {
        $query = $this->getBdd()->prepare('INSERT INTO images(nameImage, alt) VALUES(:nameImage, :alt)');
        $query->bindValue(':nameImage', $image->getNameImage(), PDO::PARAM_STR);
        $query->bindValue(':alt', $image->getAlt(), PDO::PARAM_STR);
        $query->execute();
        $id = $this->getBdd()->lastInsertId();
        return $id;
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
