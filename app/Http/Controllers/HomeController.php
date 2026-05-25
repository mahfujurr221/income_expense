<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Employee data
    private $employees = [
        ['id' => '00101', 'name' => 'Champa Akter', 'role' => 'Chairman', 'dept' => 'N/A'],
        ['id' => '00102', 'name' => 'Tamim Hossain', 'role' => 'Assistant Manager', 'dept' => 'HR, Admin & Accounts'],
        ['id' => '00103', 'name' => 'Akram Hossain', 'role' => 'Office Assistant', 'dept' => 'HR, Admin & Accounts'],
        ['id' => '00104', 'name' => 'Mamun Ar Rashid', 'role' => 'Assistant Manager', 'dept' => 'IT'],
        ['id' => '00105', 'name' => 'Adnan Siddique', 'role' => 'Software Developer', 'dept' => 'IT'],
        ['id' => '00106', 'name' => 'Md. Mahfujur Rahman', 'role' => 'Software Developer', 'dept' => 'IT'],
        ['id' => '00107', 'name' => 'Md Marufur Rahman', 'role' => 'Junior Software Developer', 'dept' => 'IT'],
        ['id' => '00108', 'name' => 'Adnan Sami', 'role' => 'Executive Media & Communications', 'dept' => 'Media'],
        ['id' => '00109', 'name' => 'MD Abdul Aziz Rocky', 'role' => 'Executive Logistics', 'dept' => 'Media'],
        ['id' => '00110', 'name' => 'Eva Akter', 'role' => 'Executive Producer', 'dept' => 'Media'],
        ['id' => '00111', 'name' => 'Rubel Ahmed', 'role' => 'Cinematographer', 'dept' => 'Media'],
        ['id' => '00112', 'name' => 'Mahabub Alam', 'role' => 'Video Editor', 'dept' => 'Media'],
        ['id' => '00113', 'name' => 'Al Mucktadir Khan', 'role' => 'Senior Animator', 'dept' => 'Media'],
        ['id' => '00114', 'name' => 'Masudur Rahman', 'role' => 'Assistant Manager', 'dept' => 'HR, Admin & Accounts'],
        ['id' => '00115', 'name' => 'Md. Jahirul Islam', 'role' => 'Assistant Manager', 'dept' => 'HR, Admin & Accounts'],
    ];

    /**
     * Frontend landing page
     */
    public function index()
    {
        return view('frontend.home');
    }

    /**
     * Show all team members
     */
    public function team()
    {
        return view('frontend.team.index', ['employees' => $this->employees]);
    }

    /**
     * Show single member detail (QR code destination)
     */
    public function show($id)
    {
        $employee = collect($this->employees)->firstWhere('id', $id);

        if (!$employee) {
            abort(404, 'Team member not found');
        }

        return view('frontend.team.show', compact('employee'));
    }
}
