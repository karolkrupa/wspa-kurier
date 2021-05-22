<?php

namespace App\Entity;

use App\Repository\ParcelTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcelTypeRepository::class)
 */
class ParcelType
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
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $realizationDays;

    /**
     * @ORM\Column(type="float")
     */
    private $insuranceAmount = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxWeight;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRealizationDays(): ?int
    {
        return $this->realizationDays;
    }

    public function setRealizationDays(int $realizationDays): self
    {
        $this->realizationDays = $realizationDays;

        return $this;
    }

    public function getInsuranceAmount(): ?float
    {
        return $this->insuranceAmount;
    }

    public function setInsuranceAmount(float $insuranceAmount): self
    {
        $this->insuranceAmount = $insuranceAmount;

        return $this;
    }

    public function getMaxWeight(): ?int
    {
        return $this->maxWeight;
    }

    public function setMaxWeight(?int $maxWeight): self
    {
        $this->maxWeight = $maxWeight;

        return $this;
    }
}
