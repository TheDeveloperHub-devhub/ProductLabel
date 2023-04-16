<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Controller\Adminhtml\Label;

use Exception;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel\Collection;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel\CollectionFactory;
use Psr\Log\LoggerInterface;

class Delete extends Action
{
    /** @var LoggerInterface */
    private $logger;

    /** @var CollectionFactory */
    private $collectionFactory;

    /**
     * @param Action\Context $context
     * @param LoggerInterface $logger
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Action\Context $context,
        LoggerInterface $logger,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
    }

    /** @return ResponseInterface|ResultInterface|void */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        try {
            /** @var $collection Collection */
            $collection = $this->collectionFactory->create();
            $collection->addFieldToFilter('id', ['eq' => $id]);
            $collection->walk('delete');
            $this->messageManager->addSuccessMessage(__('Label deleted successfully'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(
                __('We can\'t delete Label right now. Please review the log and try again. ') . $e->getMessage()
            );
            $this->logger->critical($e);
        }
        $this->_redirect('*/label/index');
    }
}
