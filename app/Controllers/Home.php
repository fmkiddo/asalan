<?php
namespace App\Controllers;

class Home extends BaseController {
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseController::index()
     */
    public function index(): string {
        if (!$this->__isReady ()) $this->response->redirect ($this->__getSiteURL ('osam/setup'));
        elseif (!$this->__isSessionSet ()) $this->response->redirect ($this->__getBaseURL ('welcome'));
        $render = '';
        return $render;
    }
    
}
