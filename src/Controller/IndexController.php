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

class IndexController extends AbstractController
{
    private $logger;
    private $configService;


    public function __construct(ConfigurationService $configService, LoggerInterface $logger)
    {
        $this->configService = $configService;
        $this->logger = $logger;
    }


    /**
    *
    * @Route("/", methods={"GET"}, name="index")
    **/
    public function IndexAction(Request $request)
    {
        $show_is_going_on = $this->configService->getBoolValue("show_is_going_on");
        $timestamp_show_start = $this->configService->getIntValue("timestamp_show_start");
        $timeline_cursor = $this->configService->getIntValue("timeline_cursor");
        $recipient = $this->configService->getStringValue("recipient");

        return $this->render('index/index.html.twig', [
            'show_is_going_on' => $show_is_going_on,
            'timestamp_show_start' => $timestamp_show_start,
            'timeline_cursor' => $timeline_cursor,
            'recipient' => $recipient
        ]);
    }


    /**
    *
    * @Route("/start_the_show", methods={"POST"}, name="start_the_show")
    **/
    public function StartTheShowAction(Request $request)
    {
        $recipient = $request->get('recipient');
        $timeline_cursor = $request->get('timeline_cursor');
        $timestamp_show_start = $request->get('timestamp_show_start');



        date_default_timezone_set("Europe/Paris");
        $now = time();
        $this->configService->setValue("timestamp_show_start", strval($now + $timestamp_show_start));
        $this->configService->setValue("timeline_cursor", strval($timeline_cursor));
        $this->configService->setValue("recipient", $recipient);
        $this->configService->setValue("show_is_going_on", "true");

        return $this->redirectToRoute('index');
    }


    /**
    *
    * @Route("/stop_the_show", methods={"POST"}, name="stop_the_show")
    **/
    public function StopTheShowAction(Request $request)
    {
        $this->configService->setValue("show_is_going_on", "false");
        return $this->redirectToRoute('index');
    }

}
