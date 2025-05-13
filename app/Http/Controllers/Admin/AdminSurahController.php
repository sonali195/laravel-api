<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Surah;
use App\Models\Ayat;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminSurahController extends Controller
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
        if ($request->ajax()) {
            $data = Surah::select(['id', 'title_en', 'title_ar', 'description', 'total_number'])
                ->orderBy('id', 'asc');

            return DataTables::of($data)
                ->addIndexColumn() // adds DT_RowIndex (used only for display)
                ->addColumn('action', function ($row) {
                    return '<a href="#">Edit</a>';
                })
                ->orderColumn('id', function ($query, $order) {
                    $query->orderBy('id', $order);
                })
                ->rawColumns(['action']) // keeps HTML in action
                ->make(true);
        }

        return view('admin.surah.index');
    }

    public function showquran()
    {
        // Get all Surahs with their related Ayats
        $schedules = Surah::with('ayats')->get();

        return view('pages.quran', compact('schedules'));
    }


    public function getAll(Request $request)
    {
        // Get per_page and page from the request body (with defaults)
        $perPage = $request->input('per_page', 5); // default 5 per page
        $page = $request->input('page', 1);        // default page 1

        // Fetch paginated Surah records
        $surahs = Surah::paginate($perPage, ['*'], 'page', $page);

        // Remove timestamps from each item
        $surahs->getCollection()->transform(function ($item) {
            $data = $item->toArray();
            unset($data['created_at'], $data['updated_at'], $data['deleted_at']);
            return $data;
        });

        // Return response
        return response()->json([
            'success' => true,
            'data' => $surahs->items(),
            'current_page' => $surahs->currentPage(),
            'last_page' => $surahs->lastPage(),
            'per_page' => $surahs->perPage(),
            'total' => $surahs->total(),
        ]);
    }

    public function getRecords(Request $request)
    {
        try {
            $assistance = Surah::orderBy('id', 'desc');
            return DataTables::of($assistance)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.surah.edit', ['surah' => $row->id]) . '"  data-id="' . $row->id . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>&nbsp;';
                    $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->id . '" title="Delete"><i class="uil-trash-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (Throwable $e) {
            report($e);
            return response()->json()->with('error', trans('app.something_went_wrong'));
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
            return view('admin.surah.add-surah');
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
                    'title_en' => ['required', 'string', 'max:255', 'unique:surahs_quran,title_en,NULL,id,deleted_at,NULL'],
                    'title_ar' => ['required', 'string', 'max:255'],
                    'description' => 'required',
                    'total_number' => 'required',
                ]
            );

            if ($validator->fails()) {
                echo "not valid";
                die;
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));
            $data = [
                //'type' => $request->type,
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'description' => $description,
                'total_number' => $request->total_number,
            ];
            $Surah = Surah::create($data);
            if ($Surah) {
                DB::commit();
                return redirect()->route('admin.surah.index')->with('success', trans('app.surah_has_been_added'));
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
    public function edit(Request $request, Surah $surah)
    {
        try {
            if (empty($surah)) {
                return redirect()->route('admin.surah.index')->with('error', trans('app.surah_is_not_found'));
            }

            return view('admin.surah.add-surah', compact('surah'));
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
    public function update(Request $request, Surah $Surah)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make(
                $request->all(),
                [
                    'title_en' => ['required', 'string', 'max:255'],
                    'title_ar' => ['required', 'string', 'max:255'],
                    'description' => 'required',
                    'total_number' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));

            $data = [
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'description' => $description,
                'total_number' => $request->total_number,
            ];



            $update = Surah::where('id', $request->id)->update($data);

            if ($update) {
                DB::commit();
                return redirect()->route('admin.surah.index')->with('success', trans('app.surah_has_been_updated'));
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
    public function destroy(Request $request, Surah $Surah)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.surah_is_not_found'), 'data' => null];

            if ($Surah) {
                $Surah->delete();

                $data['message'] = trans('app.surah_has_been_deleted');
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
            $exists = Surah::query()
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
                $assistance = Surah::where('id', $request->id)->first();
                if ($assistance) {
                    if (($assistance->status == 0 || $assistance->status == 2) && $request->status == 1) {
                        // Approve assistance
                        $assistance->status = 1;
                        $assistance->save();
                        $data['message'] = trans('app.surah_has_been_approved_successfully');
                        $data['status'] = true;
                    } else if ($assistance->status == 1 && $request->status == 1) {
                        $data['message'] = trans('app.surah_already_approved');
                    } else if (($assistance->status == 0 || $assistance->status == 1) && $request->status == 2) {
                        // Decline assistance
                        $assistance->status = 2;
                        $assistance->save();
                        $data['message'] = trans('app.surah_has_been_disapproved_successfully');
                        $data['status'] = true;
                    } else if ($assistance->status == 2 && $request->status == 2) {
                        $data['message'] = trans('app.surah_already_declined');
                    }
                    DB::commit();
                } else {
                    $data['message'] = trans('app.surah_is_not_found');
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
