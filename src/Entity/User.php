<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reputation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="poster")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="poster", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Upvotes::class, mappedBy="User", orphanRemoval=true)
     */
    private $upvotes;

    /**
     * @ORM\OneToMany(targetEntity=Downvote::class, mappedBy="user", orphanRemoval=true)
     */
    private $downvotes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\OneToOne(targetEntity=Avatar::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $profpic;



    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->upvotes = new ArrayCollection();
        $this->downvotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setPoster($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getPoster() === $this) {
                $post->setPoster(null);
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
            $upvote->setUser($this);
        }

        return $this;
    }

    public function removeUpvote(Upvotes $upvote): self
    {
        if ($this->upvotes->removeElement($upvote)) {
            // set the owning side to null (unless already changed)
            if ($upvote->getUser() === $this) {
                $upvote->setUser(null);
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
            $downvote->setUser($this);
        }

        return $this;
    }

    public function removeDownvote(Downvote $downvote): self
    {
        if ($this->downvotes->removeElement($downvote)) {
            // set the owning side to null (unless already changed)
            if ($downvote->getUser() === $this) {
                $downvote->setUser(null);
            }
        }

        return $this;
    }

    public function getProfpic(): ?Avatar
    {
        return $this->profpic;
    }

    public function setProfpic(?Avatar $profpic): self
    {
        // unset the owning side of the relation if necessary
        if ($profpic === null && $this->profpic !== null) {
            $this->profpic->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($profpic !== null && $profpic->getUser() !== $this) {
            $profpic->setUser($this);
        }

        $this->profpic = $profpic;

        return $this;
    }


}
