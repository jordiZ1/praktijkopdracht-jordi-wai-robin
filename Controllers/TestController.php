<?php

class TestController extends Controller {
    public function renderView()
    {
        $this->render('Test');
    }

    public function test() 
    {
        echo 'test controller <br>';
        $this->model->test();
    }
}