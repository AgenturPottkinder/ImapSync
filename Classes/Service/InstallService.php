<?php

namespace Pottkinder\ImapSync\Service;

class InstallService
{
    protected static $instance = null;
    protected $binaryPath = '';

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function ensureInstallation()
    {
        if (!$this->installed()) {
            $this->install();
        }
    }

    protected function installed()
    {
        $path = '';
        $os = strtoupper(substr(PHP_OS, 0, 3));
        if ($os === 'WIN') {
            die('Adjust my code to allow Windows...');
        } elseif ($os === 'DAR') {
            $path = '/usr/local/bin/imapsync';
        } else {
            die('Adjust my code to allow Linux...');
        }
        $this->binaryPath = $path;

        return file_exists($path);
    }

    protected function install()
    {
        $os = strtoupper(substr(PHP_OS, 0, 3));
        if ($os === 'WIN') {
            echo 'Please install imapsync';
        } elseif ($os === 'DAR') {
            echo 'Please install imaosync e.g. with brew install imapsync';
        } else {
            echo 'Please install imapsync with the package manager you prefere';
        }
        die();
    }

    public function getBinaryPath()
    {
        return $this->binaryPath;
    }
}
