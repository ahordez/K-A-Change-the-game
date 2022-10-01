<?php
namespace POSD\Service;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Norgul\Xmpp\XmppClient;
use Norgul\Xmpp\Options;
use POSD\Entity\Message;

class XMPPService
{
    private $logger;
    private $em;


    public function __construct(LoggerInterface $logger, EntityManagerInterface $em)
    {
        $this->logger = $logger;
        $this->em = $em;
    }


    public function sendMessage(Message $message, string $recipient)
    {
        try
        {
            $this->logger->debug("Sending message (ID=".$message->getId()." - timestamp=".$message->getTimestamp()." - sender=".$message->getSender()." - recipient=".$recipient.") ".$message->getMessage());

            $options = new Options();
            $options->setHost("chessmove.nl")
                    ->setPort(5222)
                    ->setUsername($message->getSender())
                    ->setPassword("<password here>");
            $client = new XmppClient($options);
            $client->connect();
            //$client->iq->getRoster();
            $text = $message->getMessage();
            $text = str_replace("%date%", date("Y-m-d"), $text);
            $text = str_replace("%time%", date("H:i"), $text);
            $client->message->send($text, $recipient."@chessmove.nl");
            $client->disconnect();
            return true;
        }
        catch (\Throwable $exc)
        {
            $this->logger->critical("Failed to send message :".$exc->getMessage()." (code:".$exc->getCode().") - ".$exc->getFile()." ".$exc->getLine());
            return false;
        }
    }
}
