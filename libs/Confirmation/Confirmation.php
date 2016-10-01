<?php

namespace Libs\Confirmation;

use Nette\Application\UI\Control;

/**
 * @method onConfirmed
 * @method onCanceled
 */
class Confirmation extends Control
{
    /** @var array */
    public $onConfirmed = [];

    /** @var array */
    public $onCanceled = [];

    protected $message = "messages.confirm.are_you_sure";

    /**
     * @param string $message
     * @return Confirmation
     */
    public function setMessage(string $message) : Confirmation
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Renders component template
     */
    public function render()
    {
        $this->template->setFile(__DIR__ . DIRECTORY_SEPARATOR . 'Confirmation.latte');

        $this->template->message = $this->message;
        $this->template->render();
    }

    public function handleConfirm()
    {
        $this->onConfirmed();
    }

    public function handleCancel()
    {
        $this->onCanceled();
    }
}