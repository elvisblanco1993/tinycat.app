<?php

namespace App\Livewire\Task;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
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

    public function render()
    {
        return view('livewire.task.create');
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
        ]);

        $users = collect($this->assign_to)->pluck('id');

        $task = $this->client->tasks()->create([
            'created_by' => Auth::id(),
            'title' => $this->title,
            'due_date' => $this->due_date,
            'description' => $this->description,
            'status' => 'pending',
            'priority' => 'medium',
            'progress' => 0,
        ]);

        $task->users()->attach($users);

        session()->flash('flash.banner', 'Task created!');
        session()->flash('flash.bannerStyle', 'success');

        $this->redirect(url: url()->previous(), navigate: true);
    }
}
