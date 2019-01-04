<?php
class Books
{
    protected $id;
    protected $title;
    protected $author;
    protected $apparution;
    protected $content;
    protected $disponibility;
    protected $images_id = 1;
    protected $categories_id;
    protected $users_id;

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
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get the value of apparution
     */
    public function getApparution()
    {
        return $this->apparution;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of disponibility
     */
    public function getDisponibility()
    {
        return $this->disponibility;
    }

    /**
     * Get the value of images_id
     */
    public function getImages_id()
    {
        return $this->images_id;
    }

    /**
     * Get the value of categories_id
     */
    public function getCategories_id()
    {
        return $this->categories_id;
    }

    /**
     * Get the value of users_id
     */
    public function getUsers_id()
    {
        return $this->users_id;
    }

    /**
     * set value of id
     *
     * @param [int] $id
     * @return self
     */
    public function setId($id)
    {
        $id = (int) $id;
        $this->id = $id;
        return $this;
    }

    /**
     * set value of title
     *
     * @param string $title
     * @return self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * set value of author
     *
     * @param string $author
     * @return self
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * set value of apparution
     *
     * @param string $apparution
     * @return self
     */
    public function setApparution(string $apparution)
    {
        $this->apparution = $apparution;

        return $this;
    }

    /**
     * set value of content
     *
     * @param string $content
     * @return self
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the value of disponibility
     *
     * @param [int] $disponibility
     * @return self
     */
    public function setDisponibility($disponibility)
    {
        $disponibility = (int) $disponibility;
        $this->disponibility = $disponibility;

        return $this;
    }

    /**
     * set value of images_id
     *
     * @param string $images_id
     * @return self
     */
    public function setImages_id(string $images_id)
    {
        $this->images_id = $images_id;

        return $this;
    }

    /**
     * Set the value of categories_id
     *
     * @param [int] $categories_id
     * @return self
     */
    public function setCategories_id($categories_id)
    {
        $categories_id = (int) $categories_id;
        $this->categories_id = $categories_id;

        return $this;
    }

    /**
     * set value of userid
     *
     * @param [int] $users_id
     * @return self
     */
    public function setUsers_id($users_id)
    {
        $users_id = (int) $users_id;
        $this->users_id = $users_id;

        return $this;
    }
}
