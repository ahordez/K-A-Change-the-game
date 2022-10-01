<?php
namespace POSD\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use POSD\Service\LoopService;
use Psr\Log\LoggerInterface;

class ShowLoopCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'show:loop';
    private $loopService;
    private $logger;


    public function __construct(LoopService $loopService, LoggerInterface $logger)
    {
        $this->loopService = $loopService;
        $this->logger = $logger;
        parent::__construct();
    }

    protected function configure(): void
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try
        {
            $this->loopService->loop();
            return 0;
        }
        catch (\Throwable $exc)
        {
            $this->logger->critical("Loop daemon failed :".$exc->getMessage()." (code:".$exc->getCode().") - ".$exc->getFile()." ".$exc->getLine());
            return 1;
        }
    }
}
