<?php

declare(strict_types=1);

namespace Atk4\Ui\Table\Column;

use atk4\ui\Table;

/**
 * Formatting action buttons column.
 */
class Delete extends Table\Column
{
    protected function init(): void
    {
        parent::init();

        $this->vp = $this->table->add(new \atk4\ui\CallbackLater());
        $this->vp->set(function () {
            $this->table->model->load($_POST[$this->name])->delete();

            $reload = $this->table->reload ?: $this->table;

            $this->table->app->terminateJson($reload);
        });
    }

    public function getDataCellTemplate(\atk4\data\Field $field = null)
    {
        $this->table->on('click', 'a.' . $this->short_name, null, ['confirm' => (new \atk4\ui\Jquery())->attr('title')])->atkAjaxec([
            'uri' => $this->vp->getJsUrl(),
            'uri_options' => [$this->name => $this->table->jsRow()->data('id')],
        ]);

        return $this->app->getTag(
            'a',
            ['href' => '#', 'title' => 'Delete {$' . $this->table->model->title_field . '}?', 'class' => $this->short_name],
            [
                ['i', ['class' => 'ui red trash icon'], ''],
                'Delete',
            ]
        );
    }
}
