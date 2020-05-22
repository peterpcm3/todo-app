<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\TodoRepositoryInterface;
use App\Todo;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * @var \App\Repositories\Interfaces\TodoRepositoryInterface $todoRepository
     */
    private $todoRepository;

    /**
     * TodoController constructor.
     *
     * @param TodoRepositoryInterface $todoRepository
     */
    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->todoRepository->getAllByUser(Auth::id());//Todo::latest()->paginate(5);

        return view('todo.index',['todos' => $todos]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'note'          => 'required|max:32',
            'description'   => 'required|max:255',
        ]);

        if ($validator->fails())
        {
            $validator->errors()->add('error', 'true');

            return redirect()->route('frontend.todo.create')
                ->withErrors($validator)
                ->withInput();
        }

        Todo::create(array_merge($request->all(), array('user_id' => Auth::id())));

        return redirect()->route('frontend.todo.list')
            ->with('success','Todo note created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = $this->todoRepository->findByIdAndUserId($id, Auth::id());

        return view('todo.show',compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = $this->todoRepository->findByIdAndUserId($id, Auth::id());

        return view('todo.edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePost(Request $request, $id)
    {
        $todo = $this->todoRepository->findByIdAndUserId($id, Auth::id());

        if (!$todo) {
            return redirect()->route('frontend.todo.list')
                ->with('error','Todo note wasn\'t found');
        }

        $validator = Validator::make($request->all(), [
            'note'          => 'required|max:32',
            'description'   => 'required|max:255',
        ]);

        if ($validator->fails())
        {
            $validator->errors()->add('error', 'true');

            return redirect()->route('frontend.todo.edit', ['id' => $todo->id])
                ->withErrors($validator)
                ->withInput();
        }

        $todo->update($request->all());

        return redirect()->route('frontend.todo.list')
            ->with('success','Todo note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->get('id');

        $todo = $this->todoRepository->findByIdAndUserId($id, Auth::id());
        if (!$todo)
        {
            return redirect()->route('frontend.todo.list')
                ->with('error','Todo note wasn\'t deleted' );
        }

        $todo->delete();

        return redirect()->route('frontend.todo.list')
            ->with('success','Todo note deleted successfully');
    }
}
