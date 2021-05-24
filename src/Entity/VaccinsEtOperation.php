<?php

namespace App\Entity;

use App\Repository\VaccinsEtOperationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VaccinsEtOperationRepository::class)
 */
class VaccinsEtOperation
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $action;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Specialiste::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialiste;

    /**
     * @ORM\ManyToOne(targetEntity=CarnetSante::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $carnet;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSpecialiste(): ?Specialiste
    {
        return $this->specialiste;
    }

    public function setSpecialiste(?Specialiste $specialiste): self
    {
        $this->specialiste = $specialiste;

        return $this;
    }

    public function getCarnet(): ?CarnetSante
    {
        return $this->carnet;
    }

    public function setCarnet(?CarnetSante $carnet): self
    {
        $this->carnet = $carnet;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
