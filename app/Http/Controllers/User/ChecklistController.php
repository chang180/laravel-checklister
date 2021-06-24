<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChecklistController extends Controller
{
    public function show(Checklist $checklist): View
    {
        return view('users.checklists.show',compact('checklist'));
    }
}
