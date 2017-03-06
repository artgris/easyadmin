<?php

namespace AppBundle\EventListener;

use JavierEguiluz\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\DataCollectorTranslator;

class EasyAdminSubscriber implements EventSubscriberInterface
{
	/**
	 * @var Session
	 */
	private $session;


	/**
	 * EasyAdminSubscriber constructor.
	 * @param Session $session
	 */
	public function __construct(Session $session)
	{
		$this->session = $session;
	}

	public static function getSubscribedEvents()
	{
		return array(
			EasyAdminEvents::POST_PERSIST => array('addPersistFlashMessage'),
			EasyAdminEvents::POST_UPDATE => array('addUpdateFlashMessage'),
			EasyAdminEvents::POST_DELETE => array('addDeleteFlashMessage'),
		);
	}

	public function addPersistFlashMessage(GenericEvent $event)
	{
		$this->addFlashBag('success.persist.message');
	}

	public function addUpdateFlashMessage(GenericEvent $event)
	{
		$this->addFlashBag('success.update.message');
	}

	public function addDeleteFlashMessage(GenericEvent $event)
	{
		$this->addFlashBag('success.delete.message');
	}

	private function addFlashBag($message)
	{
		return $this->session->getFlashBag()->add('success', $message);
	}
}