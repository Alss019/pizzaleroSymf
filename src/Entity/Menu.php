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

    #[ORM\Column(type: 'string', length: 50)]
    private $name_menu;

    #[ORM\Column(type: 'text')]
    private $desc_menu;

    #[ORM\Column(type: 'string', length: 50)]
    private $img_menu;

    #[ORM\Column(type: 'float')]
    private $price_menu;

    #[ORM\ManyToMany(targetEntity: Pizza::class, mappedBy: 'menu')]
    private $pizzas;

    #[ORM\ManyToMany(targetEntity: Drink::class, inversedBy: 'menus')]
    private $drink;

    #[ORM\ManyToMany(targetEntity: Cart::class, inversedBy: 'menus')]
    private $cart;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
        $this->drink = new ArrayCollection();
        $this->cart = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMenu(): ?string
    {
        return $this->name_menu;
    }

    public function setNameMenu(string $name_menu): self
    {
        $this->name_menu = $name_menu;

        return $this;
    }

    public function getDescMenu(): ?string
    {
        return $this->desc_menu;
    }

    public function setDescMenu(string $desc_menu): self
    {
        $this->desc_menu = $desc_menu;

        return $this;
    }

    public function getImgMenu(): ?string
    {
        return $this->img_menu;
    }

    public function setImgMenu(string $img_menu): self
    {
        $this->img_menu = $img_menu;

        return $this;
    }

    public function getPriceMenu(): ?float
    {
        return $this->price_menu;
    }

    public function setPriceMenu(float $price_menu): self
    {
        $this->price_menu = $price_menu;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas[] = $pizza;
            $pizza->addMenu($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        if ($this->pizzas->removeElement($pizza)) {
            $pizza->removeMenu($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, drink>
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

    /**
     * @return Collection<int, cart>
     */
    public function getCart(): Collection
    {
        return $this->cart;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->cart->contains($cart)) {
            $this->cart[] = $cart;
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        $this->cart->removeElement($cart);

        return $this;
    }
}
