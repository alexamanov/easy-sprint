<?php

namespace App\Entity\Core;

use App\Entity\Core\Schedule\Calendar;
use App\Repository\Core\SprintRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SprintRepository::class)]
class Sprint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $name = null;

    #[ORM\Column(type: Types::JSON)]
    private array $users = [];

    #[ORM\Column(type: Types::JSON)]
    private array $tasks = [];

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end = null;

    #[ORM\Column(nullable: true)]
    private ?int $estimate = null;

    #[ORM\Column(nullable: true)]
    private ?int $spent = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $status = null;

    #[ORM\OneToOne(mappedBy: 'sprint', cascade: ['persist', 'remove'])]
    private ?Calendar $calendar = null;

    #[ORM\ManyToOne(inversedBy: 'sprints')]
    private ?Bundle $bundle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function setUsers(array $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function setTasks(array $tasks): self
    {
        $this->tasks = $tasks;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(?\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getEstimate(): ?int
    {
        return $this->estimate;
    }

    public function setEstimate(?int $estimate): self
    {
        $this->estimate = $estimate;

        return $this;
    }

    public function getSpent(): ?int
    {
        return $this->spent;
    }

    public function setSpent(?int $spent): self
    {
        $this->spent = $spent;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCalendar(): ?Calendar
    {
        return $this->calendar;
    }

    public function setCalendar(?Calendar $calendar): self
    {
        // unset the owning side of the relation if necessary
        if ($calendar === null && $this->calendar !== null) {
            $this->calendar->setSprint(null);
        }

        // set the owning side of the relation if necessary
        if ($calendar !== null && $calendar->getSprint() !== $this) {
            $calendar->setSprint($this);
        }

        $this->calendar = $calendar;

        return $this;
    }

    public function getBundle(): ?Bundle
    {
        return $this->bundle;
    }

    public function setBundle(?Bundle $bundle): self
    {
        $this->bundle = $bundle;

        return $this;
    }
}
