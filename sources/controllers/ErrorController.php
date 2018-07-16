<?php

class ErrorController extends BaseController
{
    public function controllerNotFound() {
        $title   = 'Page not found.';
        $message = 'controller not found';
        return $this->view('errors.404-page-not-found', compact('title', 'message'));
    }

    public function methodNotFound() {
        $title   = 'Page not found.';
        $message = 'method not found';
        return $this->view('errors.404-page-not-found', compact('title', 'message'));
    }

    public function viewNotFound() {
        $title   = 'Page not found.';
        $message = 'view not found';
        return $this->view('errors.404-page-not-found', compact('title', 'message'));
    }
}
