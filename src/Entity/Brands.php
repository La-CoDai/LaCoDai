<?php

namespace App\Entity;

use App\Repository\BrandsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BrandsRepository::class)
 */
class Brands
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
    private $bname;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="brand")
     */
    private $pros;

    public function __construct()
    {
        $this->pros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBname(): ?string
    {
        return $this->bname;
    }

    public function setBname(string $bname): self
    {
        $this->bname = $bname;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getPros(): Collection
    {
        return $this->pros;
    }

    public function addPro(Products $pro): self
    {
        if (!$this->pros->contains($pro)) {
            $this->pros[] = $pro;
            $pro->setBrand($this);
        }

        return $this;
    }

    public function removePro(Products $pro): self
    {
        if ($this->pros->removeElement($pro)) {
            // set the owning side to null (unless already changed)
            if ($pro->getBrand() === $this) {
                $pro->setBrand(null);
            }
        }

        return $this;
    }
}
