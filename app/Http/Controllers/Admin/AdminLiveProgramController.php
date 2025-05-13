<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\LiveProgram;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminLiveProgramController extends Controller
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
            return view('admin.liveprogram.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }
    public function showLiveProgram()
    {
        // Fetch the travel guides for display


        // Fetch the schedule records (if needed)
        $liveProgram = LiveProgram::orderBy('event_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();


        return view('pages.liveProgram', compact('liveProgram'));
    }
    public function getAll()
    {
        // Set per_page to 2 (or dynamically from the request)
        $perPage = request()->get('per_page', 2); // Default to 2 items per page

        // Retrieve the current page from the request (defaults to 1)
        $page = request()->get('page', 1); // Default to page 1

        // Apply ordering and paginate results from LiveProgram model
        $paginated = \App\Models\LiveProgram::orderBy('id', 'desc') // Sort by latest first
            ->paginate($perPage, ['*'], 'page', $page);

        // Transform the collection as required
        $paginated->getCollection()->transform(function ($item) {
            $eventStart = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->event_date . ' ' . $item->start_time, 'Asia/Kolkata');

            $duration = $item->duration ?? 60;
            $eventEnd = (clone $eventStart)->addMinutes((int) $duration);

            $now = \Carbon\Carbon::now('Asia/Kolkata');

            $formattedEventDate = $eventStart->format('D d M');
            $formattedStartTime = $eventStart->format('g:i A');
            $formattedEndTime = $eventEnd->format('g:i A');

            if ($now->between($eventStart, $eventEnd)) {
                $status = 'Live';
            } elseif ($now->gt($eventEnd)) {
                $status = 'Already Done';
            } else {
                $status = 'Upcoming';
            }

            $data = $item->toArray();
            unset($data['created_at'], $data['updated_at'], $data['deleted_at'], $data['event_date'], $data['start_time']);

            return array_merge($data, [
                'EventDate' => $formattedEventDate,
                'EventStartTime' => $formattedStartTime,
                'EventEndTime' => $formattedEndTime,
                'status' => $status,
            ]);
        });

        // Return the paginated data in the response
        return response()->json([
            'success' => true,
            'data' => $paginated->items(),
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'per_page' => $paginated->perPage(),
            'total' => $paginated->total(),
        ]);
    }






    public function getRecords(Request $request)
    {
        try {
            $liveprogram = LiveProgram::query();

            return DataTables::of($liveprogram)
                ->addIndexColumn()

                // Human-readable category
                ->editColumn('category', function ($row) {
                    return $row->category == 1 ? 'Nauha' : ($row->category == 2 ? 'Majlis' : '—');
                })

                // Format event date
                ->editColumn('event_date', function ($row) {
                    return \Carbon\Carbon::parse($row->event_date)->format('D d M');
                })

                // Show start time (formatted)
                ->addColumn('start_time', function ($row) {
                    return \Carbon\Carbon::parse($row->start_time)->format('h:i A');
                })

                // Today's Date and Time in IST (Asia/Kolkata)
                ->addColumn('current_time', function ($row) {
                    return \Carbon\Carbon::now('Asia/Kolkata')->format('D d M, h:i A');
                })

                // Time until event starts or its current status, based on IST
                ->addColumn('time_until_start', function ($row) {
                    // Parse event date and start time in IST (Asia/Kolkata)
                    $start = \Carbon\Carbon::parse($row->event_date . ' ' . $row->start_time, 'Asia/Kolkata');
                    $now = \Carbon\Carbon::now('Asia/Kolkata');

                    // Calculate how many minutes until the event starts
                    $minutesUntilStart = $start->diffInMinutes($now);

                    // Check if the event is in the future
                    if ($start->gt($now)) {
                        // If the event is in the future, show how many minutes until it starts
                        return $start->diffForHumans($now, [
                            'parts' => 2,  // Only show 2 parts (e.g., "in 5 minutes")
                            'short' => true,
                        ]);
                    }

                    // If event has started, calculate end time based on duration
                    $duration = $row->duration;
                    $durationParts = explode(':', $duration);

                    if (count($durationParts) == 2) {
                        $hours = (int) $durationParts[0];
                        $minutes = (int) $durationParts[1];
                    } else {
                        $hours = 0;
                        $minutes = (int) $durationParts[0]; // Only minutes provided
                    }

                    // Calculate the event end time
                    $end = $start->copy()->addHours($hours)->addMinutes($minutes);

                    // Check if the event is still live (ongoing)
                    if ($now->between($start, $end)) {
                        // Event is live, show how much time is left
                        $remaining = $now->diffForHumans($end, [
                            'parts' => 2,  // Only show 2 parts (e.g., "5 minutes remaining")
                            'short' => true,
                        ]);
                        return '<span class="text-success">Live - ' . $remaining . ' remaining</span>';
                    }

                    // If event has ended
                    return '<span class="text-muted">Already Done</span>';
                })

                // Action buttons
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.liveprogram.edit', ['liveprogram' => $row->id]) . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>';
                    $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->id . '" title="Delete"><i class="uil-trash-alt"></i></a>';
                    return $btn;
                })

                ->rawColumns(['action', 'time_until_start', 'current_time']) // allow HTML
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
            return view('admin.liveprogram.add-liveprogram');
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
                    'title' => ['required', 'string', 'max:255', 'unique:live_program,title,NULL,id,deleted_at,NULL'],
                    //'category' =>'required',
                    'event_date' => 'required',
                    'start_time' => 'required',
                    'duration' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                //'type' => $request->type,
                'title' => $request->title,
                // 'category' => $request->category,
                'event_date' => $request->event_date,
                'start_time' => $request->start_time,
                'duration' => $request->duration,
                'video_url' => $request->video_url,
            ];

            $liveprogram = LiveProgram::create($data);
            if ($liveprogram) {
                DB::commit();
                return redirect()->route('admin.liveprogram.index')->with('success', trans('app.Liveprogram_has_been_added'));
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
    public function edit(Request $request, LiveProgram $liveprogram)
    {
        try {
            if (empty($liveprogram)) {
                return redirect()->route('admin.liveprogram.index')->with('error', trans('app.Liveprogram_is_not_found'));
            }

            return view('admin.liveprogram.add-liveprogram', compact('liveprogram'));
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
    public function update(Request $request, LiveProgram $liveprogram)
    {


        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required'],
                    'event_date' => 'required',
                    'start_time' => 'required',
                    'duration' => 'required',
                    'video_url' => 'required',

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
                'event_date' => $request->event_date,
                'start_time' => $request->start_time,
                'duration' => $request->duration,
                'video_url' => $request->video_url,
            ];

            $liveprogram = LiveProgram::where('id', $request->id)->update($data);

            if ($liveprogram) {
                DB::commit();
                return redirect()->route('admin.liveprogram.index')->with('success', trans('app.Liveprogram_has_been_updated'));
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
    public function destroy(Request $request, LiveProgram $liveprogram)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.Liveprogram_is_not_found'), 'data' => null];

            if ($liveprogram) {
                $liveprogram->delete();
                $data['message'] = trans('app.Liveprogram_has_been_deleted');
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
            $exists = LiveProgram::query()
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
                $LiveProgram = LiveProgram::where('id', $request->id)->first();
                if ($LiveProgram) {
                    if (($LiveProgram->status == 0 || $LiveProgram->status == 2) && $request->status == 1) {
                        // Approve blog
                        $LiveProgram->status = 1;
                        $LiveProgram->save();
                        $data['message'] = trans('app.Blog_has_been_approved_successfully');
                        $data['status'] = true;
                    } else if ($LiveProgram->status == 1 && $request->status == 1) {
                        $data['message'] = trans('app.Blog_already_approved');
                    } else if (($LiveProgram->status == 0 || $LiveProgram->status == 1) && $request->status == 2) {
                        // Decline blog
                        $LiveProgram->status = 2;
                        $LiveProgram->save();
                        $data['message'] = trans('app.Blog_has_been_disapproved_successfully');
                        $data['status'] = true;
                    } else if ($LiveProgram->status == 2 && $request->status == 2) {
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
