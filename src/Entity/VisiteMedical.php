<?php

namespace App\Entity;

use App\Repository\VisiteMedicalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisiteMedicalRepository::class)
 */
class VisiteMedical
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_visite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $symptome;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $diagnostique;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $analyses;

    /**
     * @ORM\ManyToOne(targetEntity=Specialiste::class,)
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialiste;

    /**
     * @ORM\ManyToOne(targetEntity=CarnetSante::class, inversedBy="visiteMedicals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $carnet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVisite(): ?\DateTimeInterface
    {
        return $this->date_visite;
    }

    public function setDateVisite(\DateTimeInterface $date_visite): self
    {
        $this->date_visite = $date_visite;

        return $this;
    }

    public function getSymptome(): ?string
    {
        return $this->symptome;
    }

    public function setSymptome(?string $symptome): self
    {
        $this->symptome = $symptome;

        return $this;
    }

    public function getDiagnostique(): ?string
    {
        return $this->diagnostique;
    }

    public function setDiagnostique(?string $diagnostique): self
    {
        $this->diagnostique = $diagnostique;

        return $this;
    }

    public function getAnalyses(): ?string
    {
        return $this->analyses;
    }

    public function setAnalyses(?string $analyses): self
    {
        $this->analyses = $analyses;

        return $this;
    }

    public function getSpecialiste(): ?Specialiste
    {
        return $this->specialiste;
    }

    public function setSpecialiste(Specialiste $specialiste): self
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
}
