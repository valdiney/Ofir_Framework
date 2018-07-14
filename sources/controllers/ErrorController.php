<?php

class HomeController extends BaseController
{
	public function controllerNotFound() {
		$message = 'controller not found';
		return $this->view->make('errors.404-page-not-found', compact('title'));
	}

	public function methodNotFound() {
		$message = 'method not found';
		return $this->view->make('errors.404-page-not-found', compact('title'));
	}

	public function viewNotFound() {
		$message = 'view not found';
		return $this->view->make('errors.404-page-not-found', compact('title'));
	}
}
