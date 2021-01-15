<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $roomNumber;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private ?DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private ?DateTimeInterface $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Hunter::class, mappedBy="currentRoom")
     */
    private ?ArrayCollection $hunters;

    /**
     * @ORM\ManyToOne(targetEntity=Map::class, inversedBy="roomId")
     */
    private ?Map $map;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->hunters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomNumber(): ?int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(int $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

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
     * @return Collection|Hunter[]
     */
    public function getHunters(): Collection
    {
        return $this->hunters;
    }

    public function addHunter(Hunter $hunter): self
    {
        if (!$this->hunters->contains($hunter)) {
            $this->hunters[] = $hunter;
            $hunter->addCurrentRoom($this);
        }

        return $this;
    }

    public function removeHunter(Hunter $hunter): self
    {
        if ($this->hunters->removeElement($hunter)) {
            $hunter->removeCurrentRoom($this);
        }

        return $this;
    }

    public function getMap(): ?Map
    {
        return $this->map;
    }

    public function setMap(?Map $mapName): self
    {
        $this->map = $mapName;

        return $this;
    }
}
