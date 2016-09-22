<?php
namespace Libs\Application\UI;

trait TPresenter
{
    public abstract function flashMessage($message, $type = 'info');

    public abstract function forward($destination, $args = []);

    public abstract function redirect($code, $destination = null, $args = []);

    public abstract function lazyLink($destination, $args = []);

    public abstract function restoreRequest($key);

    public abstract function isAjax();

    public abstract function redrawControl($snippet = NULL, $redraw = TRUE);

    protected abstract function translate(string $message, int $count = NULL, array $parameters = array(), string $domain = NULL, string $locale = NULL) : string;
}