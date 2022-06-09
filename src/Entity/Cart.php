<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private $date_cart;

    #[ORM\ManyToMany(targetEntity: Pizza::class, mappedBy: 'cart')]
    private $pizzas;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'cart')]
    private $menus;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'carts')]
    private $user;

    #[ORM\ManyToMany(targetEntity: Drink::class, inversedBy: 'carts')]
    private $drink;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
        $this->menus = new ArrayCollection();
        $this->drink = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCart(): ?\DateTimeImmutable
    {
        return $this->date_cart;
    }

    public function setDateCart(\DateTimeImmutable $date_cart): self
    {
        $this->date_cart = $date_cart;

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
            $pizza->addCart($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        if ($this->pizzas->removeElement($pizza)) {
            $pizza->removeCart($this);
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
            $menu->addCart($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeCart($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
}
