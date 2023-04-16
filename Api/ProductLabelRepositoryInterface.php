<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Api;

use DeveloperHub\ProductLabel\Api\Data\ProductLabelInterface;

interface ProductLabelRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param ProductLabelInterface $productLabel
     * @return mixed
     */
    public function save(ProductLabelInterface $productLabel);

    /**
     * @param ProductLabelInterface $productLabel
     * @return mixed
     */
    public function delete(ProductLabelInterface $productLabel);
}
