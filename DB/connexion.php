<?php
    function connexion(){
        $host='localhost';
        $dbname='ADNNews';
        $user='root';
        $pass='';
        $dbh='';
        // -- connexion
        try{
            $dbh= new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$pass);
            $dbh->exec("SET CHARACTER SET utf8");
        }catch(PDOException $e){
            print 'Erreur ! :'.$e->getMessage().'<br/>';
            die();
        }
        return $dbh;
    }
?>