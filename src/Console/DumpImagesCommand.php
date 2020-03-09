<?php

namespace App\Console;

use App\Anplan\FileHelper;
use App\Entity\Anplan\Activity;
use App\Repository\Anplan\ActivityRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class DumpImagesCommand extends Command
{
    private ActivityRepository $activityRepository;
    private KernelInterface $kernel;
    private ?string $imageDir = null;

    public function __construct(ActivityRepository $activityRepository, KernelInterface $kernel)
    {
        parent::__construct();

        $this->activityRepository = $activityRepository;
        $this->kernel = $kernel;
    }

    protected function configure(): void
    {
        $this
            ->setName('animecon:dump:images')
            ->setDescription('Dumps images for activities, etc.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Fetching activities...');

        $activities = $this->activityRepository->createQueryBuilder('t')
            ->where('t.largeImage IS NOT NULL')
            ->orWhere('t.smallImage IS NOT NULL')
            ->getQuery()
            ->getResult();

        $this->imageDir = $this->kernel->getProjectDir() . '/public/images/';

        if (!file_exists($this->imageDir) && !mkdir($this->imageDir) && !is_dir($this->imageDir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $this->imageDir));
        }

        $output->writeln('Saving files...');

        $progressBar = new ProgressBar($output, count($activities));
        $progressBar->start();

        /** @var Activity $activity */
        foreach ($activities as $activity) {
            // Save small image if exists
            if ($activity->getSmallImage()) {
                $this->resourceToFile(
                    $activity->getSmallImage(),
                    sprintf('activity-%d-small', $activity->getId())
                );
            }

            // Save large image if exists
            if ($activity->getLargeImage()) {
                $this->resourceToFile(
                    $activity->getLargeImage(),
                    sprintf('activity-%d-large', $activity->getId())
                );
            }

            $progressBar->advance();
        }

        $progressBar->finish();

        $output->writeln('All files saved!');

        return 0;
    }

    private function resourceToFile($resource, $filename)
    {
        $file = FileHelper::fromResource($resource);

        file_put_contents($this->imageDir . $filename . '.' . $file->getExtension(), $file->getContents());
    }
}
