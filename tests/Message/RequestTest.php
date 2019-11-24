<?php

namespace Omnipay\Dotpay\Message;

use Omnipay\Tests\TestCase;

class RequestTest extends TestCase
{
    public function testConstruct()
    {
        $request = new Request($this->getHttpClient(), $this->getHttpRequest());

        $request->setAccountId(123456);
        $request->setType(100);
        $request->setAmount(10.00);
        $request->setLang('es');
        $request->setApiVersion('prog');
        $request->setChannel(321);
        $request->setReturnUrl('http://example.com/return');
        $request->setNotifyUrl('http://example.com/notify');
        $request->setDescription('description for payment');
        $request->setCurrency('JPY');

        $requestData = $request->getData();

        $this->assertEquals($requestData['id'], 123456);
        $this->assertEquals($requestData['amount'], 10.00);
        $this->assertEquals($requestData['currency'], 'JPY');
        $this->assertEquals($requestData['description'], 'description for payment');
        $this->assertEquals($requestData['lang'], 'es');
        $this->assertEquals($requestData['type'], 100);
        $this->assertEquals($requestData['URL'], 'http://example.com/return');
        $this->assertEquals($requestData['URLC'], 'http://example.com/notify');
        $this->assertEquals($requestData['channel'], 321);
        $this->assertEquals($requestData['chk'], 'c0f78147d4c64739fd3ad5e723b8434a10d90a9f4fc64b4cd3a5ba1df1f2e60c');
    }

    public function testAllParams()
    {
        $request = new Request($this->getHttpClient(), $this->getHttpRequest());

        $request->setAccountId(123456);
        $request->setType(100);
        $request->setAmount(10.00);
        $request->setCurrency('JPY');
        $request->setDescription('description for payment');
        $request->setReturnUrl('http://example.com/return');
        $request->setNotifyUrl('http://example.com/notify');

        $request->setLang('es');
        $request->setApiVersion('prog');
        $request->setChannel(321);
        $request->setChannelGroups("P,K");
        $request->setChLock("1");
        $request->setButtonText("Button Text");
        $request->setFirstName("firstname");
        $request->setLastName("lastname");
        $request->setEmail("mail@example.com");
        $request->setStreet("Street");
        $request->setStreetN1("n1");
        $request->setStreetN2("n2");
        $request->setAddr3("Addr3");
        $request->setCity("City");
        $request->setPostcode("00-000");
        $request->setPhone("123-456-789");
        $request->setCountry("pl");
        $request->setPInfo("P INFO");
        $request->setPEmail("pemail@example.com");
        $request->setBylaw('1');
        $request->setPersonalData('1');

        $requestData = $request->getData();

        $this->assertEquals($requestData['id'], 123456);
        $this->assertEquals($requestData['amount'], 10.00);
        $this->assertEquals($requestData['currency'], 'JPY');
        $this->assertEquals($requestData['description'], 'description for payment');
        $this->assertEquals($requestData['URL'], 'http://example.com/return');
        $this->assertEquals($requestData['URLC'], 'http://example.com/notify');

        $this->assertEquals($requestData['lang'], 'es');
        $this->assertEquals($requestData['type'], 100);
        $this->assertEquals($requestData['channel'], 321);
        $this->assertEquals($requestData['channel_groups'], "P,K");
        $this->assertEquals($requestData['ch_lock'], "1");
        $this->assertEquals($requestData['buttontext'], "Button Text");
        $this->assertEquals($requestData['firstname'], "firstname");
        $this->assertEquals($requestData['lastname'], "lastname");
        $this->assertEquals($requestData['email'], "mail@example.com");
        $this->assertEquals($requestData['street'], "Street");
        $this->assertEquals($requestData['street_n1'], "n1");
        $this->assertEquals($requestData['street_n2'], "n2");
        $this->assertEquals($requestData['addr3'], "Addr3");
        $this->assertEquals($requestData['city'], "City");
        $this->assertEquals($requestData['postcode'], "00-000");
        $this->assertEquals($requestData['phone'], "123-456-789");
        $this->assertEquals($requestData['country'], "pl");
        $this->assertEquals($requestData['p_info'], "P INFO");
        $this->assertEquals($requestData['p_email'], "pemail@example.com");
        $this->assertEquals($requestData['bylaw'], "1");
        $this->assertEquals($requestData['personal_data'], "1");
    }

    public function testGetAction()
    {
        $request = new Request($this->getHttpClient(), $this->getHttpRequest());

        $request->setAction('http://example.com/');

        $this->assertEquals($request->getAction(), 'http://example.com/');
    }
}
