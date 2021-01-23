<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Hunter::class, inversedBy="items")
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
