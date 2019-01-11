<?php
class Admin
{
    protected $id;
    protected $name;
    protected $password;
    protected $mail;

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
     * Get the value of Id
     *
     * @return self
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Name
     *
     * @return self
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of Password
     *
     * @return self
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of mail
     *
     * @return self
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * set value of Id
     *
     * @param [int] $id
     * @return self
     */
    public function setId($id)
    {
        $id = (int)$id;
        $this->id = $id;

        return $this;
    }

    /**
     * set value of name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * set value of password
     *
     * @param string $password
     * @return self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * set value of mail
     *
     * @param string $mail
     * @return self
     */
    public function setMail(string $mail)
    {
        $this->mail = $mail;

        return $this;
    }
}
