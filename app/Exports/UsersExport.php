<?php

namespace App\Exports;

use Illuminate\Contracts\View\View; 
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView 
{
    public function __construct($users)
    {
        $this->users = $users;
    }
    

    public function view(): View
    {
        return view('admin/user/usersExport', [
            'users'=>$this->users
        ]);
    }
}
