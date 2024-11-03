<?php

declare(strict_types=1);

namespace Bright\ProductQA\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class ApprovalStatus extends Column
{
    /**
     * Column name
     */
    public const NAME = 'column.approval_status';

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
                $item['is_approved'] = $item['is_approved'] ? __('Is Approved') : __('Not Approved');
            }
        }

        return $dataSource;
    }
}
