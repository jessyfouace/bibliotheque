<?php
class BooksManager
{
    private $_bdd;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    public function getBooksAndCategories()
    {
        $arrayOfBooks = [];
        $arrayOfImages = [];
        $arrayAllInfo = [];
        $query = $this->getBdd()->query('SELECT * FROM books LEFT JOIN images ON books.images_id = images.idImage GROUP BY books.id');
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $arrayOfBooks[] = new Books($book);
            $arrayOfImages[] = new Images($book);
        }
        $arrayAllInfo[] = $arrayOfBooks;
        $arrayAllInfo[] = $arrayOfImages;
        return $arrayAllInfo;
    }

    public function getUsersForBook()
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

    public function getBookAndCategoryById(int $id)
    {
        $arrayOfBooks = [];
        $arrayOfCategories = [];
        $arrayOfUser = [];
        $arrayOfImages = [];
        $arrayAllInfo = [];
        $query = $this->getBdd()->prepare('SELECT * FROM books LEFT JOIN categories ON books.categories_id = categories.idCategory LEFT JOIN users ON books.users_id = users.idUser LEFT JOIN images ON books.images_id = images.idImage WHERE books.id = :bookid');
        $query->bindValue('bookid', $id, PDO::PARAM_INT);
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $arrayOfBooks[] = new Books($book);
            $arrayOfCategories[] = new Categories($book);
            $arrayOfUser[] = new Users($book);
            $arrayOfImages[] = new Images($book);
        }
        $arrayAllInfo[] = $arrayOfBooks;
        $arrayAllInfo[] = $arrayOfCategories;
        $arrayAllInfo[] = $arrayOfUser;
        $arrayAllInfo[] = $arrayOfImages;
        return $arrayAllInfo;
    }

    public function addBook(Books $book)
    {
        $query = $this->getBdd()->prepare('INSERT INTO books(title, author, apparution, content, disponibility, images_id, categories_id) VALUES(:title, :author, :apparution, :content, :disponibility, :images_id, :categories_id)');
        $query->bindValue(':title', $book->getTitle(), PDO::PARAM_STR);
        $query->bindValue(':author', $book->getAuthor(), PDO::PARAM_STR);
        $query->bindValue(':apparution', $book->getApparution(), PDO::PARAM_STR);
        $query->bindValue(':content', $book->getContent(), PDO::PARAM_STR);
        $query->bindValue(':disponibility', $book->getDisponibility(), PDO::PARAM_INT);
        $query->bindValue(':images_id', $book->getImages_id(), PDO::PARAM_INT);
        $query->bindValue(':categories_id', $book->getCategories_id(), PDO::PARAM_INT);
        $query->execute();
    }

    public function updateBookAndUser($idBook, $value, $disponibility)
    {
        $idBook = (int) $idBook;
        if ($value == 0) {
            $value == null;
        }
        $disponibility = (int) $disponibility;

        $query = $this->getBdd()->prepare('UPDATE books SET users_id = :value, disponibility = :disponibility WHERE id = :bookid');
        $query->bindValue(':bookid', $idBook, PDO::PARAM_INT);
        $query->bindValue(':value', $value, PDO::PARAM_INT);
        $query->bindValue(':disponibility', $disponibility, PDO::PARAM_INT);
        $query->execute();
    }

    public function getBookByUserId(int $id)
    {
        $arrayOfBooks = [];
        $query = $this->getBdd()->prepare('SELECT * FROM books WHERE users_id = :userid');
        $query->bindValue('userid', $id, PDO::PARAM_INT);
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            $arrayOfBooks[] = new Books($book);
        }
        return $arrayOfBooks;
    }

    public function deleteBookById(int $id)
    {
        $query = $this->getBdd()->prepare('DELETE FROM books WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }

    public function getBookByName($name)
    {
        $arrayOfBooks = [];
        $arrayOfImages = [];
        $arrayAllInfo = [];
        $query = $this->getBdd()->prepare('SELECT * FROM books LEFT JOIN images ON books.images_id = images.idImage WHERE title = :title');
        $query->bindValue(':title', $name, PDO::PARAM_STR);
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $bookByName) {
            $arrayOfBooks[] = new Books($bookByName);
            $arrayOfImages[] = new Images($bookByName);
        }
        $arrayAllInfo[] = $arrayOfBooks;
        $arrayAllInfo[] = $arrayOfImages;
        return $arrayAllInfo;
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
