<?php

namespace App\Entity\Newsletter;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Newsletter\Catenews;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Newsletter\UsernewsRepository;

/**
 * @ORM\Entity(repositoryClass=UsernewsRepository::class)
 */
class Usernews
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
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_rgpd = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $validation_token;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_valid = false;

    /**
     * @ORM\ManyToMany(targetEntity=Catenews::class, inversedBy="usernews")
     */
    private $catenews;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->catenews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getIsRgpd(): ?bool
    {
        return $this->is_rgpd;
    }

    public function setIsRgpd(bool $is_rgpd): self
    {
        $this->is_rgpd = $is_rgpd;

        return $this;
    }

    public function getValidationToken(): ?string
    {
        return $this->validation_token;
    }

    public function setValidationToken(string $validation_token): self
    {
        $this->validation_token = $validation_token;

        return $this;
    }

    public function getIsValid(): ?bool
    {
        return $this->is_valid;
    }

    public function setIsValid(bool $is_valid): self
    {
        $this->is_valid = $is_valid;

        return $this;
    }

    /**
     * @return Collection|Catenews[]
     */
    public function getCatenews(): Collection
    {
        return $this->catenews;
    }

    public function addCatenews(Catenews $catenews): self
    {
        if (!$this->catenews->contains($catenews)) {
            $this->catenews[] = $catenews;
            // $catenews->addUsernews($this);
        }

        return $this;
    }

    public function removeCatenews(Catenews $catenews): self
    {
        $this->catenews->removeElement($catenews);
        return $this;
    }
}
