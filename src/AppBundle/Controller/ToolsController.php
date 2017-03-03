<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tools")
 */
class ToolsController extends Controller
{

	/**
	 * @Route("/clearcache", name="tools_clear_cache")
	 */
	public function clearCacheAction()
	{
		$fs = new Filesystem();
		$fs->remove($this->getParameter('kernel.cache_dir'));
		$this->addFlash('success', 'message.cc');
		return $this->render(':admin/tools:clear_cache.html.twig');
	}


	/**
	 * @Route("/checkdatabase", name="tools_checkdatabase")
	 */
	public function checkDatabaseAction()
	{
		$commande = [
			'command' => 'd:s:v',
		];
		$content = $this->createCommande($commande);
		$this->addFlash('success', $content);
		return $this->render(':admin/tools:checkdatabase.html.twig');

	}


	/**
	 * @param $commande
	 * @return mixed
	 */
	private function createCommande($commande)
	{
		$kernel = $this->get('kernel');
		$application = new Application($kernel);
		$application->setAutoExit(false);
		$input = new ArrayInput($commande);
		$output = new BufferedOutput();
		$application->run($input, $output);
		return $output->fetch();
	}
}