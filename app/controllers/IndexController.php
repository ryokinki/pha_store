<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
		echo json_encode(['hello_world']);
		die;
		/*
		$a = $this->di->get('queue');
		$queue = $a->getQueue();
		$queue->push(['action' => 'OrderJob@createOrder', 1,2,3, 'tube' => 'order_create_queue']);
		*/
		//$b = $queue->pop();
		//dd($b);
    }

}

