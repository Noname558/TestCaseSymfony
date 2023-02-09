<?php

namespace App\Entity;

use App\Controller\ArendaController;
use App\Repository\PeopleRentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: PeopleRentRepository::class)]
class PeopleRent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;


    #[ORM\OneToMany(mappedBy: "people", targetEntity: "Message")]
    private $idarenda;

    public function __constructor(){
        $this->idarenda = new ArrayCollection();
    }
    /**
     * @return Collection|Message[]
     */
    public function getMessage(): Collection
    {
        return $this->idarenda;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getIdarenda(): ?int
    {
        return $this->idarenda;
    }

    public function setIdArenda(int $idarenda): self
    {
        $this->idarenda=$idarenda;

        return $this;
    }
}
