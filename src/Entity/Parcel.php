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

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="parcels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $senderAddress;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="parcels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipientAddress;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additionalInformations;

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

    public function getSenderAddress(): ?Address
    {
        return $this->senderAddress;
    }

    public function setSenderAddress(?Address $senderAddress): self
    {
        $this->senderAddress = $senderAddress;

        return $this;
    }

    public function getRecipientAddress(): ?Address
    {
        return $this->recipientAddress;
    }

    public function setRecipientAddress(?Address $recipientAddress): self
    {
        $this->recipientAddress = $recipientAddress;

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

    public function getAdditionalInformations(): ?string
    {
        return $this->additionalInformations;
    }

    public function setAdditionalInformations(?string $additionalInformations): self
    {
        $this->additionalInformations = $additionalInformations;

        return $this;
    }
}
