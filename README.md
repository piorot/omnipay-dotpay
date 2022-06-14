# Omnipay: Dotpay

**Dotpay driver for the Omnipay PHP payment processing library**

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "omnipay/dotpay": "~3.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Dotpay

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Example usage:

Initialize gateway:
```php
$gateway = Omnipay::create('Dotpay');

// Gateway specific parameters
$gateway->initialize([
    'accountId'  => 'YOUR_DOTPAY_ID',
    'pid'        => 'YOUR_SECRET_PIN',
    'type'       => '0',
    'action'     => 'https://ssl.dotpay.pl/test_payment/',
    'lang'       => 'pl',
    'apiVersion' => 'next',
    'channel'    => '0'
]);
```

```php
// Omnipay generic parameters
$params = [
    'amount' => 12.34,
    'currency' => 'PLN',
    'description' => 'Test payment',
    'returnUrl' => 'https://www.your-domain.nl/return_here',
    'notifyUrl' => 'https://www.your-domain.nl/notify_here',
    'email' => 'customer_email@example.com',
];

// You can add Dotpay-specific (not Omnipay generic) parameters here:
$params += [
    'first_name' => 'Jan',
    'last_name' => 'Kowalski',
];

$response = $gateway
    ->purchase($params)
    ->send();

if ($response->isRedirect()) {
    $response->redirect();
} else if ($response->isSuccessful()) {
    // process payment
} else {
    // process failure
}
```
