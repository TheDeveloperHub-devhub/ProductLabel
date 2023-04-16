<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use DeveloperHub\ProductLabel\Model\ProductLabelModelFactory;

class Edit extends Action
{
    /** @var ProductLabelModelFactory  */
    private $productLabelModelFactory;

    /**
     * @param Context $context
     * @param ProductLabelModelFactory $productLabelModelFactory
     */
    public function __construct(
        Context $context,
        ProductLabelModelFactory $productLabelModelFactory
    ) {
        parent::__construct($context);
        $this->productLabelModelFactory = $productLabelModelFactory;
    }

    public function execute()
    {
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = $this->productLabelModelFactory->create();
        /** @var Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getId()) {
                $this->messageManager->addErrorMessage(__('row data no longer exist.'));
                return $this->_redirect('*/*/save');
            }
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Product Label') . $rowTitle : __('Add New Product Label');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
