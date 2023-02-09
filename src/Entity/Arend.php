<?php

namespace App\Entity;

use App\Repository\ArendRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArendRepository::class)]
class Arend
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\ManyToOne(targetEntity: "App\Entity\PeopleRent",inversedBy:'id')]
    private PeopleRent $people;

    #[ORM\ManyToOne(targetEntity: "Message",inversedBy: 'id')]
    private Message $message;

    #[ORM\Column(type: 'datetime')]
    private DateTime $start;

    #[ORM\Column(type: 'datetime')]
    private DateTime $finish;

    public function getPeople(): ?PeopleRent
    {
        return $this->people;
    }

    public function setPeople(?PeopleRent $people): self
    {
        $this->people=$people;
        return $this;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * @param ?Message $message
     */
    public function setMessage(?Message $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStart(): DateTime
    {
        return $this->start;
    }

    /**
     * @param DateTime $start
     * @return Arend
     */
    public function setStart(DateTime $start): self
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getFinish(): DateTime
    {
        return $this->finish;
    }

    /**
     * @param DateTime $finish
     */
    public function setFinish(DateTime $finish): self
    {
        $this->finish = $finish;

        return $this;
    }
}
