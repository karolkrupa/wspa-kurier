<?php

namespace App\Entity;

use App\Repository\ParcelTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcelTypeRepository::class)
 */
class ParcelType
{
    public function __toString()
    {
        return $this->name;
    }

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

    /**
     * @ORM\OneToMany(targetEntity=Parcel::class, mappedBy="type")
     */
    private $parcels;

    public function __construct()
    {
        $this->parcels = new ArrayCollection();
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

    /**
     * @return Collection|Parcel[]
     */
    public function getParcels(): Collection
    {
        return $this->parcels;
    }

    public function addParcel(Parcel $parcel): self
    {
        if (!$this->parcels->contains($parcel)) {
            $this->parcels[] = $parcel;
            $parcel->setType($this);
        }

        return $this;
    }

    public function removeParcel(Parcel $parcel): self
    {
        if ($this->parcels->removeElement($parcel)) {
            // set the owning side to null (unless already changed)
            if ($parcel->getType() === $this) {
                $parcel->setType(null);
            }
        }

        return $this;
    }
}
