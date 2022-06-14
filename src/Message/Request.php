<?php

namespace Omnipay\Dotpay\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Dotpay\ChkGenerator;

/**
 * Dotpay Purchase Request.
 */
class Request extends AbstractRequest
{
    public function getAccountId()
    {
        return $this->getParameter('accountId');
    }

    public function setAccountId($value)
    {
        return $this->setParameter('accountId', $value);
    }

    public function getPid()
    {
        return $this->getParameter('pid');
    }

    public function setPid($value)
    {
        return $this->setParameter('pid', $value);
    }

    public function getType()
    {
        return $this->getParameter('type');
    }

    public function setType($value)
    {
        return $this->setParameter('type', $value);
    }

    public function getAction()
    {
        return $this->getParameter('action');
    }

    public function setAction($value)
    {
        return $this->setParameter('action', $value);
    }

    public function getLang()
    {
        return $this->getParameter('lang');
    }

    public function setLang($value)
    {
        return $this->setParameter('lang', $value);
    }

    public function getApiVersion()
    {
        return $this->getParameter('apiVersion');
    }

    public function setApiVersion($value)
    {
        return $this->setParameter('apiVersion', $value);
    }

    public function getChannel()
    {
        return $this->getParameter('channel');
    }

    public function setChannel($value)
    {
        return $this->setParameter('channel', $value);
    }

    public function getChannelGroups()
    {
        return $this->getParameter('channel_groups');
    }

    public function setChannelGroups($value)
    {
        return $this->setParameter('channel_groups', $value);
    }

    public function getChLock()
    {
        return $this->getParameter('ch_lock');
    }

    public function setChLock($value)
    {
        return $this->setParameter('ch_lock', $value);
    }

    public function getButtonText()
    {
        return $this->getParameter('button_text');
    }

    public function setButtonText($value)
    {
        return $this->setParameter('button_text', $value);
    }

    public function getControl()
    {
        return $this->getParameter('control');
    }

    public function setControl($value)
    {
        return $this->setParameter('control', $value);
    }

    public function getFirstName()
    {
        return $this->getParameter('first_name');
    }

    public function setFirstName($value)
    {
        return $this->setParameter('first_name', $value);
    }

    public function getLastName()
    {
        return $this->getParameter('last_name');
    }

    public function setLastName($value)
    {
        return $this->setParameter('last_name', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getStreet()
    {
        return $this->getParameter('street');
    }

    public function setStreet($value)
    {
        return $this->setParameter('street', $value);
    }

    public function getStreetN1()
    {
        return $this->getParameter('street_n1');
    }

    public function setStreetN1($value)
    {
        return $this->setParameter('street_n1', $value);
    }

    public function getStreetN2()
    {
        return $this->getParameter('street_n2');
    }

    public function setStreetN2($value)
    {
        return $this->setParameter('street_n2', $value);
    }

    public function getState()
    {
        return $this->getParameter('state');
    }

    public function setState($value)
    {
        return $this->setParameter('state', $value);
    }

    public function getAddr3()
    {
        return $this->getParameter('addr3');
    }

    public function setAddr3($value)
    {
        return $this->setParameter('addr3', $value);
    }

    public function getCity()
    {
        return $this->getParameter('city');
    }

    public function setCity($value)
    {
        return $this->setParameter('city', $value);
    }

    public function getPostcode()
    {
        return $this->getParameter('postcode');
    }

    public function setPostcode($value)
    {
        return $this->setParameter('postcode', $value);
    }

    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    public function setPhone($value)
    {
        return $this->setParameter('phone', $value);
    }

    public function getCountry()
    {
        return $this->getParameter('country');
    }

    public function setCountry($value)
    {
        return $this->setParameter('country', $value);
    }

    public function getPInfo()
    {
        return $this->getParameter('p_info');
    }

    public function setPInfo($value)
    {
        return $this->setParameter('p_info', $value);
    }

    public function getPEmail()
    {
        return $this->getParameter('p_email');
    }

    public function setPEmail($value)
    {
        return $this->setParameter('p_email', $value);
    }

    public function getBylaw()
    {
        return $this->getParameter('bylaw');
    }

    public function setBylaw($value)
    {
        return $this->setParameter('bylaw', $value);
    }

    public function getPersonalData()
    {
        return $this->getParameter('personal_data');
    }

    public function setPersonalData($value)
    {
        return $this->setParameter('personal_data', $value);
    }

    public function getStatus()
    {
        return $this->getParameter('status');
    }

    public function getData()
    {
        $this->validate('amount');

        $data = array(
            'id' => (string)$this->getAccountId(),
            'amount' => (string)$this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'lang' => $this->getLang(),
            'api_version' => $this->getApiVersion()
        );

        $additional = array(
            'channel' => $this->getChannel(),
            'channel_groups' => $this->getChannelGroups(),
            'ch_lock' => $this->getChLock(),
            'url' => $this->getReturnUrl(),
            'type' => (string)$this->getType(),
            'buttontext' => $this->getButtonText(),
            'urlc' => $this->getNotifyUrl(),
            'control' => $this->getControl(),
            'firstname' => $this->getFirstName(),
            'lastname' => $this->getLastName(),
            'email' => $this->getEmail(),
            'street' => $this->getStreet(),
            'street_n1' => $this->getStreetN1(),
            'street_n2' => $this->getStreetN2(),
            'state' => $this->getState(),
            'addr3' => $this->getAddr3(),
            'city' => $this->getCity(),
            'postcode' => $this->getPostcode(),
            'phone' => $this->getPhone(),
            'country' => $this->getCountry(),
            'p_info' => $this->getPInfo(),
            'p_email' => $this->getPEmail(),
            'bylaw' => $this->getBylaw(),
            'personal_data' => $this->getPersonalData(),
        );

        foreach ($additional as $key => $value) {
            if ($value != '') {
                $data[$key] = $value;
            }
        }

        $data['chk'] = ChkGenerator::generateChk($this->getPid(), $data);

        return $data;
    }

    public function getPostData()
    {
    }

    public function sendData($data)
    {
        return $this->response = new Response($this, $data);
    }
}
