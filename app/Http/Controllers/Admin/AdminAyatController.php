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

class AdminAyatController extends Controller
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


    public function index(Request $request, Surah $surah)
    {
        if ($request->ajax()) {
            $data = $surah->ayats()->select(['id', 'title_ar', 'title_translation', 'title_transliteration'])->orderBy('id', 'asc');

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($surah) {
                    $editUrl = route('admin.surah.ayat.edit', ['surah' => $surah->id, 'ayat' => $row->id]);
                    $deleteUrl = route('admin.surah.ayat.destroy', ['surah' => $surah->id, 'ayat' => $row->id]);
                    return '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                            <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.ayat.index', compact('surah'));
    }



    public function getAyahs($surahId)
    {
        // Fetch the Ayahs for the selected Surah from the database
        $ayahs = Ayat::where('surah_id', $surahId)->get();

        // Return the Ayahs as JSON
        return response()->json(['ayahs' => $ayahs]);
    }

    public function getAll($surahId)
    {
        // Set the per page value
        $perPage = request()->has('per_page') ? request()->get('per_page') : 5; // Default per page is 5

        // Fetch all Ayat for the given Surah ID and paginate
        $ayatRecords = Ayat::where('surah_id', $surahId)->paginate($perPage);

        // Get the Surah details (name, Arabic title, and description) for the given Surah ID
        $surahDetails = Surah::where('id', $surahId)->first();

        // If the Surah exists, fetch the title, otherwise set as empty
        $surahTitleEn = $surahDetails ? $surahDetails->title_en : '';
        $surahTitleAr = $surahDetails ? $surahDetails->title_ar : '';
        $surahTotalNumber = $surahDetails ? $surahDetails->total_number : '';
        $surahDescription = $surahDetails ? $surahDetails->description : '';

        // Exclude timestamps and return custom data
        $ayatRecords->getCollection()->transform(function ($item) use ($surahTitleEn, $surahTitleAr, $surahDescription, $surahTotalNumber) {
            $data = $item->toArray();
            unset($data['created_at'], $data['updated_at'], $data['deleted_at']); // Remove timestamps
            $data['surah_title_en'] = $surahTitleEn; // Add surah_title_en to the record with prefix
            $data['surah_title_ar'] = $surahTitleAr; // Add surah_title_ar to the record with prefix
            $data['surah_total_number'] = $surahTotalNumber;
            $data['surah_description'] = $surahDescription; // Add surah_description to the record with prefix
            $data['ayahs_title_ar'] = $item->title_ar; // Change title_ar to ayahs_title_ar
            $data['ayahs_title_translation'] = $item->title_translation; // Change title_translation to ayahs_title_translation
            $data['ayahs_title_transliteration'] = $item->title_transliteration; // Change title_transliteration to ayahs_title_transliteration
            unset($data['title_ar'], $data['title_translation'], $data['title_transliteration']);
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $ayatRecords->items(),
            'current_page' => $ayatRecords->currentPage(),
            'last_page' => $ayatRecords->lastPage(),
            'per_page' => $ayatRecords->perPage(),
            'total' => $ayatRecords->total(),
        ]);
    }
    public function getBySurah(Request $request)
    {
        // Get inputs from request
        $surahId = $request->input('surah_id');
        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);

        // Validate surah_id
        if (!$surahId) {
            return response()->json([
                'success' => false,
                'message' => 'surah_id is required.'
            ], 422);
        }

        // Get Ayat where surah_id = given ID
        $ayat = Ayat::where('surah_id', $surahId)->paginate($perPage, ['*'], 'page', $page);

        // Clean up data
        $ayat->getCollection()->transform(function ($item) {
            $data = $item->toArray();
            unset($data['created_at'], $data['updated_at'], $data['deleted_at']);
            return $data;
        });

        // Return API response
        return response()->json([
            'success' => true,
            'data' => $ayat->items(),
            'current_page' => $ayat->currentPage(),
            'last_page' => $ayat->lastPage(),
            'per_page' => $ayat->perPage(),
            'total' => $ayat->total(),
        ]);
    }



    public function getRecords(Request $request)
    {
        try {
            // Eager load the 'surah' relation to get the Surah name based on 'surah_id'
            $assistance = Ayat::with('surah') // Eager load 'surah' relationship
                ->orderBy('id', 'desc');

            return DataTables::of($assistance)
                ->addIndexColumn()
                ->addColumn('surah_name', function ($row) {
                    // Access the 'title_en' from the related Surah model
                    return $row->surah ? $row->surah->title_en : 'No Surah';  // Return the Surah name or 'No Surah' if not found
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.ayat.edit', ['ayat' => $row->id]) . '" data-id="' . $row->id . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>&nbsp;';
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

    public function create()
    {
        $surahs = Surah::all();
        return view('admin.ayat.add-ayat', compact('surahs'));
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
                    'surah_id' => 'required|exists:surahs_quran,id',
                    'title_ar' => 'required|string|max:255',
                    'title_translation' => 'nullable|string|max:255',
                    'title_transliteration' => 'nullable|string|max:255',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                //'type' => $request->type,
                'surah_id' => $request->surah_id,
                'title_ar' => $request->title_ar,
                'title_translation' => $request->title_translation,
                'title_transliteration' => $request->title_transliteration,
            ];
            $Ayat = Ayat::create($data);
            if ($Ayat) {
                DB::commit();
                return redirect()->route('admin.ayat.index')->with('success', trans('app.ayat_has_been_added'));
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
    public function edit(Request $request, Surah $surah, Ayat $ayat)
    {
        $surahs = Surah::all();
        try {
            if (empty($surah)) {
                return redirect()->route('admin.ayat.index')->with('error', trans('app.surah_is_not_found'));
            }

            return view('admin.ayat.add-ayat', compact('surah', 'ayat', 'surahs'));
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
    public function update(Request $request, Surah $surah, Ayat $ayat)
    {
        // Validate the input fields including surah_id
        $validator = Validator::make($request->all(), [
            'surah_id' => 'required|exists:surahs_quran,id', // Ensure the surah_id exists in the 'surahs' table
            'title_ar' => 'required|string|max:255',
            'title_translation' => 'nullable|string|max:255',
            'title_transliteration' => 'nullable|string|max:255',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Update the Ayat, including the surah_id
            $ayat->update($request->only(['surah_id', 'title_ar', 'title_translation', 'title_transliteration']));

            DB::commit();

            // Redirect to the ayat index page for this surah with success message
            return redirect()->route('admin.ayat.index')->with('success', trans('app.ayat_has_been_updated'));
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->with('error', 'Something went wrong.')->withInput();
        }
    }



    /**
     * Delete
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request, Surah $surah, Ayat $ayat)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.ayat_is_not_found'), 'data' => null];

            if ($ayat) {
                $ayat->delete();

                $data['message'] = trans('app.ayat_has_been_deleted');
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
