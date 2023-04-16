<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Controller\Adminhtml\StaticRibbons;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment\StaticRibbonsAttachmentFactory;

class InlineEdit extends Action
{
    /** @var JsonFactory */
    private $jsonFactory;

    /** @var StaticRibbonsAttachmentFactory */
    private $staticRibbonsAttachmentFactory;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param StaticRibbonsAttachmentFactory $staticRibbonsAttachmentFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        StaticRibbonsAttachmentFactory $staticRibbonsAttachmentFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->staticRibbonsAttachmentFactory = $staticRibbonsAttachmentFactory;
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (empty($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $entityId) {
                    $modelData = $this->staticRibbonsAttachmentFactory->create()->load($entityId);
                    try {
                        $modelData->setData(array_merge($modelData->getData(), $postItems[$entityId]));
                        $modelData->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
