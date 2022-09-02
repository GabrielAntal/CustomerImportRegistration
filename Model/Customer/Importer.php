<?php declare(strict_types=1);

namespace Test\CustomerImportRegistration\Model\Customer;

use Exception;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;

class Importer
{
    const CUSTOMER_FIRSTNAME = 'fname';
    const CUSTOMER_LASTNAME = 'lname';
    const CUSTOMER_EMAIL = 'emailaddress';

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CustomerInterfaceFactory
     */
    private $customerFactory;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @param CustomerInterfaceFactory $customerFactory
     * @param StoreManagerInterface $storeManager
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CustomerInterfaceFactory $customerFactory,
        StoreManagerInterface $storeManager,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerFactory = $customerFactory;
        $this->storeManager = $storeManager;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param $customerData
     * @throws Exception
     */
    public function createCustomer($customerData)
    {
        try {
            $store = $this->storeManager->getStore();
            $websiteId = $this->storeManager->getStore()->getWebsiteId();
            $customer  = $this->customerFactory->create();

            $customer->setWebsiteId($websiteId)
                ->setStoreId($store->getId())
                ->setFirstname($customerData[self::CUSTOMER_FIRSTNAME])
                ->setLastname($customerData[self::CUSTOMER_LASTNAME])
                ->setEmail($customerData[self::CUSTOMER_EMAIL]);

            $this->customerRepository->save($customer);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
