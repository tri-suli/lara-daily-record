<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Models\DailyRecord;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::select([
            'uuid', 'name', 'gender', 'age', 'created_at'
        ])
            ->limit($request->get('limit', 10))
            ->skip(10 * $request->get('page', 1))
            ->paginate($request->get('limit', 10));
        $totalUsers = User::all('uuid')->count();

        $dailyRecords = DailyRecord::all();

        return view('welcome', compact('users', 'totalUsers', 'dailyRecords'));
    }

    public function destroy(string $uuid)
    {
        try {
            $today = now()->format('Y-m-d');
            $user = User::where('uuid', $uuid)->first();
            $isUserDeleted = $user->delete();
            $dailyRecord = DailyRecord::where('date', $today)->first();
            if ($isUserDeleted && $dailyRecord) {
                if ($user->gender === Gender::MALE->value) {
                    $dailyRecord->update(['male_count' => $dailyRecord->male_count - 1]);
                } else {
                    $dailyRecord->update(['female_count' => $dailyRecord->female_count - 1]);
                }
            }

            return redirect()->back();
        } catch (QueryException $e) {
            abort(404, 'user not found');
        }
    }
}
