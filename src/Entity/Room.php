<?php

namespace App\Entity;

use App\Repository\RoomRepository;
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
    private $id;

    /**
     * @ORM\Column(type="integer", length=6)
     */
    private $roomId;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $mapName;

    /**
     * @ORM\ManyToMany(targetEntity=Hunter::class, inversedBy="rooms")
     */
    private $hunters;

    public function __construct()
    {
        $this->hunters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomId(): ?int
    {
        return $this->roomId;
    }

    public function setRoomId(int $roomId): self
    {
        $this->roomId = $roomId;

        return $this;
    }

    public function getMapName(): ?string
    {
        return $this->mapName;
    }

    public function setMapName(?string $mapName): self
    {
        $this->mapName = $mapName;

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
        }

        return $this;
    }

    public function removeHunter(Hunter $hunter): self
    {
        $this->hunters->removeElement($hunter);

        return $this;
    }
}
