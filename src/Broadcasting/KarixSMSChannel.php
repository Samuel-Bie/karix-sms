<?php
namespace samuelbie\Karix\Broadcasting;

use Exception;
use GuzzleHttp\Client;
use Karix\Configuration;
use Karix\Api\MessageApi;
use Karix\Model\CreateMessage;
use Illuminate\Notifications\Notification;

class KarixSMSChannel
{
    /**
     * The Karix client instance.
     */
    protected $config;

    /**
     * Create a new Karix channel instance.
     *
     *
     * @param string $from
     *
     * @return void
     */
    public function __construct()
    {
        $this->config = $this->setConfig();
    }

    /**
     * Send the given notification.
     *
     * @param mixed                                  $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('karix', $notification)) {
            return;
        }
        // Set Timezone
        $this->timezone();

        $message_data = $notification->toSmSKarix($notifiable);
        $message = new CreateMessage();
        // Set Message Body
        $destination = $message_data->to ? $message_data->to : [$to];

        $message->setSource(config('karix.sms_from'));
        $message->setChannel("sms");
        $message->setDestination($destination);
        $message->setContent($message_data->content);
        // Send Message
        return $this->sendMessage($message);
    }

    public function timezone()
    {
        date_default_timezone_set(config('app.timezone'));
    }

    protected function sendMessage($message)
    {
        $apiInstance = new MessageApi(new Client(), $this->config);
        try {
            $result = $apiInstance->sendMessage($message);
            return $result;
        } catch (Exception $e) {
            echo 'Exception when calling MessageApi->createMessage: ', $e->getMessage(), PHP_EOL;
        }
    }

    protected function setConfig()
    {
        $config = Configuration::getDefaultConfiguration();
        $config->setUsername(config('karix.id'));
        $config->setPassword(config('karix.token'));
        return $config;
    }
}
