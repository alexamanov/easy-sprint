<?php

namespace App\Service\Handler\Save\Bundle;

use App\Entity\Core\Bundle;
use App\Entity\Core\Task;
use App\Repository\Core\TaskRepository;

class TaskSaveHandler
{
    public function __construct (
       private readonly TaskRepository $taskRepository
    ) {
    }

    public function save(Bundle $bundle): void
    {
        foreach ($bundle->getTasks() as $task) {
            if (filter_var($task, FILTER_VALIDATE_URL)) {
                $taskLink = $task;
                $task = basename($task);
                $taskEntity = $this->taskRepository->findOneByLink($taskLink);
            } else {
                $taskEntity = $this->taskRepository->findOneByCode($task);
            }

            if (!$taskEntity) {
                $taskEntity = new Task();
                $taskEntity->setCode($task);
                $taskEntity->setLink($taskLink ?? null);
                $this->taskRepository->save($taskEntity);
            }
        }
    }
}
