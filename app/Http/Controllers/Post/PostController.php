<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\CreatePostFormRequest;
use App\Http\Requests\Post\UpdatePostFormRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $posts = Post::latest()->paginate(5);
        
        return view('posts.index',compact('posts'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostFormRequest $request)
    {
       $validatedData = $request->validated();
        
       $data = array_merge($validatedData, ['author' => Auth::user()->id ]);
        
       Post::create($data);
         
        return redirect()->route('posts.index')
                        ->with('success','Posts created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $postid)
    {
        $posts = Post::where('id', $postid)->first();
        return view('posts.show',compact('posts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($postid)
    {
        if(Auth::user()->role != 'superadmin'){
            return redirect()->route('posts.index')
                        ->with('error','You have no permission to perform delete action');
        }
        
        Post::where('id', $postid)->delete();
         
        return redirect()->route('posts.index')
                        ->with('success','Post deleted successfully');
    }
}
