<?php

declare(strict_types=1);

namespace Atk4\Ui\Table\Column;

use atk4\core\FactoryTrait;
use atk4\data\Model;
use atk4\ui\Table;

/**
 * Formatting action buttons column.
 */
class ActionButtons extends Table\Column
{
    use FactoryTrait;

    /**
     * Stores all the buttons that have been added.
     *
     * @var array
     */
    public $buttons = [];

    /**
     * Callbacks as defined in $action->enabled for evaluating row-specific if an action is enabled.
     *
     * @var array
     */
    protected $callbacks = [];

    protected function init(): void
    {
        parent::init();
        $this->addClass('right aligned');
    }

    /**
     * Adds a new button which will execute $callback when clicked.
     *
     * Returns button object
     *
     * @param \atk4\ui\View|string           $button
     * @param \Closure|Model\UserAction|null $action
     *
     * @return \atk4\ui\View
     */
    public function addButton($button, $action = null, string $confirmMsg = '', bool $isDisabled = false)
    {
        // If action is not specified, perhaps it is defined in the model
        if (!$action) {
            if (is_string($button)) {
                $action = $this->table->model->getUserAction($button);
            } elseif ($button instanceof Model\UserAction) {
                $action = $button;
            }

            if ($action) {
                $button = $action->caption;
            }
        }

        $name = $this->name . '_button_' . (count($this->buttons) + 1);

        if ($action instanceof Model\UserAction) {
            $button = $action->ui['button'] ?? $button;

            $confirmMsg = $action->ui['confirm'] ?? $confirmMsg;

            $isDisabled = !$action->enabled;

            if ($action->enabled instanceof \Closure) {
                $this->callbacks[$name] = $action->enabled;
            }
        }

        if (!is_object($button)) {
            if (is_string($button)) {
                $button = [1 => $button];
            }

            $button = $this->factory([\atk4\ui\Button::class], $this->mergeSeeds($button, ['id' => false]));
        }

        $button->app = $this->table->app;

        $this->buttons[$name] = $button->addClass('{$_' . $name . '_disabled} compact b_' . $name);

        if ($isDisabled) {
            $button->addClass('disabled');
        }
        $this->table->on('click', '.b_' . $name, $action, [$this->table->jsRow()->data('id'), 'confirm' => $confirmMsg]);

        return $button;
    }

    /**
     * Adds a new button which will open a modal dialog and dynamically
     * load contents through $callback. Will pass a virtual page.
     *
     * @param \atk4\ui\View|string $button
     * @param string|array         $defaults modal title or modal defaults array
     * @param \atk4\ui\View        $owner
     * @param array                $args
     *
     * @return \atk4\ui\View
     */
    public function addModal($button, $defaults, \Closure $callback, $owner = null, $args = [])
    {
        $owner = $owner ?: $this->owner->owner;

        if (is_string($defaults)) {
            $defaults = ['title' => $defaults];
        }

        $defaults['appStickyCb'] = true;

        $modal = \atk4\ui\Modal::addTo($owner, $defaults);

        $modal->observeChanges(); // adds scrollbar if needed

        $modal->set(function ($t) use ($callback) {
            $callback($t, $this->app->stickyGet($this->name));
        });

        return $this->addButton($button, $modal->show(array_merge([$this->name => $this->owner->jsRow()->data('id')], $args)));
    }

    /**
     * {@inheritdoc}
     */
    public function getTag($position, $value, $attr = [])
    {
        if ($this->table->hasCollapsingCssActionColumn && $position === 'body') {
            $attr['class'][] = 'collapsing';
        }

        return parent::getTag($position, $value, $attr);
    }

    public function getDataCellTemplate(\atk4\data\Field $field = null)
    {
        if (!$this->buttons) {
            return '';
        }

        // render our buttons
        $output = '';
        foreach ($this->buttons as $button) {
            $output .= $button->getHtml();
        }

        return '<div class="ui buttons">' . $output . '</div>';
    }

    public function getHtmlTags(Model $row, $field)
    {
        $tags = [];
        foreach ($this->callbacks as $name => $callback) {
            // if action is enabled then do not set disabled class
            if ($callback($row)) {
                continue;
            }

            $tags['_' . $name . '_disabled'] = 'disabled';
        }

        return $tags;
    }

    // rest will be implemented for crud
}
