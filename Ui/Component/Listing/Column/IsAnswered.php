<?php

declare(strict_types=1);

namespace Bright\ProductQA\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class IsAnswered extends Column
{
    /**
     * Column name
     */
    public const NAME = 'column.is_answered';

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['is_answered'] = $item['answer'] !== null ? 'Is Answered' : 'Not Answered';
            }
        }

        return $dataSource;
    }
}
