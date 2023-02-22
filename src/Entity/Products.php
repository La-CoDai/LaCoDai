<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 */
class Products
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
    private $pname;

    /**
     * @ORM\Column(type="integer")
     */
    private $pprice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pimg;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pgender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdes;

    /**
     * @ORM\ManyToOne(targetEntity=Brands::class, inversedBy="pros")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPname(): ?string
    {
        return $this->pname;
    }

    public function setPname(string $pname): self
    {
        $this->pname = $pname;

        return $this;
    }

    public function getPprice(): ?int
    {
        return $this->pprice;
    }

    public function setPprice(int $pprice): self
    {
        $this->pprice = $pprice;

        return $this;
    }

    public function getPimg(): ?string
    {
        return $this->pimg;
    }

    public function setPimg(string $pimg): self
    {
        $this->pimg = $pimg;

        return $this;
    }

    public function isPgender(): ?bool
    {
        return $this->pgender;
    }

    public function setPgender(?bool $pgender): self
    {
        $this->pgender = $pgender;

        return $this;
    }

    public function getPdes(): ?string
    {
        return $this->pdes;
    }

    public function setPdes(?string $pdes): self
    {
        $this->pdes = $pdes;

        return $this;
    }

    public function getBrand(): ?Brands
    {
        return $this->brand;
    }

    public function setBrand(?Brands $brand): self
    {
        $this->brand = $brand;

        return $this;
    }
}
