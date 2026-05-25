<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Mock data for employees
    private $employees = [
        ['id' => '00101', 'name' => 'Champa Akter', 'role' => 'Chairman', 'dept' => 'N/A', 'image' => 'champa.jpg'],
        ['id' => '00102', 'name' => 'Tamim Hossain', 'role' => 'Assistant Manager', 'dept' => 'HR, Admin & Accounts', 'image' => 'tamim.jpg'],
        ['id' => '00103', 'name' => 'Rahim Uddin', 'role' => 'Senior Developer', 'dept' => 'IT', 'image' => 'rahim.jpg'],
        ['id' => '00104', 'name' => 'Sultana Begum', 'role' => 'Marketing Lead', 'dept' => 'Marketing', 'image' => 'sultana.jpg'],
        // Add more mock data as needed
    ];

    /**
     * Show all team members.
     */
    public function index()
    {
        return view('frontend.team.index', ['employees' => $this->employees]);
    }

    /**
     * Show single member detail.
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
