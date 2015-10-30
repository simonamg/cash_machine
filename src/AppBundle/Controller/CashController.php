<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CashController extends Controller {

	public function indexAction(Request $request) {
		return $this->render('machine/index.html.twig', array(
			    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
		));
	}

	public function withdrawAction(Request $request) {
		
		$cash_values = array(100 => 0, 50 => 0, 20 => 0, 10 => 0);
		$amount = $request->get('amount');
		$total = array();
		if ($amount != '' && fmod($amount, 10) == 0 && $amount > 0) {
			foreach ($cash_values as $key => $value) {
				while ($amount >= $key) {
					$amount = $amount - $key;
					$value ++;
				}
				$total[$key] = $value ++;
			}

			return $this->render('machine/result.html.twig', array('cash' => $total,
			));
		} else {
			$error = 'Please verify that the amount entered is multiple of 10';
			return $this->render('machine/index.html.twig', array('error' => $error,
			));
		}
	}

}
