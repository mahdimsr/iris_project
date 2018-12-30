<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class DashboardController extends Controller
{
	public function dashboardView()
	{
		return view('layout');
    }


}
