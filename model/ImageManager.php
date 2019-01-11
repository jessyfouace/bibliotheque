<?php
class ImageManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    /**
     * Add image
     *
     * @param Images $image
     * @return self
     */
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
     * Delete image
     *
     * @param [int] $id
     * @return self
     */
    public function deleteImage($id)
    {
        $id = (int) $id;
        $query = $this->getBdd()->prepare('DELETE FROM images WHERE idImage = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }

    /**
     * Update Image
     *
     * @param Images $img
     * @return self
     */
    public function updateAlt(Images $img)
    {
        $query = $this->getBdd()->prepare('UPDATE images SET alt = :alt WHERE idImage = :imgId');
        $query->bindValue(':alt', $img->getAlt(), PDO::PARAM_STR);
        $query->bindValue(':imgId', $img->getIdImage(), PDO::PARAM_INT);
        $query->execute();
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
