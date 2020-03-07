<?php

namespace App\DataProvider\Anplan;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Anplan\Activity;
use App\Repository\Anplan\ActivityRepository;
use App\Security\Jwt\User;
use Symfony\Component\Security\Core\Security;

class ActivityDataProvider implements
    ItemDataProviderInterface,
    RestrictedDataProviderInterface,
    CollectionDataProviderInterface
{
    private ActivityRepository $activityRepository;
    private Security $security;
    private ?User $user = null;

    public function __construct(
        ActivityRepository $activityRepository,
        Security $security
    ) {
        $this->activityRepository = $activityRepository;
        $this->security = $security;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Activity::class;
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Activity
    {
        /** @var Activity $activity */
        $activity = $this->activityRepository->find($id);

        if ($activity->isVisible()) {
            return $activity;
        }

        return $this->isAllowedToViewHidden() ? $activity : null;
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if ($resourceClass !== Activity::class) {
            throw new ResourceClassNotSupportedException();
        }

        $queryBuilder = $this->activityRepository->createQueryBuilder('t');

        if (!$this->isAllowedToViewHidden()) {
            $queryBuilder->where('t.visible = 1');
        }

        return $queryBuilder->getQuery()->getResult();
    }

    private function isAllowedToViewHidden(): bool
    {
        if ($this->user === null) {
            $this->user = $this->security->getUser();
        }

        return in_array('ROLE_STAFF', $this->user->getRoles());
    }
}
