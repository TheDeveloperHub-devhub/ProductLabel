<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Controller\Adminhtml\StaticRibbons;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment\StaticRibbonsAttachmentRepository;

class Edit extends Action
{
    /** @var StaticRibbonsAttachmentRepository  */
    private $staticRibbonsAttachmentRepository;

    /**
     * @param Context $context
     * @param StaticRibbonsAttachmentRepository $staticRibbonsAttachmentRepository
     */
    public function __construct(
        Context $context,
        StaticRibbonsAttachmentRepository $staticRibbonsAttachmentRepository
    ) {
        parent::__construct($context);
        $this->staticRibbonsAttachmentRepository = $staticRibbonsAttachmentRepository;
    }

    /**
     * @return Page|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        if ($rowId = (int) $this->getRequest()->getParam('id')) {
            try {
                $this->staticRibbonsAttachmentRepository->getById($rowId);
                $resultPage->getConfig()->getTitle()->prepend(__('Edit Static Ribbon Attachment'));
            } catch (NoSuchEntityException $exception) {
                $this->messageManager->addErrorMessage(__('This attachment no longer exists.'));
                return $this->_redirect('*/*/index');
            }
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add New Static Ribbon Attachment'));
        }

        return $resultPage;
    }
}
