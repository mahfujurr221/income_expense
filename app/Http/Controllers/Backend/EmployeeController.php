<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EmployeeController extends Controller
{
    // Employee data - should eventually come from database
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
     * Show the ID card print view with QR codes.
     */
    public function printCards()
    {
        // Pass employees to the view to generate cards
        return view('backend.pages.print-ids', ['employees' => $this->employees]);
    }

    /**
     * Download the QR code as an SVG file.
     */
    public function downloadQrCode($id)
    {
        $employee = collect($this->employees)->firstWhere('id', $id);

        if (!$employee) {
            abort(404, 'Employee not found');
        }

        $url = route('frontend.member.show', $id);
        $qrCode = QrCode::format('svg')->size(300)->generate($url);

        return response($qrCode, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="qrcode-' . $id . '.svg"',
        ]);
    }
}
