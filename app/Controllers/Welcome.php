<?php
namespace App\Controllers;


class Welcome extends BaseController {
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseController::index()
     */
    public function index(): string {
        if (!$this->__isReady ()) $this->response->redirect ($this->__getSiteURL ('osam/setup'));
        $this->addViewPaths ('tpl-html')->addViewPaths ('tpl-header')->addViewPaths ('login')->addViewPaths ('tpl-footer');
        $render = '';
        return $render;
    }
    
}