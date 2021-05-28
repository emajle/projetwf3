<?php

namespace App\Entity\Newsletter;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Newsletter\Usernews;
use App\Entity\Newsletter\Newsletters;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Newsletter\CatenewsRepository;

/**
 * @ORM\Entity(repositoryClass=CatenewsRepository::class)
 */
class Catenews
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Usernews::class, mappedBy="catenews")
     */
    private $usernews;

    /**
     * @ORM\OneToMany(targetEntity=Newsletters::class, mappedBy="catenews", orphanRemoval=true)
     */
    private $newsletters;

    public function __construct()
    {
        $this->usernews = new ArrayCollection();
        $this->newsletters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Usernews[]
     */
    public function getUsernews(): Collection
    {
        return $this->usernews;
    }

    public function addUsernews(Usernews $usernews): self
    {
        if (!$this->usernews->contains($usernews)) {
            $this->usernews[] = $usernews;
            $usernews->addCatenews($this);
        }

        return $this;
    }

    public function removeUsernews(Usernews $usernews): self
    {
        if ($this->usernews->removeElement($usernews)) {
            $usernews->removeCatenews($this);
        }

        return $this;
    }

    /**
     * @return Collection|Newsletters[]
     */
    public function getNewsletters(): Collection
    {
        return $this->newsletters;
    }

    public function addNewsletter(Newsletters $newsletter): self
    {
        if (!$this->newsletters->contains($newsletter)) {
            $this->newsletters[] = $newsletter;
            $newsletter->setCatenews($this);
        }

        return $this;
    }

    public function removeNewsletter(Newsletters $newsletter): self
    {
        if ($this->newsletters->removeElement($newsletter)) {
            // set the owning side to null (unless already changed)
            if ($newsletter->getCatenews() === $this) {
                $newsletter->setCatenews(null);
            }
        }

        return $this;
    }
}
