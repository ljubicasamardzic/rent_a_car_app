<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reservations = Reservation::query()->orderByDesc('created_at')->paginate(Reservation::PER_PAGE);
        return view('reservations.index', compact('reservations'));
    }
}
