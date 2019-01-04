<?php
class UsersManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getUsers()
    {
        $arrayOfUsers = [];
        $query = $this->getBdd()->query('SELECT * FROM users ORDER BY firstName');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $arrayOfUsers[] = new Users($user);
        }
        return $arrayOfUsers;
    }

    public function addUsers(Users $user)
    {
        $query = $this->getBdd()->prepare('INSERT INTO users(firstName, lastName, tokenId) VALUES(:firstName, :lastName, :tokenId)');
        $query->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $query->bindValue(':tokenId', $user->getTokenId(), PDO::PARAM_STR);
        $query->execute();
    }

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

    public function deleteUserById(int $id)
    {
        $query = $this->getBdd()->prepare('DELETE FROM users WHERE idUser = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
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
