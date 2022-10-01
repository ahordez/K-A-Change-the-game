<?php
namespace POSD\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use POSD\Service\ConfigurationService;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use POSD\Entity\Message;

class MessageController extends AbstractController
{
    private $logger;
    private $configService;
    private $em;


    public function __construct(ConfigurationService $configService, LoggerInterface $logger,EntityManagerInterface $em)
    {
        $this->configService = $configService;
        $this->logger = $logger;
        $this->em     = $em;
    }


    /**
    *
    * @Route("/messages", methods={"GET"}, name="messages")
    **/
    public function MessagesAction(Request $request)
    {
        $messages = $this->em->getRepository(Message::class)->findBy(array(), ['timestamp' => 'ASC']);

        return $this->render('message/messages.html.twig', [
            'messages' => $messages
        ]);
    }




}
