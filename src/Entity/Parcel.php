<?php

namespace App\Entity;

use App\Repository\ParcelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcelRepository::class)
 */
class Parcel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ParcelType::class, inversedBy="parcels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Courier::class, inversedBy="parcels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $courier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?ParcelType
    {
        return $this->type;
    }

    public function setType(?ParcelType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCourier(): ?Courier
    {
        return $this->courier;
    }

    public function setCourier(?Courier $courier): self
    {
        $this->courier = $courier;

        return $this;
    }
}
