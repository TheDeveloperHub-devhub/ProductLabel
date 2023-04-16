<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use DeveloperHub\ProductLabel\Api\Data\StaticRibbonsAttachmentInterface;
use DeveloperHub\ProductLabel\Api\StaticRibbonsAttachmentRepositoryInterface;
use DeveloperHub\ProductLabel\Model\ResourceModel\StaticRibbonsAttachment;

class StaticRibbonsAttachmentRepository implements StaticRibbonsAttachmentRepositoryInterface
{
    /** @var StaticRibbonsAttachment  */
    private $staticRibbonsAttachmentResource;

    /** @var StaticRibbonsAttachmentFactory  */
    private $staticRibbonsAttachmentFactory;

    /**
     * @param StaticRibbonsAttachment $staticRibbonsAttachmentresource
     * @param StaticRibbonsAttachmentFactory $staticRibbonsAttachmentFactory
     */
    public function __construct(
        StaticRibbonsAttachment $staticRibbonsAttachmentresource,
        StaticRibbonsAttachmentFactory $staticRibbonsAttachmentFactory
    ) {
        $this->staticRibbonsAttachmentResource = $staticRibbonsAttachmentresource;
        $this->staticRibbonsAttachmentFactory =$staticRibbonsAttachmentFactory;
    }

    /**
     * @param $id
     * @return mixed|\DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment\StaticRibbonsAttachment
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $staticRibbonsAttachment = $this->staticRibbonsAttachmentFactory->create();
        $this->staticRibbonsAttachmentResource->load($staticRibbonsAttachment, $id);
        if (!$staticRibbonsAttachment->getId()) {
            throw new NoSuchEntityException(__('Unable to find Ribbon Attachement with ID "%1"', $id));
        }
        return $staticRibbonsAttachment;
    }

    /**
     * @param StaticRibbonsAttachmentInterface $staticRibbonsAttachment
     * @return StaticRibbonsAttachmentInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(StaticRibbonsAttachmentInterface $staticRibbonsAttachment)
    {
        $this->staticRibbonsAttachmentResource->save($staticRibbonsAttachment);
        return $staticRibbonsAttachment;
    }

    /**
     * @param StaticRibbonsAttachmentInterface $staticRibbonsAttachment
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(StaticRibbonsAttachmentInterface $staticRibbonsAttachment)
    {
        try {
            $this->staticRibbonsAttachmentResource->delete($staticRibbonsAttachment);
            return true;
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }
    }
}
