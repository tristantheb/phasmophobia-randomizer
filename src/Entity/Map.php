<?php

namespace App\Entity;

use App\Repository\MapRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MapRepository::class)
 */
class Map
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
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="mapName")
     */
    private $roomId;

    public function __construct()
    {
        $this->roomId = new ArrayCollection();
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

    /**
     * @return Collection|Room[]
     */
    public function getRoomId(): Collection
    {
        return $this->roomId;
    }

    public function addRoomId(Room $roomId): self
    {
        if (!$this->roomId->contains($roomId)) {
            $this->roomId[] = $roomId;
            $roomId->setMapName($this);
        }

        return $this;
    }

    public function removeRoomId(Room $roomId): self
    {
        if ($this->roomId->removeElement($roomId)) {
            // set the owning side to null (unless already changed)
            if ($roomId->getMapName() === $this) {
                $roomId->setMapName(null);
            }
        }

        return $this;
    }
}
