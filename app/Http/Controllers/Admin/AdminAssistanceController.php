<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Assistance;
use App\Helpers\Helper;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminAssistanceController extends Controller
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
            return view('admin.assistance.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }
    public function showassistance()
    {
        $settings = SystemSetting::find(1);
        $whatsApp_no = $settings->whatsApp_no;
        $safety_rules = $settings->safety_rules;
        // Return the view and pass the nearby facilities data to it
        return view('pages.assistance', compact('whatsApp_no', 'safety_rules'));
    }

    public function getAll(Request $request)
    {
        $type = $request->get('assistance_type');
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);

        $query = Assistance::query();

        if (!empty($type)) {
            $query->where('assistance_type', $type);
        }

        // Return emergency info if type is 2
        if ($type == 2) {
            $settings = SystemSetting::find(1);
            $data['whatsapp_helpline'] = $settings->whatsApp_no;
            $data['safety_rules'] = $settings->safety_rules;

            return response()->json([
                'success' => true,
                'message' => 'Assistance Emergency Info fetched successfully.',
                'data' => $data
            ]);
        }

        // Get paginated, descending records
        $assistances = $query->orderBy('id', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        // Transform data
        $data = $assistances->getCollection()->map(function ($item) use ($type) {
            $assistance = $item->toArray();
            unset($assistance['created_at'], $assistance['updated_at'], $assistance['deleted_at']);

            if ($type == 3) {
                unset($assistance['image_url']);
            }

            if ($type == 1) {
                unset($assistance['image'], $assistance['image_url']);
            }

            return $assistance;
        });

        // Apply transformed data to paginator
        $assistances->setCollection($data);

        return response()->json([
            'success' => true,
            'message' => 'Assistance records fetched successfully.',
            'data' => $assistances->items(),
            'current_page' => $assistances->currentPage(),
            'last_page' => $assistances->lastPage(),
            'per_page' => $assistances->perPage(),
            'total' => $assistances->total(),
        ]);
    }

    public function getRecords(Request $request)
    {
        try {
            $assistance = Assistance::orderBy('id', 'desc');
            return DataTables::of($assistance)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.assistance.edit', ['assistance' => $row->id]) . '"  data-id="' . $row->id . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>&nbsp;';
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
            return view('admin.assistance.add-assistance');
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

            $type = $request->input('assistance_type');

            $rules = [
                'assistance_type' => ['required'],
            ];

            if ($type == '1') {
                $rules['full_name'] = ['required', 'string', 'max:255'];
                $rules['contact_number'] = ['required'];
                $rules['description'] = ['required'];
            }

            // if ($type == '2') {
            //     $rules['whatsapp_no'] = ['required'];
            //     $rules['safety_rules'] = ['required'];
            // }

            if ($type == '3') {
                $rules['full_name'] = ['required', 'string', 'max:255'];
                $rules['contact_number'] = ['required'];
                $rules['description'] = ['required'];
                $rules['image'] = ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Process description (CKEditor) and image upload
            $description = null;
            if (!empty($request->description)) {
                $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));
            }

            // $safety_rules = null;
            // if (!empty($request->safety_rules)) {
            //     $safety_rules = Helper::replaceImagePath($request->safety_rules, config('constant.cms_page_url'));
            // }
            $assistance_image = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $assistance_image = "Img-" . date('YmdHis') . mt_rand(1, 100) . '.' . $image->getClientOriginalExtension();
                Helper::uploadFile($image, config('constant.assistance_url'), $assistance_image);
            }

            $data = [
                'full_name'        => $request->input('full_name'),
                'description'      => $description,
                'image'            => $assistance_image,
                'contact_number'   => $request->contact_number,
                'assistance_type'  => $type,
                // 'whatsapp_no'      => $request->whatsapp_no,
                // 'safety_rules'     => $safety_rules,
            ];


            $assistance = Assistance::create($data);

            if ($assistance) {
                DB::commit();
                return redirect()->route('admin.assistance.index')->with('success', trans('app.assistance_has_been_added'));
            } else {
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }


    public function store_web(Request $request)
    {

        try {
            DB::beginTransaction();

            $type = $request->input('assistance_type');

            $rules = [
                'assistance_type' => ['required'],
            ];

            if ($type == '1') {
                $rules['full_name'] = ['required', 'string', 'max:255'];
                $rules['contact_number'] = ['required'];
                $rules['description'] = ['required'];
            }

            // if ($type == '2') {
            //     $rules['whatsapp_no'] = ['required'];
            //     $rules['safety_rules'] = ['required'];
            // }

            if ($type == '3') {
                $rules['full_name'] = ['required', 'string', 'max:255'];
                $rules['contact_number'] = ['required'];
                $rules['description'] = ['required'];
                // $rules['image'] = ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Process description (CKEditor) and image upload
            $description = null;
            if (!empty($request->description)) {
                $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));
            }

            // $safety_rules = null;
            // if (!empty($request->safety_rules)) {
            //     $safety_rules = Helper::replaceImagePath($request->safety_rules, config('constant.cms_page_url'));
            // }
            $assistance_image = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $assistance_image = "Img-" . date('YmdHis') . mt_rand(1, 100) . '.' . $image->getClientOriginalExtension();
                Helper::uploadFile($image, config('constant.assistance_url'), $assistance_image);
            }

            $data = [
                'full_name'        => $request->input('full_name'),
                'description'      => $description,
                'image'            => $assistance_image,
                'contact_number'   => $request->contact_number,
                'assistance_type'  => $type,
                // 'whatsapp_no'      => $request->whatsapp_no,
                // 'safety_rules'     => $safety_rules,
            ];
            $assistance = Assistance::create($data);
            if ($assistance) {
                DB::commit();
                return redirect()->route('assistance_web')->with('success', trans('app.assistance_has_been_added'));
            } else {
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function store_api(Request $request)
    {

        try {
            DB::beginTransaction();

            //$type = $request->input('assistance_type');
            $type = $request->input('assistance_type');

            if (!$type) {
                return response()->json([
                    'success' => false,
                    'message' => 'Assistance type is required.'
                ], 422);
            }
            if ($type == '1') {

                $rules['full_name'] = ['required'];
                $rules['contact_number'] = ['required'];
                $rules['description'] = ['required'];
            }

            // if ($type == '2') {
            //     $rules['whatsapp_no'] = ['required'];
            //     $rules['safety_rules'] = ['required'];
            // }

            if ($type == '3') {
                $rules['full_name'] = ['required', 'string', 'max:255'];
                $rules['contact_number'] = ['required'];
                $rules['description'] = ['required'];
                $rules['image'] = ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'];
            }

            $validator = Validator::make($request->all(), $rules);


            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Process description (CKEditor) and image upload
            $description = null;
            if (!empty($request->description)) {
                $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));
            }

            // $safety_rules = null;
            // if (!empty($request->safety_rules)) {
            //     $safety_rules = Helper::replaceImagePath($request->safety_rules, config('constant.cms_page_url'));
            // }
            $assistance_image = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $assistance_image = "Img-" . date('YmdHis') . mt_rand(1, 100) . '.' . $image->getClientOriginalExtension();


                Helper::uploadFile($image, config('constant.assistance_url'), $assistance_image);
            }

            $data = [
                'full_name'        => $request->input('full_name'),
                'description'      => $description,
                'image'            => $assistance_image,
                'contact_number'   => $request->contact_number,
                'assistance_type'  => $type,
                // 'whatsapp_no'      => $request->whatsapp_no,
                // 'safety_rules'     => $safety_rules,
            ];

            $assistance = Assistance::create($data);

            if ($assistance) {
                DB::commit();
                $data = $assistance->toArray();

                // Unset common fields
                unset($data['created_at'], $data['updated_at']);

                // If assistance_type is 2, hide the 'image_url' field
                if ($type == 1) {
                    unset($data['image'], $data['image_url']);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Assistance registered successfully.',
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(Request $request, assistance $assistance)
    {
        try {
            if (empty($assistance)) {
                return redirect()->route('admin.assistance.index')->with('error', trans('app.assistance_is_not_found'));
            }

            return view('admin.assistance.add-assistance', compact('assistance'));
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
    public function update(Request $request, Assistance $assistance)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make(
                $request->all(),
                [
                    'full_name' => ['required', 'string', 'max:255'],
                    'assistance_type' => 'required',
                    'description' => 'required',
                    'image' => [
                        'nullable',
                        'image',
                        'mimes:jpeg,jpg,png,webp',
                        'max:2048',
                        function ($attribute, $value, $fail) use ($request) {
                            if (
                                $request->assistance_type == 3 &&
                                !$request->hasFile('image') &&
                                empty($request->old_image)
                            ) {
                                $fail('The image field is required for Lost and Found.');
                            }
                        },
                    ]
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));

            $assistance_image = $assistance->image; // Default to current image

            // Handle image upload if new one is provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $assistance_image = "Img-" . date('YmdHis') . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                Helper::uploadFile($image, config('constant.assistance_url'), $assistance_image, $request->old_image);
            }

            $data = [
                'full_name' => $request->full_name,
                'description' => $description,
                'contact_number' => $request->contact_number,
                'assistance_type' => $request->assistance_type,
            ];

            if ($assistance_image) {
                $data['image'] = $assistance_image;
            }

            $update = Assistance::where('id', $request->id)->update($data);

            if ($update) {
                DB::commit();
                return redirect()->route('admin.assistance.index')->with('success', trans('app.assistance_has_been_updated'));
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
    public function destroy(Request $request, assistance $assistance)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.assistance_is_not_found'), 'data' => null];

            if ($assistance) {
                Helper::deleteFile(config('constant.assistance_url'), $assistance->image);
                $assistance->delete();

                $data['message'] = trans('app.assistance_has_been_deleted');
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
            $exists = assistance::query()
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
                $assistance = assistance::where('id', $request->id)->first();
                if ($assistance) {
                    if (($assistance->status == 0 || $assistance->status == 2) && $request->status == 1) {
                        // Approve assistance
                        $assistance->status = 1;
                        $assistance->save();
                        $data['message'] = trans('app.assistance_has_been_approved_successfully');
                        $data['status'] = true;
                    } else if ($assistance->status == 1 && $request->status == 1) {
                        $data['message'] = trans('app.assistance_already_approved');
                    } else if (($assistance->status == 0 || $assistance->status == 1) && $request->status == 2) {
                        // Decline assistance
                        $assistance->status = 2;
                        $assistance->save();
                        $data['message'] = trans('app.assistance_has_been_disapproved_successfully');
                        $data['status'] = true;
                    } else if ($assistance->status == 2 && $request->status == 2) {
                        $data['message'] = trans('app.assistance_already_declined');
                    }
                    DB::commit();
                } else {
                    $data['message'] = trans('app.assistance_is_not_found');
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
