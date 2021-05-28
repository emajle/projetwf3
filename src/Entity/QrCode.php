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
     * @ORM\OneToOne(targetEntity=CarnetSante::class, inversedBy="qrCode", cascade={"persist", "remove"})
     */
    private $carnet;

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
