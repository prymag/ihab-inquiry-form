<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Prymag\PurchaseForm\Model\Config\Source;

use Magento\Cms\Model\ResourceModel\Block\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Block
 */
class Block implements OptionSourceInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param \Magento\Cms\Model\ResourceModel\Block\CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        if (!$this->options) {
            $this->options = $this->toOptionIdArray($this->collectionFactory->create());
        }

        return $this->options;
    }

    /**
     * Returns pairs identifier - title for unique identifiers
     * and pairs identifier|entity_id - title for non-unique after first
     * 
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection $collection
     * @return array
     */
    public function toOptionIdArray($collection)
    {
        $res = [
            [
                'value' => '',
                'label' => 'N/A'
            ]
        ];
        $existingIdentifiers = [];
        
        foreach ($collection as $item) {
            $identifier = $item->getData('identifier');

            $data['value'] = $identifier;
            $data['label'] = $item->getData('title') . " ({$identifier})";

            if (in_array($identifier, $existingIdentifiers)) {
                $data['value'] .= '|' . $item->getData($collection->getIdFieldName());
            } else {
                $existingIdentifiers[] = $identifier;
            }

            $res[] = $data;
        }

        return $res;
    }
}
