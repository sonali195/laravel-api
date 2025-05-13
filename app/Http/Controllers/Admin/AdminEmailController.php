<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminEmailController extends Controller
{

    /**
     * Index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $emails = EmailTemplate::orderBy('id', 'asc')
                    ->where('status', 1);

                return DataTables::of($emails)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('admin.email.edit', ['email' => $row->id]) . '"  data-id="' . $row->id . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>&nbsp;';
                        // $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->id . '" title="Delete"><i class="uil-trash-alt"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('admin.emails.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Create
     *
     * @return void
     */
    public function create()
    {
        try {
            return view('admin.emails.add-email');
        } catch (Throwable $e) {
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:255'],
                'subject' => ['required', 'string', 'max:255'],
                'body' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator->getMessageBag()->toArray())
                    ->withInput();
            }

            $email = EmailTemplate::create([
                'title' => $request->title,
                'subject' => $request->subject,
                'body' => $request->body,
            ]);
            if ($email) {
                return redirect()->route('admin.email.index')->with('success', trans('app.Email_has_been_added'));
            } else {
                return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id = null)
    {
        try {
            if (is_null($id)) {
                return redirect()->back()->with('error', trans('app.something_went_wrong'));
            }

            $email = EmailTemplate::where('id', $id)->first();
            if (empty($email)) {
                return redirect()->route('admin.email.index')->with('error', trans('app.Email_is_not_found'));
            }
            return view('admin.emails.add-email', compact('email'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required', 'string', 'max:255'],
                    'subject' => ['required', 'string', 'max:255'],
                    'body' => ['required'],
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag()->toArray())->withInput();
            }

            $email = EmailTemplate::where('id', $request->id)->first();

            if (empty($email)) {
                return redirect()->route('admin.email.index')->with('error', trans('app.Email_is_not_found'));
            }

            $email = EmailTemplate::where('id', $request->id)
                ->update(
                    [
                        'title' => $request->title,
                        'subject' => $request->subject,
                        'body' => $request->body,
                    ]
                );

            if ($email) {
                return redirect()->route('admin.email.index')->with('success', trans('app.Email_has_been_updated'));
            } else {
                return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Destroy
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request, $id)
    {
        try {
            $data = ['status' => false, 'message' => trans('app.Email_is_not_found'), 'data' => null];

            if ($request->ajax()) {

                $email = EmailTemplate::where('id', $request->id)->first();
                if ($email) {
                    $email->delete();
                    $data['status'] = true;
                    $data['message'] = trans('app.Email_has_been_deleted');
                }
            }
            return response()->json($data, 200);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['error' => trans('app.something_went_wrong')], 400);
        }
    }
}
