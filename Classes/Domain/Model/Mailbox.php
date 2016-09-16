<?php

namespace Pottkinder\ImapSync\Domain\Model;

class Mailbox
{
    protected $oldHost = '';
    protected $oldUser = '';
    protected $oldPassword = '';
    protected $newHost = '';
    protected $newUser = '';
    protected $newPassword = '';
    protected $interval = 60;
    protected $lastRun = null;
    protected $running = false;
    protected $active = true;

    /**
     * Mailbox constructor.
     *
     * @param string $oldHost
     * @param string $oldUser
     * @param string $oldPassword
     * @param string $newHost
     * @param string $newUser
     * @param string $newPassword
     * @param int    $interval
     * @param bool   $active
     */
    public function __construct($oldHost, $oldUser, $oldPassword, $newHost = '', $newUser = '', $newPassword = '', $interval = 60, $active = true)
    {
        $this->oldHost = $oldHost;
        $this->oldUser = $oldUser;
        $this->oldPassword = $oldPassword;
        $this->newHost = $newHost;
        $this->newUser = $newUser;
        $this->newPassword = $newPassword;
        $this->interval = $interval;
        $this->active = $active;
        $this->lastRun = new \DateTime();
    }

    /**
     * @return string
     */
    public function getOldHost()
    {
        return $this->oldHost;
    }

    /**
     * @param string $oldHost
     */
    public function setOldHost($oldHost)
    {
        $this->oldHost = $oldHost;
    }

    /**
     * @return string
     */
    public function getOldUser()
    {
        return $this->oldUser;
    }

    /**
     * @param string $oldUser
     */
    public function setOldUser($oldUser)
    {
        $this->oldUser = $oldUser;
    }

    /**
     * @return string
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * @param string $oldPassword
     */
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;
    }

    /**
     * @return string
     */
    public function getNewHost()
    {
        return $this->newHost;
    }

    /**
     * @param string $newHost
     */
    public function setNewHost($newHost)
    {
        $this->newHost = $newHost;
    }

    /**
     * @return string
     */
    public function getNewUser()
    {
        return $this->newUser;
    }

    /**
     * @param string $newUser
     */
    public function setNewUser($newUser)
    {
        $this->newUser = $newUser;
    }

    /**
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param string $newPassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param int $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastRun()
    {
        return $this->lastRun;
    }

    /**
     * @param \DateTime|null $lastRun
     */
    public function setLastRun($lastRun)
    {
        $this->lastRun = $lastRun;
    }

    /**
     * @return bool
     */
    public function isRunning()
    {
        return $this->running;
    }

    /**
     * @param bool $running
     */
    public function setRunning($running)
    {
        $this->running = $running;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * function shouldRun
     * Checks if last run is old enough.
     *
     * @return bool
     */
    public function shouldRun()
    {
        $next = new \DateTime();
        $next->sub(new \DateInterval('PT'.$this->interval.'M'));

        return $next > $this->lastRun;
    }
}
