<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Controller\Adminhtml\StaticRibbons;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use DeveloperHub\ProductLabel\Model\ResourceModel\StaticRibbonsAttachment\CollectionFactory;
use DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment\StaticRibbonsAttachment;
use DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment\StaticRibbonsAttachmentRepository;

class MassDelete extends Action
{
    /** @var Filter */
    private $filter;

    /** @var CollectionFactory */
    private $collectionFactory;

    /** @var StaticRibbonsAttachmentRepository  */
    private $staticRibbonsAttachmentRepository;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param StaticRibbonsAttachmentRepository $staticRibbonsAttachmentRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        StaticRibbonsAttachmentRepository $staticRibbonsAttachmentRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->staticRibbonsAttachmentRepository = $staticRibbonsAttachmentRepository;
    }

    /**
     * Execute action
     *
     * @return Redirect
     * @throws LocalizedException|Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        /** @var StaticRibbonsAttachment $staticRibbons */
        $staticRibbonsDeleted = 0;
        foreach ($collection->getItems() as $staticRibbons) {
            $this->staticRibbonsAttachmentRepository->delete($staticRibbons);
            $staticRibbonsDeleted++;
        }
        if ($staticRibbonsDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $staticRibbonsDeleted)
            );
        }
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}
