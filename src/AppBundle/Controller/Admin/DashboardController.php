<?php

namespace AppBundle\Controller\Admin;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Google_Client;
use Google_Service_Analytics;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin/")
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class DashboardController extends Controller
{
	/**
	 * @Route("dashboard/", name="admin_dashboard")
	 */
	public function indexAction()
	{
		$access_token = $this->getService();

		return $this->render(':admin/dashboard:index.html.twig', [
			'ACCESS_TOKEN_FROM_SERVICE_ACCOUNT' => $access_token['access_token']
		]);
	}

	private function getService()
	{
		$key_file_location = $this->getParameter('kernel.root_dir') . '/../src/AppBundle/Keyfile/test-4adb54f2f38d.json';
		$serviceAccount = new ServiceAccountCredentials(Google_Service_Analytics::ANALYTICS_READONLY, $key_file_location);
		$serviceAccount->fetchAuthToken();
		return $serviceAccount->getLastReceivedToken();
	}

}