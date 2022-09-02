<?php declare(strict_types=1);

namespace Test\CustomerImportRegistration\Console;

use Test\CustomerImportRegistration\Model\Filetype;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Import extends Command
{
    /**
     * @var Filetype
     */
    private Filetype $filetype;

    /**
     * @param Filetype $filetype
     */
    public function __construct(
        Filetype $filetype
    )
    {
        $this->filetype = $filetype;
        parent::__construct();
    }

    /**
     * @return void
     */
    public function configure()
    {
        $this->setName('customer:bulkcreate')
            ->addArgument('fileType')
            ->addArgument('fileName');
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $fileType = $input->getArgument('fileType');
            $fileName = $input->getArgument('fileName');

            if ($fileType != null && $fileName != null) {
                $this->filetype->setImporter($fileType, $fileName);
            } else {
                $output->writeln('Command is with wrong syntax');
            }
            return Cli::RETURN_SUCCESS;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return Cli::RETURN_FAILURE;
        }
    }
}
