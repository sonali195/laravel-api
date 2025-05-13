<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\TravelGuide;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminTravelGuideController extends Controller
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
            return view('admin.travelguide.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    public function web()
    {
        $types = [
            'ziyarat' => 1,
            'dua'     => 2,
            'amaal'   => 3,
        ];

        $data = [];

        foreach ($types as $key => $typeId) {
            $items = \App\Models\TravelGuide::where('type', $typeId)->get();

            // Remove <pre> tags from descriptions
            foreach ($items as $item) {
                $item->description_english = strip_tags($item->description_english, '<pre><b><i><ul><ol><li>');
                $item->description_gujarati = strip_tags($item->description_gujarati, '<pre><b><i><ul><ol><li>');
                $item->description_urdu = strip_tags($item->description_urdu, '<pre><b><i><ul><ol><li>');
                $item->description_gujarati = strip_tags($item->description_gujarati, '<pre><b><i><ul><ol><li>');
            }

            if ($items->isNotEmpty()) {
                $data[$key] = $items;
            }
        }
        return view('pages.travelguide', compact('data'));
    }


    public function getTravelGuideData()
    {
        // Map string keys to DB type numbers
        $map = [
            'ziyarat' => 1,
            'dua'     => 2,
            'amaal'   => 3,
        ];

        $data = [];

        foreach ($map as $key => $type) {
            $data[$key] = TravelGuide::where('type', $type)->get();
        }

        return response()->json($data);
    }


    public function getAll()
    {
        $perPage = request()->get('per_page', 5);
        $page = request()->get('page', 1); // Get page from query string
        $type = request()->get('type');

        $query = TravelGuide::query();

        // Apply type filter if provided
        if (!empty($type)) {
            $query->where('type', $type);
        }

        // Order by descending
        $query->orderBy('id', 'desc'); // or use created_at if preferred

        // Paginate with per_page and page
        $guides = $query->paginate($perPage, ['*'], 'page', $page);

        $guides->getCollection()->transform(function ($item) {
            $typeName = match ($item->type) {
                1 => 'Ziyarat',
                2 => 'Dua',
                3 => "A'maal",
                default => 'Unknown',
            };

            $data = $item->toArray();

            // Insert category_name after type
            $position = array_search('type', array_keys($data));
            $data = array_slice($data, 0, $position + 1, true) +
                ['category_name' => $typeName] +
                array_slice($data, $position + 1, null, true);

            unset($data['created_at'], $data['updated_at'], $data['deleted_at']);

            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $guides->items(),
            'current_page' => $guides->currentPage(),
            'last_page' => $guides->lastPage(),
            'per_page' => $guides->perPage(),
            'total' => $guides->total(),
        ]);
    }


    public function getRecords(Request $request)
    {
        try {
            $travelGuide = TravelGuide::query();

            return DataTables::of($travelGuide)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    $types = [1 => 'Ziyarat', 2 => 'Dua', 3 => "A'maal"];
                    return $types[$row->type] ?? 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.travelguide.edit', ['travelguide' => $row->id]) . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>';
                    $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->id . '" title="Delete"><i class="uil-trash-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
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
            return view('admin.travelguide.add-travelguide');
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
                    'title' => ['required', 'string', 'max:255', 'unique:travel_guides,title,NULL,id,deleted_at,NULL'],
                    // 'slug' => ['nullable', 'string', 'unique:travel_guides,slug,NULL,id,deleted_at,NULL'],
                    'description_english' => 'required',
                    'description_urdu' => 'required',
                    'description_gujarati' => 'required',
                    'description_arbian' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $description_english = Helper::replaceImagePath($request->description_english, config('constant.cms_page_url'));
            $description_urdu = Helper::replaceImagePath($request->description_urdu, config('constant.cms_page_url'));
            $description_gujarati = Helper::replaceImagePath($request->description_gujarati, config('constant.cms_page_url'));
            $description_arbian = Helper::replaceImagePath($request->description_arbian, config('constant.cms_page_url'));
            $data = [
                'type' => $request->type,
                'title' => $request->title,
                'description_english' => $description_english,
                'description_urdu' => $description_urdu,
                'description_gujarati' => $description_gujarati,
                'description_arbian' => $description_arbian,
                //'slug' => $request->slug,
                //'time_spend' => $request->time_spend,
                //'meta_title' => $request->meta_title,
                //'meta_desc' => $request->meta_desc,
            ];

            $travelguide = TravelGuide::create($data);
            if ($travelguide) {
                DB::commit();
                return redirect()->route('admin.travelguide.index')->with('success', trans('app.Travelguide_has_been_added'));
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
    public function edit(Request $request, TravelGuide $travelguide)
    {
        try {
            if (empty($travelguide)) {
                return redirect()->route('admin.travelguide.index')->with('error', trans('app.Travelguide_is_not_found'));
            }

            return view('admin.travelguide.add-travelguide', compact('travelguide'));
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
    public function update(Request $request, TravelGuide $travelguide)
    {

        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'type' => ['required', 'string', 'max:5'],
                    'title' => ['required', 'string', 'max:255'],
                    'description_english' => 'required',
                    'description_urdu' => 'required',
                    'description_gujarati' => 'required',
                    'description_arbian' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $description_english = Helper::replaceImagePath($request->description_english, config('constant.cms_page_url'));
            $description_urdu = Helper::replaceImagePath($request->description_urdu, config('constant.cms_page_url'));
            $description_gujarati = Helper::replaceImagePath($request->description_gujarati, config('constant.cms_page_url'));
            $description_arbian = Helper::replaceImagePath($request->description_arbian, config('constant.cms_page_url'));
            $data = [
                'type' => $request->type,
                'title' => $request->title,
                'description_english' => $description_english,
                'description_urdu' => $description_urdu,
                'description_gujarati' => $description_gujarati,
                'description_arbian' => $description_arbian,
            ];


            $travelguide = TravelGuide::where('id', $request->id)->update($data);

            if ($travelguide) {
                DB::commit();
                return redirect()->route('admin.travelguide.index')->with('success', trans('app.Travelguide_has_been_updated'));
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
    public function destroy(Request $request, Travelguide $travelguide)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.Travelguide_is_not_found'), 'data' => null];

            if ($travelguide) {
                $travelguide->delete();
                $data['message'] = trans('app.Travelguide_has_been_deleted');
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
            $exists = Travelguide::query()
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
                $travelguide = Travelguide::where('id', $request->id)->first();
                if ($travelguide) {
                    if (($travelguide->status == 0 || $travelguide->status == 2) && $request->status == 1) {
                        // Approve blog
                        $travelguide->status = 1;
                        $travelguide->save();
                        $data['message'] = trans('app.Blog_has_been_approved_successfully');
                        $data['status'] = true;
                    } else if ($travelguide->status == 1 && $request->status == 1) {
                        $data['message'] = trans('app.Blog_already_approved');
                    } else if (($travelguide->status == 0 || $travelguide->status == 1) && $request->status == 2) {
                        // Decline blog
                        $travelguide->status = 2;
                        $travelguide->save();
                        $data['message'] = trans('app.Blog_has_been_disapproved_successfully');
                        $data['status'] = true;
                    } else if ($travelguide->status == 2 && $request->status == 2) {
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
