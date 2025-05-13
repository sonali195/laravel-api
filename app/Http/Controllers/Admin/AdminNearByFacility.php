<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\NearByFacility;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminNearByFacility extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        try {
            return view('admin.nearbyfacility.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    public function getAll()
    {
        $perPage = request()->get('per_page', 5); // Default to 5 if not provided
        $page = request()->get('page', 1); // Default to page 1

        // Use the page and perPage in the query manually
        $facilities =  NearByFacility::orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $page);

        // Exclude timestamps from each item
        $facilities->getCollection()->transform(function ($item) {
            $data = $item->toArray();
            unset($data['created_at'], $data['updated_at'], $data['deleted_at']);
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $facilities->items(),
            'current_page' => $facilities->currentPage(),
            'last_page' => $facilities->lastPage(),
            'per_page' => $facilities->perPage(),
            'total' => $facilities->total(),
        ]);
    }

    public function shownearbyfacility()
    {
        // Fetch the travel guides for display


        // Fetch the schedule records (if needed)
        $nearbyfacility = NearByFacility::all();

        // Return the view and pass the nearby facilities data to it
        return view('pages.nearbyfacility', compact('nearbyfacility'));
    }


    public function getRecords(Request $request)
    {
        try {
            $nearbyfacility = NearByFacility::query();

            return DataTables::of($nearbyfacility)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.nearbyfacility.edit', ['nearbyfacility' => $row->id]) . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>';
                    $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->id . '" title="Delete"><i class="uil-trash-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['description', 'action'])
                ->make(true);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['error' => trans('app.something_went_wrong')], 500);
        }
    }





    /**
     * Create
     *
     * @return void
     */
    public function create(Request $request)
    {


        try {
            return view('admin.nearbyfacility.add-nearbyfacility');
        } catch (Throwable $e) {
            report($e);
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
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required', 'string', 'max:255', 'unique:near_by_facilities,title,NULL,id,deleted_at,NULL'],
                    'description' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                //'type' => $request->type,
                'title' => $request->title,
                // 'category' => $request->category,
                'description' => $request->description,
            ];

            $nearbyfacility = NearByFacility::create($data);
            if ($nearbyfacility) {
                DB::commit();
                return redirect()->route('admin.nearbyfacility.index')->with('success', trans('app.nearbyfacility_has_been_added'));
            } else {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(Request $request, nearbyfacility $nearbyfacility)
    {
        try {
            if (empty($nearbyfacility)) {
                return redirect()->route('admin.nearbyfacility.index')->with('error', trans('app.nearbyfacility_is_not_found'));
            }

            return view('admin.nearbyfacility.add-nearbyfacility', compact('nearbyfacility'));
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
    public function update(Request $request, nearbyfacility $nearbyfacility)
    {


        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required'],
                    'description' => 'required',

                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //    echo "exits";die;
            $data = [
                //'type' => $request->type,
                'title' => $request->title,
                //'category' => $request->category,
                'description' => $request->description,
            ];

            $nearbyfacility = NearByFacility::where('id', $request->id)->update($data);

            if ($nearbyfacility) {
                DB::commit();
                return redirect()->route('admin.nearbyfacility.index')->with('success', trans('app.nearbyfacility_has_been_updated'));
            } else {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Delete
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request, nearbyfacility $nearbyfacility)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.nearbyfacility_is_not_found'), 'data' => null];

            if ($nearbyfacility) {
                $nearbyfacility->delete();
                $data['message'] = trans('app.nearbyfacility_has_been_deleted');
                $data['status'] = true;
                DB::commit();
            }

            return response()->json($data, 200);
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return response()->json(['status' => false, 'message' => trans('app.something_went_wrong'), 'data' => null], 400);
        }
    }

    /**
     * Exists
     *
     * @param  mixed $request
     * @return void
     */
    public function exists(Request $request)
    {
        try {
            $exists = NearByFacility::query()
                ->when(($request->has('title') && $request->title != ""), function ($query) use ($request) {
                    $query->where('title', $request->title);
                })
                ->when(($request->has('slug') && $request->slug != ""), function ($query) use ($request) {
                    $query->where('slug', $request->slug);
                })
                ->when(($request->has('id') && $request->id != ""), function ($query) use ($request) {
                    $query->where('id', '!=', $request->id);
                })
                ->first();

            if ($exists) {
                echo 'false';
            } else {
                echo 'true';
            }
        } catch (Throwable $e) {
            report($e);
            echo "false";
        }
        exit;
    }


    /**
     * Approve / Disapprove
     *
     * @param  mixed $request
     * @return void
     */
    public function approve(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.Nothing_to_change'), 'data' => null];

            if ($request->ajax()) {
                $nearbyfacility = NearByFacility::where('id', $request->id)->first();
                if ($nearbyfacility) {
                    if (($nearbyfacility->status == 0 || $nearbyfacility->status == 2) && $request->status == 1) {
                        // Approve blog
                        $nearbyfacility->status = 1;
                        $nearbyfacility->save();
                        $data['message'] = trans('app.Blog_has_been_approved_successfully');
                        $data['status'] = true;
                    } else if ($nearbyfacility->status == 1 && $request->status == 1) {
                        $data['message'] = trans('app.Blog_already_approved');
                    } else if (($nearbyfacility->status == 0 || $nearbyfacility->status == 1) && $request->status == 2) {
                        // Decline blog
                        $nearbyfacility->status = 2;
                        $nearbyfacility->save();
                        $data['message'] = trans('app.Blog_has_been_disapproved_successfully');
                        $data['status'] = true;
                    } else if ($nearbyfacility->status == 2 && $request->status == 2) {
                        $data['message'] = trans('app.Blog_already_declined');
                    }
                    DB::commit();
                } else {
                    $data['message'] = trans('app.Blog_is_not_found');
                }
            }
            return response()->json($data, 200);
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
            return response()->json(['error' => trans('app.something_went_wrong')], 400);
        }
    }
}
