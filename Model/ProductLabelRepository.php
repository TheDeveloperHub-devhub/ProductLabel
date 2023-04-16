<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use DeveloperHub\ProductLabel\Api\Data\ProductLabelInterface;
use DeveloperHub\ProductLabel\Api\ProductLabelRepositoryInterface;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel;

class ProductLabelRepository implements ProductLabelRepositoryInterface
{
    /** @var ProductLabel  */
    private ProductLabel $productLabelresource;

    /** @var ProductLabelModelFactory */
    private ProductLabelModelFactory $productLabelFactory;

    /**
     * @param ProductLabel $productLabelresource
     * @param ProductLabelModelFactory $productLabelFactory
     */
    public function __construct(
        ProductLabel $productLabelresource,
        ProductLabelModelFactory $productLabelFactory
    ) {
        $this->productLabelresource = $productLabelresource;
        $this->productLabelFactory =$productLabelFactory;
    }

    /**
     * @param $id
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $productlabel = $this->productLabelFactory->create();
        $this->productLabelresource->load($productlabel, $id);
        if (!$productlabel->getId()) {
            throw new NoSuchEntityException(__('Unable to find Student with ID "%1"', $id));
        }
        return $productlabel;
    }

    /**
     * @param ProductLabelInterface $productLabel
     * @return ProductLabelInterface
     * @throws AlreadyExistsException
     */
    public function save(ProductLabelInterface $productLabel)
    {
        $this->productLabelresource->save($productLabel);
        return $productLabel;
    }

    /**
     * @param ProductLabelInterface $productLabel
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(ProductLabelInterface $productLabel)
    {
        try {
            $this->productLabelresource->delete($productLabel);
            return true;
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }
    }
}
