<?php declare(strict_types=1);

namespace Test\CustomerImportRegistration\Model;

use Exception;
use Test\CustomerImportRegistration\Model\Manager\CsvManager;
use Test\CustomerImportRegistration\Model\Manager\JsonManager;
use Magento\Framework\Exception\LocalizedException;

class Filetype
{
    const FILE_TYPE_CSV = 'csv';
    const FILE_TYPE_JSON = 'json';

    /**
     * @var CsvManager
     */
    private CsvManager $csvManager;

    /**
     * @var JsonManager
     */
    private JsonManager $jsonManager;

    /**
     * @param CsvManager $csvManager
     * @param JsonManager $jsonManager
     */
    public function __construct(
        CsvManager $csvManager,
        JsonManager $jsonManager
    ) {
        $this->csvManager = $csvManager;
        $this->jsonManager = $jsonManager;
    }

    /**
     * @param $fileType
     * @param $fileName
     * @throws Exception
     */
    public function setImporter($fileType, $fileName)
    {
        if ($fileType == self::FILE_TYPE_CSV) {
            $this->csvManager->readDataFromFile($fileName);
        } else if ($fileType == self::FILE_TYPE_JSON) {
            $this->jsonManager->readDataFromFile($fileName);
        }
    }
}
