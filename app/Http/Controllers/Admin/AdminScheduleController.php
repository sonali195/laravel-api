<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Schedule;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminScheduleController extends Controller
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
            return view('admin.schedule.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    public function getAll()
    {
        $perPage = request()->has('per_page') ? request()->get('per_page') : 5;

        $paginated = \App\Models\Schedule::paginate($perPage);

        $now = \Carbon\Carbon::now();

        $transformed = $paginated->getCollection()->transform(function ($item) use ($now) {
            $eventDate = \Carbon\Carbon::parse($item->event_date);
            $startTime = \Carbon\Carbon::parse($item->event_date . ' ' . $item->start_time);
            $endTime = \Carbon\Carbon::parse($item->event_date . ' ' . $item->end_time);

            $formattedEventDate = $eventDate->format('D d M Y');
            $formattedStartTime = $startTime->format('g:i A');
            $formattedEndTime = $endTime->format('g:i A');

            $categoryName = match ((int) $item->category) {
                1 => 'Nauha',
                2 => 'Majlis',
                default => 'Unknown',
            };

            $data = $item->toArray();
            unset($data['created_at'], $data['updated_at'], $data['deleted_at'], $data['category'], $data['start_time'], $data['end_time']);

            // Calculate time status
            if ($now->lt($startTime)) {
                $hoursRemaining = round($now->diffInMinutes($startTime) / 60, 1);
                $status = 'Upcoming';
                $timeStatus = "Event starts in {$hoursRemaining} hour(s)";
            } else {
                $hoursAgo = round($endTime->diffInMinutes($now) / 60, 1);
                $status = 'Done';
                $timeStatus = "Event ended {$hoursAgo} hour(s) ago";
            }

            return array_merge($data, [
                'category_name' => $categoryName,
                'event_date_formatted' => $formattedEventDate,
                'event_start_time' => $formattedStartTime,
                'event_end_time' => $formattedEndTime,
                'status' => $status,
                'time_status' => $timeStatus,
            ]);
        });

        $groupedByDate = $transformed->groupBy('event_date_formatted')->map(function ($items) {
            return $items->values();
        });

        return response()->json([
            'success' => true,
            'data' => $groupedByDate,
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'per_page' => $paginated->perPage(),
            'total' => $paginated->total(),
        ]);
    }

    public function showSchedule()
    {
        // Fetch the travel guides for display


        // Fetch the schedule records (if needed)
        $schedules = Schedule::orderBy('event_date')
            ->orderBy('start_time')
            ->get();


        return view('pages.schedules', compact('schedules'));
    }




    public function getRecords(Request $request)
    {
        try {
            $Schedule = Schedule::query();

            return DataTables::of($Schedule)
                ->addIndexColumn()
                ->editColumn('category', function ($row) {
                    return $row->category == 1 ? 'Nauha' : ($row->category == 2 ? 'Majlis' : '—');
                })
                ->editColumn('event_date', function ($row) {
                    return \Carbon\Carbon::parse($row->event_date)->format('D d M');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.schedule.edit', ['schedule' => $row->id]) . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>';
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
            return view('admin.schedule.add-Schedule');
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
                    'title' => ['required', 'string', 'max:255'],
                    'category' => 'required',
                    'event_date' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                //'type' => $request->type,
                'title' => $request->title,
                'category' => $request->category,
                'event_date' => $request->event_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ];

            $Schedule = Schedule::create($data);
            if ($Schedule) {
                DB::commit();
                return redirect()->route('admin.schedule.index')->with('success', trans('app.Schedule_has_been_added'));
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
    public function edit(Request $request, Schedule $schedule)
    {
        try {
            if (empty($schedule)) {
                return redirect()->route('admin.schedule.index')->with('error', trans('app.Schedule_is_not_found'));
            }

            return view('admin.schedule.add-Schedule', compact('schedule'));
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
    public function update(Request $request, Schedule $schedule)
    {

        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required'],
                    'category' => 'required',
                    'event_date' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $data = [
                //'type' => $request->type,
                'title' => $request->title,
                'category' => $request->category,
                'event_date' => $request->event_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ];
            $Schedule = Schedule::where('id', $request->id)->update($data);

            if ($Schedule) {
                DB::commit();
                return redirect()->route('admin.schedule.index')->with('success', trans('app.Schedule_has_been_updated'));
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
    public function destroy(Request $request, Schedule $schedule)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.Schedule_is_not_found'), 'data' => null];

            if ($schedule) {
                $schedule->delete();
                $data['message'] = trans('app.Schedule_has_been_deleted');
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
            $exists = Schedule::query()
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
                $Schedule = Schedule::where('id', $request->id)->first();
                if ($Schedule) {
                    if (($Schedule->status == 0 || $Schedule->status == 2) && $request->status == 1) {
                        // Approve blog
                        $Schedule->status = 1;
                        $Schedule->save();
                        $data['message'] = trans('app.Blog_has_been_approved_successfully');
                        $data['status'] = true;
                    } else if ($Schedule->status == 1 && $request->status == 1) {
                        $data['message'] = trans('app.Blog_already_approved');
                    } else if (($Schedule->status == 0 || $Schedule->status == 1) && $request->status == 2) {
                        // Decline blog
                        $Schedule->status = 2;
                        $Schedule->save();
                        $data['message'] = trans('app.Blog_has_been_disapproved_successfully');
                        $data['status'] = true;
                    } else if ($Schedule->status == 2 && $request->status == 2) {
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
