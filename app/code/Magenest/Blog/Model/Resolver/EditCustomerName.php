<?php

declare(strict_types=1);

namespace Magenest\Blog\Model\Resolver;

use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\GraphQl\Model\Query\ContextInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerCollection;
use Magento\Customer\Model\CustomerFactory;

class EditCustomerName implements ResolverInterface
{
    protected $customerModel;
    protected $customerCollection;
    /**
     * @inheritdoc
     */
    public function __construct(
        CustomerFactory $customerModel,
        CustomerCollection $customerCollection
    ) {
        $this->customerModel = $customerModel;
        $this->customerCollection = $customerCollection;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null) {
        try {
            /** @var ContextInterface $context */
            if ($context->getExtensionAttributes()->getIsCustomer() === false) {
                throw new GraphQlAuthorizationException(__('The current customer isn\'t authorized.'));
            }
            $params = $args;
            $customerId = $params['customerId'];
            $first_name = $params['firstName'];
            $last_name = $params['lastName'];
            $collection = $this->customerCollection->create()->addFieldToFilter('entity_id', $customerId);
            if ($collection->getSize() > 0) {
                $model = $this->customerModel->create();
                $model->load($customerId);
                $model->setFirstname($first_name);
                $model->setLastname($last_name);
                $model->save();
                return [
                    'firstName' => $model->getFirstname(),
                    'lastName' => $model->getLastname()
                ];
            } else {
                throw new GraphQlNoSuchEntityException(__('Customer with customer id %1 not found', $customerId));
            }
        } catch (NoSuchEntityException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        } catch (LocalizedException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()));
        }
    }
}
