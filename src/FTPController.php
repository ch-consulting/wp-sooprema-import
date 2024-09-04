<?php
namespace CHSOOPREMA;
use Touki\FTP\Connection\Connection;
use Touki\FTP\Connection\AnonymousConnection;
use Touki\FTP\Connection\SSLConnection;
          
class FTPController
{

    public function __construct()
    {
        $ftp='ftp.habitania.com';
        $user='35425437';
        $pass='HabXML2015';

        $connection = new Connection($ftp, $user, $pass, $port = 21, $timeout = 90, $passive = false);
        return $connection->open();
    }
}