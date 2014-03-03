<?php

 
     /**
      * @global array konfiguracja dostepu do bazy danych
      */
     

     global $__DB_CFG;
     $__DB_CFG = array(
          'database' => '',
          'host' => '',
          'user' => '',
          'pass' => '',
          'driver' => 'mysql',
     );
     
     $__DB_CFG['uri'] = $__DB_CFG['driver'].'://'.$__DB_CFG['user'].':'.$__DB_CFG['pass'].'@'.$__DB_CFG['host'].'/'.$__DB_CFG['database']; 
     
?>
