<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Objective;
use Illuminate\Support\Facades\Auth;


class ObjectivesController extends Controller
{
    // For adding up an objective
    public function addObjective()
    {
        $goals = Goal::all(['id', 'goal_name']);
        return view('objectives.add-objective', compact('goals'));
    }

    //For saving an objective
    public function saveObjective(Request $request)
    {
        $validatedData = $request->validate([
            'goal_id' => 'required|exists:goals,id',
            'objective_name' => 'required|array|min:1',
            'objective_name.*' => 'required|string|max:255',
            'objective_description' => 'nullable|array',
            'objective_description.*' => 'nullable|string',
        ]);

        try {
            $userId = Auth::id();

            foreach ($validatedData['objective_name'] as $index => $name) {
                Objective::create([
                    'goal_id' => $validatedData['goal_id'],
                    'objective_name' => $name,
                    'objective_description' => $validatedData['objective_description'][$index] ?? null,
                    'objective_created_by_user_id' => $userId,
                ]);
            }

            return redirect()->back()->with('success', 'Objectives created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating objectives. Please try again.');
        }
    }

    //For updating an objective
    public function updateObjective(Request $request, $objectiveId)
    {
        $request->validate([
            'objective_name' => 'required|string',
            'objective_description' => 'nullable|string',
        ]);

        try {
            $objective = Objective::findOrFail($objectiveId);
            $objective->update($request->all());

            return redirect()->back()->with('success', 'Objective updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the objective. Please try again.');
        }
    }

    //For deleting an objective
    public function deleteObjective($objectiveId)
    {
        try {
            $objective = Objective::findOrFail($objectiveId);
            $objective->delete();

            return redirect()->back()->with('success', 'Objective deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the objective. Please try again.');
        }
    }

    //For adding more objectives
    public function addMoreObjective(Request $request, $goalId)
    {
        try {
            $userId = Auth::id();

            $request->validate([
                'objective_name' => 'required|string|max:255',
                'objective_description' => 'nullable|string',
            ]);

            $goal = Goal::findOrFail($goalId);

            $goal->objectives()->create([
                'objective_name' => $request->input('objective_name'),
                'objective_description' => $request->input('objective_description'),
                'objective_created_by_user_id' => $userId,
            ]);

            return redirect()->back()->with('success', 'Objective added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the objective. Please try again.');
        }
    }
}
