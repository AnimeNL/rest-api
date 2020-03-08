<?php

namespace App\Console;

use App\Entity\Anplan\Scope;
use App\Repository\Anplan\ScopeRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateTokenCommand extends Command
{
    private ScopeRepository $scopeRepository;
    private JWTEncoderInterface $encoder;

    public function __construct(
        JWTEncoderInterface $encoder,
        ScopeRepository $scopeRepository
    ) {
        $this->scopeRepository = $scopeRepository;
        $this->encoder = $encoder;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('animecon:token:generate')
            ->setDescription('Generate a token for debugging');
    }

    /**
     * @throws JWTEncodeFailureException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $scopes = $this->scopeRepository->findActive();
        $scopes = array_map(fn(Scope $scope) => $scope->getScope(), $scopes);
        $roleQuestion = new ChoiceQuestion(
            'Select desired roles',
            array_values(array_unique($scopes))
        );
        $roleQuestion->setMultiselect(true);
        $token = $this->encoder->encode(
            [
                'sub'    => $io->ask('username'),
                'scopes' => $this->getHelper('question')->ask($input, $output, $roleQuestion),
            ]
        );
        $io->success('Token generated successfully');
        $io->writeln($token);

        return 0;
    }
}
