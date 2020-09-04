<?php

namespace App\DataProvider\Anplan;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\EagerLoadingExtension;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryResultCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Anplan\Activity;
use App\Repository\Anplan\ActivityRepository;
use Symfony\Component\Security\Core\Security;

class ActivityDataProvider implements
    ItemDataProviderInterface,
    RestrictedDataProviderInterface,
    ContextAwareCollectionDataProviderInterface
{
    private ActivityRepository $activityRepository;
    private Security $security;
    private $collectionExtensions;

    /**
     * @param QueryCollectionExtensionInterface[] $collectionExtensions
     */
    public function __construct(
        ActivityRepository $activityRepository,
        Security $security,
        iterable $collectionExtensions = []
    ) {
        $this->activityRepository = $activityRepository;
        $this->security = $security;
        $this->collectionExtensions = $collectionExtensions;
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
        $activity = $this->activityRepository->find($id);

        if ($activity === null) {
            return null;
        }
        if ($activity->isVisible()) {
            return $activity;
        }
        if (!$this->isAllowedToViewHidden()) {
            return null;
        }

        return $activity;
    }

    private function isAllowedToViewHidden(): bool
    {
        return $this->security->isGranted('ROLE_STAFF');
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, string $operationName = null, $context = null)
    {
        if ($resourceClass !== Activity::class) {
            throw new ResourceClassNotSupportedException('Invalid resource ' . $resourceClass);
        }

        $queryBuilder = $this->activityRepository->createQueryBuilder('t');

        if (!$this->isAllowedToViewHidden()) {
            $queryBuilder->where('t.visible = 1');
        }

        // Apply extensions
        $queryNameGenerator = new QueryNameGenerator();
        foreach ($this->collectionExtensions as $extension) {
            // Just skip this one for now or it crashes
            if ($extension instanceof EagerLoadingExtension) {
                continue;
            }
            $extension->applyToCollection($queryBuilder, $queryNameGenerator, $resourceClass, $operationName, $context);

            if ($extension instanceof QueryResultCollectionExtensionInterface && $extension->supportsResult(
                $resourceClass,
                $operationName,
                $context
            )) {
                return $extension->getResult($queryBuilder, $resourceClass, $operationName, $context);
            }
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
