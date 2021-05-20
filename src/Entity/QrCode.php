<?php

namespace App\Entity;

use App\Repository\QrCodeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QrCodeRepository::class)
 */
class QrCode
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
    private $image_qrc;

    /**
     * @ORM\OneToOne(targetEntity=Animal::class, inversedBy="qrCode", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $animal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageQrc(): ?string
    {
        return $this->image_qrc;
    }

    public function setImageQrc(string $image_qrc): self
    {
        $this->image_qrc = $image_qrc;

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
