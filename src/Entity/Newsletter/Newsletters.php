<?php

namespace App\Entity\Newsletter;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Newsletter\Catenews;
use App\Repository\Newsletter\NewslettersRepository;

/**
 * @ORM\Entity(repositoryClass=NewslettersRepository::class)
 */
class Newsletters
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_sent = false;

    /**
     * @ORM\ManyToOne(targetEntity=Catenews::class, inversedBy="newsletters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $catenews;

    public function __construct()
    {
        $this->created_at = new \DateTime();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getIsSent(): ?bool
    {
        return $this->is_sent;
    }

    public function setIsSent(bool $is_sent): self
    {
        $this->is_sent = $is_sent;

        return $this;
    }

    public function getCatenews(): ?Catenews
    {
        return $this->catenews;
    }

    public function setCatenews(?Catenews $catenews): self
    {
        $this->catenews = $catenews;

        return $this;
    }
}
