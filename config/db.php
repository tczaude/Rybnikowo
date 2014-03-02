<?php

 
     /**
      * @global array konfiguracja dostepu do bazy danych
      */
     

     global $__DB_CFG;
     $__DB_CFG = array(
          'database' => 'wmurassql1',
          'host' => '127.0.0.1',
          'user' => 'wmurassql1',
          'pass' => '2MwMzZkZWN',
          'driver' => 'mysql',
     );
     
     $__DB_CFG['uri'] = $__DB_CFG['driver'].'://'.$__DB_CFG['user'].':'.$__DB_CFG['pass'].'@'.$__DB_CFG['host'].'/'.$__DB_CFG['database']; 
     
?>