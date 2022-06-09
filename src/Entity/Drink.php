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

    #[ORM\Column(type: 'string', length: 50)]
    private $name_drink;

    #[ORM\Column(type: 'float')]
    private $price_drink;

    #[ORM\Column(type: 'text')]
    private $desc_drink;

    #[ORM\Column(type: 'string', length: 255)]
    private $img_drink;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'drink')]
    private $menus;

    #[ORM\ManyToMany(targetEntity: Cart::class, mappedBy: 'drink')]
    private $carts;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->carts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameDrink(): ?string
    {
        return $this->name_drink;
    }

    public function setNameDrink(string $name_drink): self
    {
        $this->name_drink = $name_drink;

        return $this;
    }

    public function getPriceDrink(): ?float
    {
        return $this->price_drink;
    }

    public function setPriceDrink(float $price_drink): self
    {
        $this->price_drink = $price_drink;

        return $this;
    }

    public function getDescDrink(): ?string
    {
        return $this->desc_drink;
    }

    public function setDescDrink(string $desc_drink): self
    {
        $this->desc_drink = $desc_drink;

        return $this;
    }

    public function getImgDrink(): ?string
    {
        return $this->img_drink;
    }

    public function setImgDrink(string $img_drink): self
    {
        $this->img_drink = $img_drink;

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
}
