<?php declare(strict_types=1);

namespace Test\CustomerImportRegistration\Model\Manager;

use Exception;
use Test\CustomerImportRegistration\Model\Customer\Importer;
use Magento\Framework\Exception\LocalizedException;

class JsonManager
{
    /**
     * @var Importer
     */
    private Importer $customerImporter;

    /**
     * @param Importer $customerImporter
     */
    public function __construct(
        Importer $customerImporter
    ) {
        $this->customerImporter = $customerImporter;
    }

    /**
     * @param $fileName
     * @throws LocalizedException|Exception
     */
    public function readDataFromFile($fileName)
    {
        $fileContent = file_get_contents($fileName);
        $customersData = json_decode($fileContent,true);
        foreach ($customersData as $customerData) {
            $this->customerImporter->createCustomer($customerData);
        }
    }
}
