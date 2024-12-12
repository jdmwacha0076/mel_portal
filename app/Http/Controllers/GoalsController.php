<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalsController extends Controller
{
    // For adding up a new goal
    public function addGoal()
    {
        return view('goals.add-goals');
    }

    //For saving a new goal
    public function saveGoal(Request $request)
    {
        $validated = $request->validate([
            'goal_name' => 'required|string|max:255',
            'goal_description' => 'nullable|string',
        ]);

        try {
            Goal::create([
                'goal_name' => $validated['goal_name'],
                'goal_description' => $validated['goal_description'],
                'goal_created_by_user_id' => Auth::id()
            ]);

            return redirect()->back()->with('success', 'Goal has been successfully created.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the goal. Please try again.');
        }
    }

    //For viewing goals
    public function viewGoals()
    {
        $goals = Goal::all();

        return view('goals.view-goals', compact('goals'));
    }

    //For updating the goal details
    public function updateGoalDetails(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'goal_name' => 'required|string|max:255',
                'goal_description' => 'nullable|string',
            ]);

            $goal = Goal::findOrFail($id);
            $goal->goal_name = $request->input('goal_name');
            $goal->goal_description = $request->input('goal_description');
            $goal->save();

            return redirect()->back()->with('success', 'Goal has been successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the goal. Please try again.');
        }
    }

    //For deleting a goal
    public function deleteGoal($id)
    {
        try {
            $goal = Goal::findOrFail($id);

            $goal->objectives()->delete();

            $goal->delete();

            return redirect()->route('view.goals')->with('success', 'Goal and its objectives have been deleted.');
        } catch (\Exception $e) {
            return redirect()->route('view.goals')->with('error', 'An error occurred while deleting the goal. Please try again.');
        }
    }













    public function viewGoalObjectives($id)
    {
        // Fetch the goal along with its objectives by ID
        $goal = Goal::with('objectives')->findOrFail($id);

        return view('goals.view-goal-objectives', compact('goal'));
    }
}
