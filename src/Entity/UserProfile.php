<?php

namespace App\Entity;

use App\Repository\UserProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserProfileRepository::class)
 */
class UserProfile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reputation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $password;


    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="parent")
     */
    private $posthistory;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="poster", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->posthistory = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReputation(): ?int
    {
        return $this->reputation;
    }

    public function setReputation(?int $reputation): self
    {
        $this->reputation = $reputation;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }


    /**
     * @return Collection|Post[]
     */
    public function getPosthistory(): Collection
    {
        return $this->posthistory;
    }

    public function addPosthistory(Post $posthistory): self
    {
        if (!$this->posthistory->contains($posthistory)) {
            $this->posthistory[] = $posthistory;
            $posthistory->setParent($this);
        }

        return $this;
    }

    public function removePosthistory(Post $posthistory): self
    {
        if ($this->posthistory->removeElement($posthistory)) {
            // set the owning side to null (unless already changed)
            if ($posthistory->getParent() === $this) {
                $posthistory->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPoster($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPoster() === $this) {
                $comment->setPoster(null);
            }
        }

        return $this;
    }
}
