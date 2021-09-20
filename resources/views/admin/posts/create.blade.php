@extends('layouts.app')

@section('content')
<div class="container">
  {{-- @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
      @endforeach
    </ul>
  @endif --}}
  <form action="{{route('admin.posts.store')}}" method="post">
    @csrf
    <div class="mb-3">
      <label for="titolo" class="form-label">Titolo</label>
      <input type="text" class="form-control
      @error('title')
      is-invalid
      @enderror" 
      id="titolo" name="title" value="{{old('title')}}">
    </div>
    <div class="mb-3">
      <label for="category" class="form-label">Titolo</label>
      <select name="category_id" id="category">
        <option value="">--Seleziona una categoria--</option>
        @foreach ($categories as $category)
          <option value="{{$category->id}}"
            @if (old('category_id') == $category->id)
              selected
            @endif
            >{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    @error('title')
        <div class="alert alert-danger">{{$message}}</div>
    @enderror
    <div class="mb-3">
      <textarea class="form-control
      @error('content')
      is-invalid
      @enderror" 
      name="content" id="desc" cols="30" rows="10" value="{{old('content')}}"></textarea>
      @error('content')
      <div class="alert alert-danger">{{$message}}</div>
      @enderror
     </div>
     <div>
       <h4>Tag</h4>
       @foreach($tags as $key => $tag)
          <input id="tag{{$key}}" type="checkbox" value="{{$tag->id}}" 
            @if(in_array($tag->id, old('tags', [])))
                checked
            @endif
          name="tags[]">
          <label for="tag{{$key}}">{{$tag->name}}</label>
       @endforeach
     </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection