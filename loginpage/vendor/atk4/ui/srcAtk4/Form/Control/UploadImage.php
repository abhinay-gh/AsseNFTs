<?php

declare(strict_types=1);

namespace Atk4\Ui\Form\Control;

use atk4\ui\View;

class UploadImage extends Upload
{
    /**
     * The thumbnail view to add to this input.
     *
     * @var View|null
     */
    public $thumbnail;

    /**
     * The template region where to add the thumbnail view.
     * Default to AfterAfterInput.
     *
     * @var string
     */
    public $thumnailRegion = 'AfterAfterInput';

    /**
     * The default thumbnail source.
     *
     * @var string
     */
    public $defaultSrc;

    protected function init(): void
    {
        parent::init();

        if (!$this->accept) {
            $this->accept = ['.jpg', '.jpeg', '.png'];
        }

        if (!$this->thumbnail) {
            $this->thumbnail = (new View(['element' => 'img', 'class' => ['right', 'floated', 'image'], 'ui' => true]))
                ->setAttr(['width' => '36px', 'height' => '36px']);
        }

        if ($this->defaultSrc) {
            $this->thumbnail->setAttr(['src' => $this->defaultSrc]);
        }

        $this->add($this->thumbnail, $this->thumnailRegion);
    }

    /**
     * Set the thumbnail img src value.
     *
     * @param string $src
     */
    public function setThumbnailSrc($src)
    {
        $this->thumbnail->setAttr(['src' => $src]);
        $action = $this->thumbnail->js();
        $action->attr('src', $src);
        $this->addJsAction($action);
    }

    /**
     * Clear the thumbnail src.
     * You can also supply a default thumbnail src.
     */
    public function clearThumbnail($defaultThumbnail = null)
    {
        $action = $this->thumbnail->js();
        if (isset($defaultThumbnail)) {
            $action->attr('src', $defaultThumbnail);
        } else {
            $action->removeAttr('src');
        }
        $this->addJsAction($action);
    }
}
