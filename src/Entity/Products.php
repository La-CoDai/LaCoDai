<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="procart")
     */
    private $carts;

    /**
     * @ORM\OneToMany(targetEntity=Orderdetail::class, mappedBy="pid")
     */
    private $orderdetails;

    public function __construct()
    {
        $this->carts = new ArrayCollection();
        $this->orderdetails = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setProcart($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getProcart() === $this) {
                $cart->setProcart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Orderdetail>
     */
    public function getOrderdetails(): Collection
    {
        return $this->orderdetails;
    }

    public function addOrderdetail(Orderdetail $orderdetail): self
    {
        if (!$this->orderdetails->contains($orderdetail)) {
            $this->orderdetails[] = $orderdetail;
            $orderdetail->setPid($this);
        }

        return $this;
    }

    public function removeOrderdetail(Orderdetail $orderdetail): self
    {
        if ($this->orderdetails->removeElement($orderdetail)) {
            // set the owning side to null (unless already changed)
            if ($orderdetail->getPid() === $this) {
                $orderdetail->setPid(null);
            }
        }

        return $this;
    }
}
