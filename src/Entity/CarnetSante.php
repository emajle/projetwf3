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
     * @ORM\OneToMany(targetEntity=VisiteMedical::class, mappedBy="carnet", cascade={"persist", "remove"})
     */
    private $visiteMedicals;

    /**
     * @ORM\OneToMany(targetEntity=VaccinsEtOperation::class, mappedBy="carnet", cascade={"persist", "remove"})
     */
    private $vaccinsEtOperation;

    /**
     * @ORM\OneToOne(targetEntity=Animal::class, inversedBy="carnetSante", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="carnetSantes")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=QrCode::class, mappedBy="carnet", cascade={"persist", "remove"})
     */
    private $qrCode;

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

    /**
     * @return Collection|VaccinsEtOperation[]
     */
    public function getVaccinsEtOperation(): Collection
    {
        return $this->vaccinsEtOperation;
    }

    public function addVaccinsEtOperation(VaccinsEtOperation $visiteMedical): self
    {
        if (!$this->vaccinsEtOperation->contains($visiteMedical)) {
            $this->vaccinsEtOperation[] = $visiteMedical;
            $visiteMedical->setCarnet($this);
        }

        return $this;
    }

    public function removeVaccinsEtOperation(VaccinsEtOperation $visiteMedical): self
    {
        if ($this->vaccinsEtOperation->removeElement($visiteMedical)) {
            // set the owning side to null (unless already changed)
            if ($visiteMedical->getCarnet() === $this) {
                $visiteMedical->setCarnet(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getQrCode(): ?QrCode
    {
        return $this->qrCode;
    }

    public function setQrCode(?QrCode $qrCode): self
    {
        // unset the owning side of the relation if necessary
        if ($qrCode === null && $this->qrCode !== null) {
            $this->qrCode->setCarnet(null);
        }

        // set the owning side of the relation if necessary
        if ($qrCode !== null && $qrCode->getCarnet() !== $this) {
            $qrCode->setCarnet($this);
        }

        $this->qrCode = $qrCode;

        return $this;
    }
}
