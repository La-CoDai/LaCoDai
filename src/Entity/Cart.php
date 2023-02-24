<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="carts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $procart;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="carts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usercart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProcart(): ?Products
    {
        return $this->procart;
    }

    public function setProcart(?Products $procart): self
    {
        $this->procart = $procart;

        return $this;
    }

    public function getUsercart(): ?User
    {
        return $this->usercart;
    }

    public function setUsercart(?User $usercart): self
    {
        $this->usercart = $usercart;

        return $this;
    }
}
