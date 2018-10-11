<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
		$a = $this->di->get('queue');
		$queue = $a->getQueue();
		$queue->push([1,2,3]);
		$b = $queue->pop();
		dd($b);
    }

}

