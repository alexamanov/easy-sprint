<?php

namespace App\Entity\Core\Schedule;

use App\Entity\Core\Sprint;
use App\Repository\Core\Schedule\CalendarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CalendarRepository::class)]
class Calendar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'calendar', cascade: ['persist', 'remove'])]
    private ?Sprint $sprint = null;

    #[ORM\Column(nullable: true)]
    private array $chunk_ids = [];

    #[ORM\Column(nullable: true)]
    private ?int $sprintId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSprint(): ?Sprint
    {
        return $this->sprint;
    }

    public function setSprint(?Sprint $sprint): self
    {
        $this->sprint = $sprint;

        return $this;
    }

    public function getChunkIds(): array
    {
        return $this->chunk_ids;
    }

    public function setChunkIds(?array $chunk_ids): self
    {
        $this->chunk_ids = $chunk_ids;

        return $this;
    }

    public function getSprintId(): ?int
    {
        return $this->sprintId;
    }

    public function setSprintId(?int $sprintId): self
    {
        $this->sprintId = $sprintId;

        return $this;
    }
}
