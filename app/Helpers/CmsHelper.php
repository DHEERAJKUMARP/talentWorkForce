<?php
    function getActiveUsers()
    {
            $users = \DB::select('SELECT * from users where is_active=1');
            $totalActiveUsers = count($users);

            $totalEmployers = \DB::select('SELECT * from companies  where is_active=1');
            $totalEmployers = count($totalEmployers);
            $array=array('totalActiveUsers' =>$totalActiveUsers,'totalEmployers'=>$totalEmployers);
               return $array;
         
    }