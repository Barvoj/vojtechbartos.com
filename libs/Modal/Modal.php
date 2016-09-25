<?php

namespace Libs\Modal;

use Nette\Application\UI\Control;
use Nette\Application\UI\Link;
use Nette\Application\UI\Presenter;
use Nette\InvalidArgumentException;
use Nette\Utils\Callback;

class Modal extends Control
{
    /** @var bool */
    protected $show = false;

    /** @var string */
    protected $title = "";

    /** @var bool */
    protected $largeModal = false;

    /** @var Link */
    protected $linkClose;

    /** @var callable */
    protected $factory;

    /**
     * @param callable $factory
     */
    public function __construct($factory)
    {
        parent::__construct();
        $this->factory = Callback::check($factory);
    }

    /**
     * @return Modal
     */
    public function hide()
    {
        $this->show = false;

        return $this;
    }

    /**
     * @param string $title
     * @return Modal
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Modal
     */
    public function useLargeModal()
    {
        $this->largeModal = true;

        return $this;
    }

    /**
     * @param Link $linkClose
     * @return Modal
     */
    public function setLinkClose(Link $linkClose)
    {
        $this->linkClose = $linkClose;

        return $this;
    }

    /**
     * @param $obj
     */
    protected function attached($obj)
    {
        parent::attached($obj);
        if (!$obj instanceof Presenter) {
            return;
        }
        $this->show = $this->isSignalReceiver();
    }

    public function handleShow()
    {
        $this->show = true;
    }

    /**
     * Renders component template
     */
    public function render()
    {
        $this->template->setFile(__DIR__ . DIRECTORY_SEPARATOR . 'Modal.latte');

        $this->template->show = $this->show;
        $this->template->title = $this->title;
        $this->template->modalLarge = $this->largeModal;
        $this->template->linkClose = $this->linkClose ?? "#";

        $this->template->render();
    }

    /**
     * @return Control
     */
    protected function createComponentComponent()
    {
        $component = call_user_func($this->factory, $this);

        if (isset($component->onSuccess)) {
            $component->onSuccess[] = function () {
                $this->hide();
            };
        }

        return $component;
    }

    /**
     * @return bool
     */
    public function isSignalReceiver()
    {
        if ($this->presenter->isSignalReceiver($this)) {
            return true;
        }

        $signal = $this->presenter->getSignal();
        $component = null;

        try {
            if ($signal) {
                $component = $signal[0] === '' ? $this->getPresenter() : $this->getPresenter()->getComponent($signal[0], false);
            }
        } catch (InvalidArgumentException $e) {
            // Do nothing
        }

        $result = false;
        if (isset($component)) {
            /** @var Control $component */
            while ($component = $component->getParent()) {
                if ($component === $this) {
                    $result = true;
                    break;
                }
            }
        }

        return $result;
    }
}