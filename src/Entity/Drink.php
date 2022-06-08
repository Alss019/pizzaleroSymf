<?php

namespace App\Entity;

use App\Repository\DrinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DrinkRepository::class)]
class Drink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $name;

    #[ORM\Column(type: 'float', nullable: true)]
    private $price;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descr;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $qtx_cart;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $qtx_menu;

    #[ORM\ManyToMany(targetEntity: Cart::class, mappedBy: 'drink')]
    private $carts;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'drink')]
    private $menus;

    public function __construct()
    {
        $this->carts = new ArrayCollection();
        $this->menus = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

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

    public function getQtxCart(): ?int
    {
        return $this->qtx_cart;
    }

    public function setQtxCart(?int $qtx_cart): self
    {
        $this->qtx_cart = $qtx_cart;

        return $this;
    }

    public function getQtxMenu(): ?int
    {
        return $this->qtx_menu;
    }

    public function setQtxMenu(?int $qtx_menu): self
    {
        $this->qtx_menu = $qtx_menu;

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
            $cart->addDrink($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            $cart->removeDrink($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addDrink($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeDrink($this);
        }

        return $this;
    }
}
