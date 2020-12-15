<?php

namespace App\Entity;

use App\Repository\HunterRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HunterRepository::class)
 */
class Hunter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private ?string $name;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class)
     */
    private ?Item $items;

    /**
     * @ORM\OneToOne(targetEntity=Room::class, mappedBy="creator", cascade={"persist", "remove"})
     */
    private ?Room $room;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private ?DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private ?DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
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

    public function getItems(): ?Item
    {
        return $this->items;
    }

    public function setItems(?Item $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(Room $room): self
    {
        $this->room = $room;

        // set the owning side of the relation if necessary
        if ($room->getCreator() !== $this) {
            $room->setCreator($this);
        }

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
