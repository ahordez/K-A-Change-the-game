<?php
namespace POSD\Service;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use POSD\Entity\Message;
use POSD\Service\ConfigurationService;
use POSD\Service\XMPPService;

class LoopService
{
    private $logger;
    private $em;
    private $configService;
    private $xmppService;


    public function __construct(LoggerInterface $logger,
                                EntityManagerInterface $em,
                                ConfigurationService $configService,
                                XMPPService $xmppService)
    {
        $this->logger           = $logger;
        $this->em               = $em;
        $this->configService    = $configService;
        $this->xmppService      = $xmppService;
    }


    public function loop()
    {
        date_default_timezone_set("Europe/Paris");
        $previous_show_state = false;
        $messages_already_sended = array(); //Tableau des messages déjà envoyé pendant le show
        $timestamp_show_start = null; //Date de démarrage effective du show
        $count_messages_to_send = 0; //Nombre de messages qui seront envoyés
        $timeline_cursor = 0; //Curseur dans la timeline. Par défaut à 0, si égal à x alors enverra seulement les messages à partir de x lors du démarrage du show
        $waiting_to_start_the_show = true;

        while(true)
        {
            $now = time();

            //https://stackoverflow.com/questions/44278621/mysql-error-mysql-server-has-gone-away
            //https://stackoverflow.com/questions/14060507/doctrine2-connection-timeout-in-daemon
            if ($this->em->getConnection()->ping() === FALSE)
            {
                    $this->logger->debug("Reconnecting to MySQL...");
                    $this->em->getConnection()->close(); // Close any previous connection as they are not active
                    $this->em->getConnection()->connect(); // Get a fresh connection
            }

            $show_is_going_on = $this->configService->getBoolValue("show_is_going_on");


            if($previous_show_state == true and $show_is_going_on == false)
            {
                //Le show a été arrété (soit manuellement ,soit automatiquement car plus de messages)
                //Donc on réinitialise pour ramner la loop dans un état stable et standard d'avant show.
                $show_is_going_on = false;
                $messages_already_sended = array();
                $timestamp_show_start = null;
                $count_messages_to_send = 0;
                $timeline_cursor = 0;
                $waiting_to_start_the_show = true;
            }


            if($show_is_going_on and $waiting_to_start_the_show)
            {
                $timestamp_show_start = $this->configService->getIntValue("timestamp_show_start");
                if($now < $timestamp_show_start)
                {
                    //Waiting to start the show
                    $waiting_to_start_the_show = true;
                    $this->logger->debug("Waiting to start the show in ".($timestamp_show_start - $now)." seconds");
                }
                else
                {
                    $waiting_to_start_the_show = false;
                    //Timeline cursor : curseur de démarrage. 0 (défaut) pour commencer au début. 120 pour démarrer la timeline à 2min, etc.
                    $timeline_cursor = $this->configService->getIntValue("timeline_cursor");
                    $timestamp_show_start = time() - $timeline_cursor;
                    $count_messages_to_send = $this->em->getRepository(Message::class)->countMessages($timeline_cursor);
                    $this->logger->debug("A new show is starting at NOW (timeline cursor=".$timeline_cursor."). There is ".$count_messages_to_send." messages to send.");
                }
            }


            //Boucle de traitement des messages pendant un show
            if($show_is_going_on and !$waiting_to_start_the_show)
            {
                //Get messages to send
                $messages = $this->em->getRepository(Message::class)->getMessagesToSend($now, $timestamp_show_start, $timeline_cursor);

                if(!empty($messages))
                {
                    $recipient = $this->configService->getStringValue("recipient");
                    //Pour chaque messages
                    foreach ($messages as $message)
                    {
                        // Si il n'a pas encore été envoyé
                        if(!in_array($message->getId(), $messages_already_sended))
                        {
                            // Envoyer message
                            $this->logger->debug("Time elapsed since show begun = ".$time_elapsed = $now - $timestamp_show_start."s");
                            $sended = $this->xmppService->sendMessage($message, $recipient);

                            // Marquer message comme envoyé. Si le message n'a pas pu être envoyé ($sended = false),
                            // une nouvelle tentative d'envoi sera effectuée au prochain tour de loop
                            // Si l'envoi échoue pendant plus de 30s, il ne sera jamais envoyé
                            // (car la requêtes récupère les message de now ou now-30s)
                            if($sended)
                            {
                                array_push($messages_already_sended, $message->getId());
                                $this->logger->debug("IDs of messages sended :".json_encode($messages_already_sended));
                            }
                        }
                    }
                }

                if(count($messages_already_sended) == $count_messages_to_send)
                {
                    //All messages where sent, the show is over
                    $this->logger->debug("All messages where sent, the show is over");
                    $this->configService->setValue("show_is_going_on", "false");
                }
            }

            $previous_show_state = $show_is_going_on;
            usleep(100000); //100ms
            //sleep(1);
        }
    }



}
