<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public Client $client;

    public $modal;

    public $title;

    public $assign_to = [];

    public $clientUsers;

    public $due_date;

    public $description;

    // New fields for recurrence
    public $repeat = false; // Checkbox to enable repetition
    public $frequency; // e.g., 'daily', 'weekly', 'monthly'
    public $interval = 1; // Interval between repeats
    public $end_date; // End date for the recurrence

    public function render()
    {
        return view('livewire.task.create');
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'due_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:due_date',
            'frequency' => 'required_if:repeat,true',
            'interval' => 'required_if:repeat,true|integer|min:1',
        ]);

        $users = collect($this->assign_to)->pluck('id');

        $task = $this->client->tasks()->create([
            'created_by' => Auth::id(),
            'title' => $this->title,
            'due_date' => $this->due_date,
            'description' => $this->description,
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        $task->users()->attach($users);

        // Handle recurring tasks
        if ($this->repeat) {
            $this->createRecurringTasks($task);
        }

        session()->flash('flash.banner', 'Task created!');
        session()->flash('flash.bannerStyle', 'success');

        $this->redirect(url: url()->previous(), navigate: true);
    }

    private function createRecurringTasks(Task $task)
    {
        $frequencyMap = [
            'day' => 'addDays',
            'week' => 'addWeeks',
            'month' => 'addMonths',
            'year' => 'addYears',
        ];

        $method = $frequencyMap[$this->frequency] ?? null;

        if (!$method) {return; }

        $startDate = Carbon::parse($task->due_date);
        $endDate = $this->end_date ? Carbon::parse($this->end_date) : null;

        while (!$endDate || $startDate->lte($endDate)) {
            $startDate = $startDate->{$method}($this->interval);

            if ($endDate && $startDate->gt($endDate)) {
                break;
            }

            $recurringTask = $this->client->tasks()->create([
                'created_by' => $task->created_by,
                'title' => $task->title,
                'due_date' => $startDate->toDateString(),
                'description' => $task->description,
                'status' => 'pending',
                'priority' => 'medium',
                'parent_task_id' => $task->id, // To track the original task
            ]);
            $recurringTask->users()->attach($task->users->pluck('id'));
        }
    }
}
