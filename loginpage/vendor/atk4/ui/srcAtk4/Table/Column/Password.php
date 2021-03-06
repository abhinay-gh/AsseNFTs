<?php

declare(strict_types=1);

namespace Atk4\Ui\Table\Column;

use atk4\ui\Table;

/**
 * Implements Column helper for grid.
 */
class Password extends Table\Column
{
    public $sortable = false;

    public function getDataCellTemplate(\atk4\data\Field $field = null)
    {
        return '***';
    }
}
