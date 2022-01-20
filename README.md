# Karix Sms and Whatsapp notifications channel for Laravel 6

This package makes it easy to send sms via [Karix.io](https://karix.io) with Laravel 6 or up.

## Installation

You can install the package via composer:

``` bash
composer require samuelbie/karix
```

### Setting up the Karix id and token

Login to Karix.io and get your ID and Token, put that on your .env file and
add your Karix Id and Token to your `config/services.php`:

```php
// config/karix.php
<?php
    return [
        'id'            => env('KARIX_ID'),
        'token'         => env('KARIX_TOKEN'),
        'sms_from'      => env('KARIX_FROM'),
        'whatsapp_from' => env('KARIX_WHATSAPP')
    ];
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use Samuelbie\Karix\Broadcasting\KarixMessage;
use Samuelbie\Karix\Broadcasting\KarixSMSChannel;
use Samuelbie\Karix\Broadcasting\KarixWhatsappChannel;


class YourNotification extends Notification
{
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [KarixSMSChannel::class, KarixWhatsappChannel::class];
    }


    public function toSmSKarix($notifiable)
    {
        return KarixMessage::create()
            ->content(['text' => 'Your message comes here']);
    }

    public function toWhatsappKarix($notifiable)
    {
        return KarixMessage::create()
            ->content([
                'text' => 'Your message comes here',
                'media' => 'url-to-media',
                'location' => [
                    'latitude' => 'the latitude here',
                    'longitude' => 'the longitude here'
                ]
            ]);
    }
}
```


In order to let your Notification know that there is a new channel called KarixSmsChannel, add the `routeNotificationForKarix` method to your Notifiable model (probably your user.php file).

This method needs to return email of the user (if it's a private board) and the list ID of the Trello list to add the card to.

Caveat : Make sure you have a 'phone' field in your table along with country code like +91xxxxxxxxxx for which you are using this.

```php
public function routeNotificationForKarix()
{
    return $this->phone;
}
```


## Security

If you discover any security related issues, please email sarthak@bitfumes.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Samuel Bié](https://github.com/samuel-bie)
- [Sarthak Shrivastava](https://github.com/s-sarthak)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
