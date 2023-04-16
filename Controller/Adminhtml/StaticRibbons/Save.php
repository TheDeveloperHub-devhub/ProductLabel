<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Controller\Adminhtml\StaticRibbons;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment\StaticRibbonsAttachmentFactory;
use DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment\StaticRibbonsAttachmentRepository;

class Save extends Action
{
    /** @var StaticRibbonsAttachmentRepository  */
    private $staticRibbonsAttachementRepository;

    /** @var StaticRibbonsAttachmentFactory  */
    private $ribbonsAttachmentFactory;

    /**
     * @param Context $context
     * @param StaticRibbonsAttachmentFactory $ribbonsAttachmentFactory
     * @param StaticRibbonsAttachmentRepository $staticRibbonsAttachementRepository
     */
    public function __construct(
        Context                           $context,
        StaticRibbonsAttachmentFactory    $ribbonsAttachmentFactory,
        StaticRibbonsAttachmentRepository $staticRibbonsAttachementRepository
    ) {
        parent::__construct($context);
        $this->ribbonsAttachmentFactory = $ribbonsAttachmentFactory;
        $this->staticRibbonsAttachementRepository = $staticRibbonsAttachementRepository;
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     * @throws AlreadyExistsException
     */
    public function execute()
    {
        $postValues = $this->getRequest()->getPostValue();
        $ribbons_data = $this->ribbonsAttachmentFactory->create();
        !isset($postValues['category_ids']) ?: $postValues['category_ids'] = implode(',', $postValues['category_ids']);
        !isset($postValues['ribbon_ids']) ?: $postValues['ribbon_ids'] = implode(',', $postValues['ribbon_ids']);
        !isset($postValues['product_ids']) ?: $postValues['product_ids'] = implode(',', array_column($postValues['product_ids'], 'entity_id'));
        $ribbons_data->addData($postValues);
        if ($ribbons_data->getID() == null) {
            $this->messageManager->addSuccessMessage(__('Static Ribbon Attachement Added'));
        } else {
            $this->messageManager->addSuccessMessage(__('Static Ribbon Attachement Edited !'));
        }
        $this->staticRibbonsAttachementRepository->save($ribbons_data);
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}
