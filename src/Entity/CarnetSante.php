<?php

namespace App\Entity;

use App\Repository\CarnetSanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarnetSanteRepository::class)
 */
class CarnetSante
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=VisiteMedical::class, mappedBy="carnet", orphanRemoval=true)
     */
    private $visiteMedicals;

    /**
     * @ORM\OneToOne(targetEntity=Animal::class, inversedBy="carnetSante", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $animal;

    public function __construct()
    {
        $this->visiteMedicals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|VisiteMedical[]
     */
    public function getVisiteMedicals(): Collection
    {
        return $this->visiteMedicals;
    }

    public function addVisiteMedical(VisiteMedical $visiteMedical): self
    {
        if (!$this->visiteMedicals->contains($visiteMedical)) {
            $this->visiteMedicals[] = $visiteMedical;
            $visiteMedical->setCarnet($this);
        }

        return $this;
    }

    public function removeVisiteMedical(VisiteMedical $visiteMedical): self
    {
        if ($this->visiteMedicals->removeElement($visiteMedical)) {
            // set the owning side to null (unless already changed)
            if ($visiteMedical->getCarnet() === $this) {
                $visiteMedical->setCarnet(null);
            }
        }

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }
}
