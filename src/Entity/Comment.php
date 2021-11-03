<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;



    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parentpost;

    /**
     * @ORM\ManyToOne(targetEntity=Comment::class, inversedBy="childcomments")
     */
    private $parentcomment;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="parentcomment")
     */
    private $childcomments;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poster;

    public function __construct()
    {
        $this->childcomments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
 
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }


    public function getParentpost(): ?Post
    {
        return $this->parentpost;
    }

    public function setParentpost(?Post $parentpost): self
    {
        $this->parentpost = $parentpost;

        return $this;
    }

    public function getParentcomment(): ?self
    {
        return $this->parentcomment;
    }

    public function setParentcomment(?self $parentcomment): self
    {
        $this->parentcomment = $parentcomment;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildcomments(): Collection
    {
        return $this->childcomments;
    }

    public function addChildcomment(self $childcomment): self
    {
        if (!$this->childcomments->contains($childcomment)) {
            $this->childcomments[] = $childcomment;
            $childcomment->setParentcomment($this);
        }

        return $this;
    }

    public function removeChildcomment(self $childcomment): self
    {
        if ($this->childcomments->removeElement($childcomment)) {
            // set the owning side to null (unless already changed)
            if ($childcomment->getParentcomment() === $this) {
                $childcomment->setParentcomment(null);
            }
        }

        return $this;
    }

    public function getPoster(): ?user
    {
        return $this->poster;
    }

    public function setPoster(?user $poster): self
    {
        $this->poster = $poster;

        return $this;
    }
}
