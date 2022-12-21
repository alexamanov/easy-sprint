<?php

namespace App\Service\Core;

use App\Repository\Core\BundleRepository;

class GetAllBundlesForChoice
{
    public function __construct(private readonly BundleRepository $bundleRepository) {
    }

    public function execute(): array
    {
        $result = [];

        $bundles = $this->bundleRepository->findAll();
        foreach ($bundles as $bundle) {
            $result[$bundle->getName()] = $bundle->getId();
        }

        return $result;
    }
}
