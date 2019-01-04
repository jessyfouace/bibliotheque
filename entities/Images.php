<?php
class Images
{
    protected $idImage;
    protected $nameImage;
    protected $alt;

    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    

    /**
     * set value of id image
     *
     * @param [int] $idImage
     * @return self
     */
    public function setIdImage($idImage)
    {
        $idImage = (int) $idImage;
        $this->idImage = $idImage;

        return $this;
    }

    /**
     * set name of image
     *
     * @param [string] $nameImage
     * @return void
     */
    public function setNameImage(string $nameImage)
    {
        $this->nameImage = $nameImage;

        return $this;
    }

    /**
     * set value of alt
     *
     * @param [string] $alt
     * @return self
     */
    public function setAlt(string $alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get the value of IdImage
     */
    public function getIdImage()
    {
        return $this->idImage;
    }

    /**
     * Get the value of NameImage
     */
    public function getNameImage()
    {
        return $this->nameImage;
    }

    /**
     * Get the value of alt
     */
    public function getAlt()
    {
        return $this->alt;
    }
}
