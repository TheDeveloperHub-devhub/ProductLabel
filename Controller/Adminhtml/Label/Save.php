<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Controller\Adminhtml\Label;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use DeveloperHub\ProductLabel\Model\ProductLabelModelFactory;
use DeveloperHub\ProductLabel\Model\ProductLabelRepository;

class Save extends Action
{
    /** @var ProductLabelRepository  */
    private $productLabelRepository;

    /** @var ProductLabelModelFactory  */
    private $productLabelModelFactory;

    /**
     * @param Context $context
     * @param ProductLabelModelFactory $productLabelModelFactory
     * @param ProductLabelRepository $productLabelRepository
     */
    public function __construct(
        Context $context,
        ProductLabelModelFactory $productLabelModelFactory,
        ProductLabelRepository $productLabelRepository
    ) {
        parent::__construct($context);
        $this->productLabelModelFactory = $productLabelModelFactory;
        $this->productLabelRepository = $productLabelRepository;
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     * @throws AlreadyExistsException
     */
    public function execute()
    {
        $postValues = $this->getRequest()->getPostValue();
        $student_data = $this->productLabelModelFactory->create();
        $student_data->addData($postValues);
        if ($student_data->getID() == null) {
            $this->messageManager->addSuccessMessage(__('Product Label Added'));
        } else {
            $this->messageManager->addSuccessMessage(__('Product Label Edited !'));
        }

        $this->productLabelRepository->save($student_data);
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}
