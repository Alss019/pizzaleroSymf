<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descr;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img;

    #[ORM\Column(type: 'float', nullable: true)]
    private $price;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $qtx;

    #[ORM\ManyToMany(targetEntity: Cart::class, mappedBy: 'menu')]
    private $carts;

    #[ORM\ManyToMany(targetEntity: Pizza::class, inversedBy: 'menus')]
    private $pizza;

    #[ORM\ManyToMany(targetEntity: Drink::class, inversedBy: 'menus')]
    private $drink;

    public function __construct()
    {
        $this->carts = new ArrayCollection();
        $this->pizza = new ArrayCollection();
        $this->drink = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(?string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQtx(): ?int
    {
        return $this->qtx;
    }

    public function setQtx(?int $qtx): self
    {
        $this->qtx = $qtx;

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
            $cart->addMenu($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            $cart->removeMenu($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizza(): Collection
    {
        return $this->pizza;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizza->contains($pizza)) {
            $this->pizza[] = $pizza;
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        $this->pizza->removeElement($pizza);

        return $this;
    }

    /**
     * @return Collection<int, Drink>
     */
    public function getDrink(): Collection
    {
        return $this->drink;
    }

    public function addDrink(Drink $drink): self
    {
        if (!$this->drink->contains($drink)) {
            $this->drink[] = $drink;
        }

        return $this;
    }

    public function removeDrink(Drink $drink): self
    {
        $this->drink->removeElement($drink);

        return $this;
    }
}
