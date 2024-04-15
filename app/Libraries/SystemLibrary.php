<?php

namespace App\Libraries;

class SystemLibrary
{
    public function getCurrentTime()
    {
        return date("H:i:s");
    }

    public function getCurrentDate()
    {
        return date("Y-m-d");
    }

    public function getCurrentMonth()
    {
        return date("m/Y");
    }

    public function getTimestamp()
    {
        return date("YmdHis");
    }

    public function getCurrentDateTime()
    {
        return $this->getCurrentDate() . ' ' . $this->getCurrentTime();
    }

    public function returnUnixTime()
    {
        return strtotime($this->getCurrentDateTime());
    }

    public function generateString()
    {
        $base36Characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base36String = '';
        $integerValue = $this->returnUnixTime();

        while ($integerValue > 0) {
            $remainder = $integerValue % 36;
            $base36String = $base36Characters[$remainder] . $base36String;
            $integerValue = (int)($integerValue / 36);
        }

        return $base36String;
    }


    public function generateInteger($length = 5)
    {
        $charset = '0123456789';
        $password = '';
        $charsetLength = strlen($charset);

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $charsetLength - 1);
            $password .= $charset[$randomIndex];
        }

        return $password;
    }


    public function getAgentData($agent)
    {

        if ($agent->isRobot()) {
            # code...
            $device = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            # code...
            $device = $agent->getMobile();
        } else {
            $device = "Desktop";
        }

        return [
            'agentString' => $agent->getAgentString(),
            'browser' => $agent->getBrowser(),
            'browser_Version' => $agent->getVersion(),
            'platform' => $agent->getPlatform(),
            'Device' => $device,
            'referrer' => $agent->getReferrer(),
        ];
    }

    public function generateRandomPassword($length = 10)
    {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_';
        $password = '';
        $charsetLength = strlen($charset);

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $charsetLength - 1);
            $password .= $charset[$randomIndex];
        }

        return $password;
    }
}
