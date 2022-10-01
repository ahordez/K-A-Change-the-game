<?php
namespace POSD\Service;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Norgul\Xmpp\XmppClient;
use Norgul\Xmpp\Options;
use POSD\Entity\Configuration;

class ConfigurationService
{
    private $logger;
    private $em;


    public function __construct(LoggerInterface $logger, EntityManagerInterface $em)
    {
        $this->logger = $logger;
        $this->em = $em;
    }


    private function getValue(string $key): string
    {
        $this->em->clear();
        //$this->logger->debug("Getting configuration ".$key);
        $repository = $this->em->getRepository(Configuration::class);
        $config = $repository->findOneBy(['name' => $key]);
        if(is_null($config)) throw new \Exception("Trying to get config value of key ".$key." but it's null");
        //$this->logger->debug("Configuration ".$key."=".$config->getValue());
        return $config->getValue();
    }

    public function getStringValue(string $key): string
    {
        $value = $this->getValue($key);
        return $value;
    }

    public function getIntValue(string $key): string
    {
        $value = $this->getValue($key);
        return intval($value);
    }

    public function getBoolValue(string $key): string
    {
        $value = $this->getValue($key);
        if($value == "true")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function setValue(string $key, string $value)
    {
        $this->logger->debug("Setting configuration ".$key."=".$value);
        $repository = $this->em->getRepository(Configuration::class);
        $config = $repository->findOneBy(['name' => $key]);
        $config->setValue($value);
        $this->em->persist($config);
        $this->em->flush();
    }

}
