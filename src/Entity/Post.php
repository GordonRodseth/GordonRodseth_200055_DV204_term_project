<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $votes;



    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="parentpost", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poster;

    /**
     * @ORM\OneToMany(targetEntity=Upvotes::class, mappedBy="Post", orphanRemoval=true)
     */
    private $upvotes;

    /**
     * @ORM\OneToMany(targetEntity=Downvote::class, mappedBy="post", orphanRemoval=true)
     */
    private $downvotes;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->upvotes = new ArrayCollection();
        $this->downvotes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getVotes(): ?int
    {
        return $this->votes;
    }

    public function setVotes(?int $votes): self
    {
        $this->votes = $votes;

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
            $comment->setParentpost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getParentpost() === $this) {
                $comment->setParentpost(null);
            }
        }

        return $this;
    }

    public function getPoster(): ?User
    {
        return $this->poster;
    }

    public function setPoster(?User $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return Collection|Upvotes[]
     */
    public function getUpvotes(): Collection
    {
        return $this->upvotes;
    }

    public function addUpvote(Upvotes $upvote): self
    {
        if (!$this->upvotes->contains($upvote)) {
            $this->upvotes[] = $upvote;
            $upvote->setPost($this);
        }

        return $this;
    }

    public function removeUpvote(Upvotes $upvote): self
    {
        if ($this->upvotes->removeElement($upvote)) {
            // set the owning side to null (unless already changed)
            if ($upvote->getPost() === $this) {
                $upvote->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Downvote[]
     */
    public function getDownvotes(): Collection
    {
        return $this->downvotes;
    }

    public function addDownvote(Downvote $downvote): self
    {
        if (!$this->downvotes->contains($downvote)) {
            $this->downvotes[] = $downvote;
            $downvote->setPost($this);
        }

        return $this;
    }

    public function removeDownvote(Downvote $downvote): self
    {
        if ($this->downvotes->removeElement($downvote)) {
            // set the owning side to null (unless already changed)
            if ($downvote->getPost() === $this) {
                $downvote->setPost(null);
            }
        }

        return $this;
    }

}
