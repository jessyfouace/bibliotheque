<?php
class UsersManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    /**
     * Get users
     *
     * @return self
     */
    public function getUsers()
    {
        $arrayOfUsers = [];
        $query = $this->getBdd()->query('SELECT * FROM users ORDER BY tokenId');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $key => $user) {
            $arrayOfUsers[] = new Users($user);
        }
        return $arrayOfUsers;
    }

    /**
     * Get user by tokenId
     *
     * @param [string] $value
     * @return self
     */
    public function getUserByTarget($value)
    {
        $arrayOfUsers = [];
        $query = $this->getBdd()->prepare('SELECT * FROM users WHERE tokenId = :value');
        $query->bindValue(':value', $value, PDO::PARAM_STR);
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($users as $user) {
            $arrayOfUsers[] = new Users($user);
        }
        return $arrayOfUsers;
    }

    /**
     * Add users
     *
     * @param Users $user
     * @return self
     */
    public function addUsers(Users $user)
    {
        $query = $this->getBdd()->prepare('INSERT INTO users(firstName, lastName, tokenId) VALUES(:firstName, :lastName, :tokenId)');
        $query->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $query->bindValue(':tokenId', $user->getTokenId(), PDO::PARAM_STR);
        $query->execute();
    }

    /**
     * Verif name dispo
     *
     * @param Users $user
     * @return self
     */
    public function VerifDispoUser(Users $user)
    {
        $query = $this->getBdd()->prepare('SELECT * FROM users WHERE firstName = :firstName AND lastName = :lastName');
        $query->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $getUser) {
            return new Users($getUser);
        }
    }

    /**
     * Delete user
     *
     * @param integer $id
     * @return self
     */
    public function deleteUserById(int $id)
    {
        $query = $this->getBdd()->prepare('DELETE FROM users WHERE idUser = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }

    /**
     * Update user
     *
     * @param Users $user
     * @return self
     */
    public function updateUser(Users $user)
    {
        $query = $this->getBdd()->prepare('UPDATE users SET firstName = :firstname, lastName = :lastname WHERE idUser = :userid');
        $query->bindValue(':userid', $user->getIdUser(), PDO::PARAM_INT);
        $query->bindValue(':firstname', $user->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':lastname', $user->getLastName(), PDO::PARAM_STR);
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
