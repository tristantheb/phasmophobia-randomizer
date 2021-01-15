<?php

namespace App\Entity;

use App\Repository\HunterRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToMany(targetEntity=Item::class)
     */
    private ?Item $items;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private ?DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private ?DateTimeInterface $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Room::class, inversedBy="hunters")
     */
    private $currentRoom;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->currentRoom = new ArrayCollection();
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

    /**
     * @return Collection|Room[]
     */
    public function getCurrentRoom(): Collection
    {
        return $this->currentRoom;
    }

    public function addCurrentRoom(Room $currentRoom): self
    {
        if (!$this->currentRoom->contains($currentRoom)) {
            $this->currentRoom[] = $currentRoom;
        }

        return $this;
    }

    public function removeCurrentRoom(Room $currentRoom): self
    {
        $this->currentRoom->removeElement($currentRoom);

        return $this;
    }
}
