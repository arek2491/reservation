<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $fromDate = null;

    #[ORM\Column]
    private ?\DateTime $toDate = null;

    #[ORM\Column(length: 40)]
    private ?string $guestName = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $price24 = null;

   #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'reservations')]
   private ?Room $room = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromDate(): ?\DateTime
    {
        return $this->fromDate;
    }

    public function setFromDate(\DateTime $fromDate): static
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    public function getToDate(): ?\DateTime
    {
        return $this->toDate;
    }

    public function setToDate(\DateTime $toDate): static
    {
        $this->toDate = $toDate;

        return $this;
    }

    public function getGuestName(): ?string
    {
        return $this->guestName;
    }

    public function setGuestName(string $guestName): static
    {
        $this->guestName = $guestName;

        return $this;
    }

    public function getPrice24(): ?string
    {
        return $this->price24;
    }

    public function setPrice24(string $price24): static
    {
        $this->price24 = $price24;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }


    public function setRoom(?Room $room): self
    {
        $this->room = $room;
        return $this;
    }

}
