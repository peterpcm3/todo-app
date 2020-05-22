<?php

namespace App\Observers;

use App\Todo;
use Auth;
use Mail;

class TodoObserver
{
    /**
     * Handle the todo "created" event.
     *
     * @param  \App\Todo  $todo
     * @return void
     */
    public function created(Todo $todo)
    {
        $user = Auth::user();

        Mail::send('emails.todo_changes', ['action' => 'Create', 'item' => 'Todo #' . $todo . '; Note: ' . $todo->note], function ($m) use($user) {
            $m->from('support@todoapp.com', 'Todo application');

            $m->to($user->email)->subject('Todo list changes');
        });
    }

    /**
     * Handle the todo "updated" event.
     *
     * @param  \App\Todo  $todo
     * @return void
     */
    public function updated(Todo $todo)
    {
        $user = Auth::user();

        Mail::send('emails.todo_changes', ['action' => 'Update', 'item' => 'Todo #' . $todo . '; Note: ' . $todo->note], function ($m) use($user) {
            $m->from('support@todoapp.com', 'Todo application');

            $m->to($user->email)->subject('Todo list changes');
        });
    }

    /**
     * Handle the todo "deleted" event.
     *
     * @param  \App\Todo  $todo
     * @return void
     */
    public function deleted(Todo $todo)
    {
        $user = Auth::user();

        Mail::send('emails.todo_changes', ['action' => 'Update', 'item' => 'Todo #' . $todo . '; Note: ' . $todo->note], function ($m) use($user) {
            $m->from('support@todoapp.com', 'Todo application');

            $m->to($user->email)->subject('Todo list changes');
        });
    }

    /**
     * Handle the todo "restored" event.
     *
     * @param  \App\Todo  $todo
     * @return void
     */
    public function restored(Todo $todo)
    {
        //
    }

    /**
     * Handle the todo "force deleted" event.
     *
     * @param  \App\Todo  $todo
     * @return void
     */
    public function forceDeleted(Todo $todo)
    {
        //
    }
}
