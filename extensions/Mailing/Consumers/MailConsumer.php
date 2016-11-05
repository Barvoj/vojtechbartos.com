<?php

namespace Mailing\Consumers;

use Auth\Model\Repositories\UserRepository;
use Kdyby\RabbitMq\IConsumer;
use Libs\Db\EntityNotFoundException;
use Libs\Logger\Logger;
use Nette\Mail\IMailer;
use Nette\Mail\Message;
use Nette\Mail\SendException;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use PhpAmqpLib\Message\AMQPMessage;

class MailConsumer implements IConsumer
{
    /** @var UserRepository */
    private $userRepository;

    /** @var IMailer */
    protected $mailer;

    /** @var Logger */
    protected $logger;

    /**
     * @param UserRepository $userRepository
     * @param IMailer $mailer
     * @param Logger $logger
     */
    public function __construct(UserRepository $userRepository, IMailer $mailer, Logger $logger)
    {
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * Process message
     *
     * @param AMQPMessage $msgRaw
     * @return int
     */
    public function process(AMQPMessage $msgRaw) : int
    {
        try {
            $msg = Json::decode($msgRaw->body);
        } catch (JsonException $ex) {
            $this->logger->addError($ex);
            return IConsumer::MSG_REJECT;
        }

        try {
            $user = $this->userRepository->get($msg->userId);
        } catch (EntityNotFoundException $ex) {
            $this->logger->addError($ex);
            return IConsumer::MSG_REJECT;
        }

        $mail = new Message();
        $mail->addTo($user->getEmail());
        $mail->setSubject("Email test");
        $mail->setBody("Toto je testovací e-mail.");

        try {
            $this->mailer->send($mail);
        } catch (SendException $ex) {
            $this->logger->addCritical($ex);
            return IConsumer::MSG_REJECT_REQUEUE;
        }

        return IConsumer::MSG_ACK;
    }
}