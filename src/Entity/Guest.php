<?php

namespace App\Entity;

use App\Repository\GuestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestRepository::class)]
#[ORM\Table(name: 'guest')]
class Guest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $willAttend = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    /**
     * @var Collection<int, Drink>
     */
    #[ORM\ManyToMany(targetEntity: Drink::class)]
    private Collection $preferredDrinks;

    public function __construct(#[ORM\Column(length: 255)]
    private ?string $firstName, #[ORM\Column(length: 255)]
    private ?string $surname, #[ORM\Column(nullable: true)]
    private ?bool $willAttendMainCeremony = null, #[ORM\Column(length: 255, nullable: true)]
    private ?string $gender = null)
    {
        $this->preferredDrinks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function isWillAttend(): ?bool
    {
        return $this->willAttend;
    }

    public function setWillAttend(bool $willAttend): static
    {
        $this->willAttend = $willAttend;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function isWillAttendMainCeremony(): ?bool
    {
        return $this->willAttendMainCeremony;
    }

    public function setWillAttendMainCeremony(?bool $willAttendMainCeremony): static
    {
        $this->willAttendMainCeremony = $willAttendMainCeremony;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, Drink>
     */
    public function getPreferredDrinks(): Collection
    {
        return $this->preferredDrinks;
    }

    /**
     * @param array $drinks
     * @return Guest
     */
    public function setPreferredDrinks(array $drinks): static
    {
        foreach ($drinks as $drink) {
            $this->preferredDrinks->add($drink);
        }

        return $this;
    }

    public function addPreferredDrink(Drink $preferredDrink): static
    {
        if (!$this->preferredDrinks->contains($preferredDrink)) {
            $this->preferredDrinks->add($preferredDrink);
        }

        return $this;
    }

    public function removePreferredDrink(Drink $preferredDrink): static
    {
        $this->preferredDrinks->removeElement($preferredDrink);

        return $this;
    }
}
