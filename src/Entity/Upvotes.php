<?php

namespace App\Entity;

use App\Repository\UpvotesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UpvotesRepository::class)
 */
class Upvotes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="upvotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="upvotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->Post;
    }

    public function setPost(?Post $Post): self
    {
        $this->Post = $Post;

        return $this;
    }
}
