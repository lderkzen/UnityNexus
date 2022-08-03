<?php

namespace App\Http\Controllers;

use App\Models\AuditLogEntry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuditLogController extends Controller
{
    public function index()
    {
        Inertia::render('AuditLog/Index', [
            'entries' => AuditLogEntry::all()
        ]);
    }
}
