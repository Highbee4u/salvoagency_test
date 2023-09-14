@extends('posts.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left">
                <h2>Salvo Agency Test</h2>
            </div>
            @if (Auth::user()->role != 'support')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('posts.create') }}"> Create New Post</a>
                </div>    
            @endif
            
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>S/N</th>
            <th>title</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @if ($posts->count() > 0)

            @foreach ($posts as $post)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>
                        <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
        
                            <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Show</a>
                            @if ($post->canEdit)
                                <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>    
                            @endif
                            
        
                            @csrf
                            @method('DELETE')
            
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr><td colspan = '4'> No post yet</td></tr>    
        @endif
        
    </table>
  
    {!! $posts->links() !!}
      
@endsection