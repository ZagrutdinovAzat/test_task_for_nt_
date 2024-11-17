<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $eventId;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $eventDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ticketAdultPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ticketAdultQuantity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ticketKidPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ticketKidQuantity;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $barcode;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $userId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $equalPrice;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    // Геттеры и сеттеры

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventId(): ?int
    {
        return $this->eventId;
    }

    public function setEventId(?int $eventId): self
    {
        $this->eventId = $eventId;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->eventDate;
    }

    public function setEventDate(?\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getTicketAdultPrice(): ?int
    {
        return $this->ticketAdultPrice;
    }

    public function setTicketAdultPrice(?int $ticketAdultPrice): self
    {
        $this->ticketAdultPrice = $ticketAdultPrice;

        return $this;
    }

    public function getTicketAdultQuantity(): ?int
    {
        return $this->ticketAdultQuantity;
    }

    public function setTicketAdultQuantity(?int $ticketAdultQuantity): self
    {
        $this->ticketAdultQuantity = $ticketAdultQuantity;

        return $this;
    }

    public function getTicketKidPrice(): ?int
    {
        return $this->ticketKidPrice;
    }

    public function setTicketKidPrice(?int $ticketKidPrice): self
    {
        $this->ticketKidPrice = $ticketKidPrice;

        return $this;
    }

    public function getTicketKidQuantity(): ?int
    {
        return $this->ticketKidQuantity;
    }

    public function setTicketKidQuantity(?int $ticketKidQuantity): self
    {
        $this->ticketKidQuantity = $ticketKidQuantity;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getEqualPrice(): ?int
    {
        return $this->equalPrice;
    }

    public function setEqualPrice(?int $equalPrice): self
    {
        $this->equalPrice = $equalPrice;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
}

