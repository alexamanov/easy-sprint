<?php

namespace App\Service\Core;

use App\Repository\Core\SprintRepository;

class GetSprintsForChoice
{
    public function __construct(
        private readonly SprintRepository $sprintRepository
    ) {
    }

    public function execute(): array
    {
        $result = [];

        $sprints = $this->sprintRepository->findAll();
        foreach ($sprints as $sprint) {
            $result[$sprint->getName()] = $sprint->getId();
        }

        return $result;
    }
}
