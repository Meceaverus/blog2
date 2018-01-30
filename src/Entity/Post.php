<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $data;
    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $title;
    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $text;
    /**
     * @var Comment[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     * @ORM\OrderBy({"dataComm" = "DESC"})
     */
    private $comment;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getData(): \DateTime
    {
        return $this->data;
    }

    /**
     * @param \DateTime $data
     * @return Post
     */
    public function setData(\DateTime $data): Post
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Post
     */
    public function setText(string $text): Post
    {
        $this->text = $text;
        return $this;
    }

    public function __construct()
    {
        $this->data = new \DateTime();
        $this->title = '';
        $this->text = '';
        $this->comment = new ArrayCollection();
    }

    public function detShortText(): ?string
    {
        $paragraphs = explode("\n", $this->text, 2);
        return reset($paragraphs);
    }
    /**
     * @return Comment[]|ArrayCollection
     */
    public function getComment(): ? Collection
    {
        return $this->comment;
    }
    /**
     * @param Comment[]|ArrayCollection $comment
     * @return Post
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }


}
