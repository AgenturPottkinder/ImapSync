<?php

namespace Pottkinder\ImapSync\Service;

use Pottkinder\ImapSync\Factories\MailboxFactory;

class ConfigurationService
{
    protected static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConfiguration()
    {
        $tmpArrays = [];
        $returnMailboxes = [];
        foreach ($this->getFiles() as $file) {
            $tmpArrays = array_merge($tmpArrays, $this->readFile($file));
        }
        foreach ($tmpArrays as $tmp) {
            try {
                $returnMailboxes[] = MailboxFactory::getInstance()->createMailbox($tmp);
            } catch (\Exception $e) {
                LogService::log(getmypid(), $e->getMessage());
            }
        }

        return $returnMailboxes;
    }

    protected function getFiles()
    {
        return glob(__DIR__.'/../../Configuration/*.php');
    }

    protected function readFile($filename)
    {
        $return = [];
        /*
            Should contain Array of these datastruct
            [
                'oldUser' => '',
                'oldPassword' => '',
                'oldHost' => $oldHost,
                'newUser' => '',
                'newPassword' => '',
                'newHost' => $newHost
            ],
        */
        require_once $filename;

        return $return;
    }
}
