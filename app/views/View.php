<?php

namespace app\views;

class View
{
    public function render($tpl, $pageData) {
        include $tpl;
    }
}