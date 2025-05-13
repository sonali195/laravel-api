<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VolunteerRegistration;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class VolunteerRegistrationController extends Controller
{
    public function register(Request $request)
    {

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteer_registrations,email',
            'phone_number' => 'required|string|max:20',
            'profession' => 'required|string|max:100',
            'caravan_type' => 'required|string|max:100',
            'join_from' => 'required|string|max:100',
            'visited_before' => 'required|string|max:100',
            'additional_comments' => 'nullable|string',
        ]);

        $volunteer = VolunteerRegistration::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Volunteer registered successfully.',
            'data' => $volunteer
        ]);
    }
    public function index(Request $request)
    {
        try {
            return view('admin.volunterregister.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }
    public function getRecords(Request $request)
    {
        try {
            $travelGuide = VolunteerRegistration::query();

            return DataTables::of($travelGuide)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     $btn = '<a href="' . route('admin.volunteerlist.edit', ['volunteerlist' => $row->id]) . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>';
                //     $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->id . '" title="Delete"><i class="uil-trash-alt"></i></a>';
                //     return $btn;
                // })
                // ->rawColumns(['action'])
                ->make(true);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['error' => trans('app.something_went_wrong')], 500);
        }
    }
}
