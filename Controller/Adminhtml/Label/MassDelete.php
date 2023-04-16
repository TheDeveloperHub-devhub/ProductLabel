<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use DeveloperHub\ProductLabel\Model\ProductLabelModel;
use DeveloperHub\ProductLabel\Model\ProductLabelRepository;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel\CollectionFactory;

class MassDelete extends Action
{
    /** @var Filter */
    private $filter;

    /** @var CollectionFactory */
    private $collectionFactory;

    /** @var ProductLabelRepository */
    private $productLabelRepository;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param ProductLabelRepository $productLabelRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ProductLabelRepository $productLabelRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->productLabelRepository = $productLabelRepository;
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws CouldNotDeleteException
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        /** @var ProductLabelModel $label */
        $labelDeleted = 0;
        foreach ($collection->getItems() as $label) {
            $this->productLabelRepository->delete($label);
            $labelDeleted++;
        }
        if ($labelDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $labelDeleted)
            );
        }

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}
