<?php

namespace Pottkinder\ImapSync\Factories;

use Pottkinder\ImapSync\Domain\Model\Mailbox;

class MailboxFactory
{
    protected static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * function createMailbox
     * Function to handle with empty newHosts, newPasswords or newUsers and use odones instead.
     *
     * @throws \Exception if argument is missing
     *
     * @param array $mailboxArray from Config
     *
     * @return Mailbox
     */
    public function createMailbox($mailboxArray)
    {
        try {
            $this->requireArgument('oldHost', $mailboxArray);
            $this->requireArgument('oldUser', $mailboxArray);
            $this->requireArgument('oldPassword', $mailboxArray);
        } catch (\Exception $e) {
            throw $e;
        }
        $mailbox = new Mailbox($mailboxArray['oldHost'], $mailboxArray['oldUser'], $mailboxArray['oldPassword']);
        $mailbox = $this->setOldOrNew($mailbox, $mailboxArray, 'newUser', 'oldUser');
        $mailbox = $this->setOldOrNew($mailbox, $mailboxArray, 'newHost', 'oldHost');
        $mailbox = $this->setOldOrNew($mailbox, $mailboxArray, 'newPassword', 'oldPassword');
        $mailbox->setLastRun(\DateTime::createFromFormat('d.m.Y', '01.01.2016'));

        return $mailbox;
    }

    /**
     * function requireArgument
     * Checks if $argumentName exists in $mailboxArray or throws Exception.
     *
     * @throws \Exception if value not exists
     *
     * @param string $argumentName
     * @param array  $mailboxArray
     */
    protected function requireArgument($argumentName, $mailboxArray)
    {
        if (!isset($mailboxArray[$argumentName]) || strlen($mailboxArray[$argumentName]) === 0) {
            throw new \Exception('Required Mailbox value "'.$argumentName.'" not found in array.');
        }
    }

    /**
     * function setOldOrNew
     * Checks if $newValue exists correctly in $mailboxArray and sets it or falls back to $oldValue.
     *
     * @param Mailbox $mailbox
     * @param array   $mailboxArray
     * @param string  $newValue
     * @param string  $oldValue
     *
     * @return Mailbox
     */
    protected function setOldOrNew($mailbox, $mailboxArray, $newValue, $oldValue)
    {
        $method = 'set'.ucfirst($newValue);
        if (!array_key_exists($newValue, $mailboxArray) || !isset($mailboxArray[$newValue]) || empty($mailboxArray[$newValue]) || is_null($mailboxArray[$newValue]) || strlen($mailboxArray[$newValue]) === 0) {
            $mailbox->{$method}($mailboxArray[$oldValue]);
        } else {
            $mailbox->{$method}($mailboxArray[$newValue]);
        }

        return $mailbox;
    }
}
