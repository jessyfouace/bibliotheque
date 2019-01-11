<?php
class AdminManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    /**
     * Take all admin by name
     *
     * @param Admin $admin
     * @return self
     */
    public function getAdminByName(Admin $admin)
    {
        $query = $this->getBdd()->prepare('SELECT * FROM admin WHERE name = :name');
        $query->bindValue(':name', $admin->getName(), PDO::PARAM_STR);
        $query->execute();
        $admins = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($admins as $admin) {
            return new Admin($admin);
        }
    }

    /**
     * Add admin
     *
     * @param Admin $admin
     * @return self
     */
    public function addAdmin(Admin $admin)
    {
        $query = $this->getBdd()->prepare('INSERT INTO admin(name, password, mail) VALUES(:name, :password, :mail)');
        $query->bindValue(':name', $admin->getName(), PDO::PARAM_STR);
        $query->bindValue(':password', $admin->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':mail', $admin->getMail(), PDO::PARAM_STR);
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
     * Set value bdd
     *
     * @param PDO $bdd
     * @return self
     */
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;

        return $this;
    }
}
