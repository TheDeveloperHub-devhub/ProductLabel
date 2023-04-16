<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Api;

use DeveloperHub\ProductLabel\Api\Data\StaticRibbonsAttachmentInterface;

interface StaticRibbonsAttachmentRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param StaticRibbonsAttachmentInterface $staticRibbonsAttachement
     * @return mixed
     */
    public function save(StaticRibbonsAttachmentInterface $staticRibbonsAttachement);

    /**
     * @param StaticRibbonsAttachmentInterface $staticRibbonsAttachement
     * @return mixed
     */
    public function delete(StaticRibbonsAttachmentInterface $staticRibbonsAttachement);
}
