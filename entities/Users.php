<?php
class Users
{
    protected $idUser;
    protected $firstName;
    protected $lastName;
    protected $tokenId;

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
     * Get the value of idUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get the value of tokenId
     */
    public function getTokenId()
    {
        return $this->tokenId;
    }

    /**
     * set value of idUser
     *
     * @param [int] $id
     * @return self
     */
    public function setIdUser($id)
    {
        $id = (int) $id;
        $this->idUser = $id;

        return $this;
    }

    /**
     * set value of firstname
     *
     * @param string $firstName
     * @return self
     */
    public function setFirstName($firstName)
    {
        $firstName = (string) $firstName;
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * set value of lastname
     *
     * @param string $lastName
     * @return self
     */
    public function setLastName($lastName)
    {
        $lastName = (string) $lastName;
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * set value of tokenid
     *
     * @param string $tokenId
     * @return self
     */
    public function setTokenId($tokenId)
    {
        $tokenId = (string) $tokenId;
        $this->tokenId = $tokenId;

        return $this;
    }
}
