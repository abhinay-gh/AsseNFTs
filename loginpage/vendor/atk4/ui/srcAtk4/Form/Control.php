<?php

declare(strict_types=1);

namespace Atk4\Ui\Form;

use atk4\ui\Exception;
use atk4\ui\Form;
use atk4\ui\View;

/**
 * Provides generic functionality for a form control.
 */
class Control extends View
{
    /**
     * @var Form - to which this field belongs
     */
    public $form;

    /**
     * @var \atk4\data\Field - points to model field
     */
    public $field;

    /** @deprecated use controlClass instead - will be removed in dec-2020 */
    public $fieldClass = '';

    /** @var string control class */
    public $controlClass = '';

    /**
     * @var bool - Whether you need this field to be rendered wrap in a form layout or as his
     */
    public $layoutWrap = true;

    /** @var bool rendered or not input label in generic Form\Layout template. */
    public $renderLabel = true;

    public $width;

    /**
     * Caption is a text that must appear somewhere nearby the field. For a form with layout, this
     * will typically place caption above the input field, but for checkbox this may appear next to the
     * checkbox itself. If Form Layout does not have captions above the input field, then caption
     * will appear as a placeholder of the input fields and it may also appear as a tooltip.
     *
     * Caption is usually specified by a model.
     *
     * @var string
     */
    public $caption;

    /**
     * Placed as a pointing label below the field. This only works when Form\Control appears in a form. You can also
     * set this to object, such as \atk4\ui\Text otherwise HTML characters are escaped.
     *
     * @var string|\atk4\ui\View|array
     */
    public $hint;

    /**
     * Is input field disabled?
     * Disabled input fields are not editable and will not be submitted.
     *
     * @var bool
     */
    public $disabled = false;

    /**
     * Is input field read only?
     * Read only input fields are not editable, but will be submitted.
     *
     * @var bool
     */
    public $readonly = false;

    /**
     * Initialization.
     */
    protected function init(): void
    {
        parent::init();

        if ($this->form && $this->field) {
            if (isset($this->form->controls[$this->field->short_name])) {
                throw (new Exception('Form already has a field with the same name'))
                    ->addMoreInfo('name', $this->field->short_name);
            }
            $this->form->controls[$this->field->short_name] = $this;
        }
    }

    /**
     * Sets the value of this field. If field is a part of the form and is associated with
     * the model, then the model's value will also be affected.
     *
     * @param mixed $value
     * @param mixed $junk
     *
     * @return $this
     */
    public function set($value = null, $junk = null)
    {
        if ($this->field) {
            $value = $this->app->ui_persistence->typecastLoadField($this->field, $value);
            $this->field->set($value);

            return $this;
        }

        $this->content = $value;

        return $this;
    }

    /**
     * It only makes sense to have "name" property inside a field if
     * it was used inside a form.
     */
    protected function renderView(): void
    {
        if ($this->form) {
            $this->template->trySet('name', $this->short_name);
        }

        parent::renderView();
    }

    protected function renderTemplateToHtml(string $region = null): string
    {
        $output = parent::renderTemplateToHtml($region);

        /** @var Form|null $form */
        $form = $this->getClosestOwner($this, Form::class);

        return $form !== null ? $form->fixFormInRenderedHtml($output) : $output;
    }

    /**
     * Shorthand method for on('change') event.
     * Some input fields, like Calendar, could call this differently.
     *
     * If $expr is string or JsExpression, then it will execute it instantly.
     * If $expr is callback method, then it'll make additional request to webserver.
     *
     * Could be preferable to set useDefault to false. For example when
     * needing to clear form error or when form canLeave property is false.
     * Otherwise, change handler will not be propagate to all handlers.
     *
     * Examples:
     * $control->onChange('console.log("changed")');
     * $control->onChange(new \atk4\ui\JsExpression('console.log("changed")'));
     * $control->onChange('$(this).parents(".form").form("submit")');
     *
     * @param string|\atk4\ui\JsExpression|array|\Closure $expr
     * @param array|bool                                  $default
     */
    public function onChange($expr, $default = [])
    {
        if (is_string($expr)) {
            $expr = new \atk4\ui\JsExpression($expr);
        }

        if (is_bool($default)) {
            $default['preventDefault'] = $default;
            $default['stopPropagation'] = $default;
        }

        $this->on('change', '#' . $this->id . '_input', $expr, $default);
    }

    /**
     * Method similar to View::js() however will adjust selector
     * to target the "input" element.
     *
     * $field->jsInput(true)->val(123);
     *
     * @return \atk4\ui\Jquery
     */
    public function jsInput($when = null, $action = null)
    {
        return $this->js($when, $action, '#' . $this->id . '_input');
    }

    /**
     * @deprecated use Control::getControlClass instead - will be removed in dec-2020
     */
    public function getFieldClass()
    {
        'trigger_error'('Method is deprecated. Use Control::getControlClass instead', E_USER_DEPRECATED);

        return $this->getControlClass();
    }

    /**
     * Return control class.
     *
     * @return string
     */
    public function getControlClass()
    {
        // use of fieldClass for backward compatibility - will be removed in dec-2020
        return $this->controlClass ?: $this->fieldClass;
    }
}
