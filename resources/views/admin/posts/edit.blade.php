@extends('layouts.app')

@section('content')
    <div class="container">
       @if ($errors->any())
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
          </ul>
        @endif
      <form action="{{route('admin.posts.update', $post->id)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="mb-3">
          <label for="titolo" class="form-label">Titolo</label>
          <input type="text" name="title" class="form-control" id="titolo" value="{{old('title', $post->title)}}">
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Categoria</label>
          <select name="category_id" id="category" class="form-control">
            <option value="">--Seleziona una categoria--</option>
            <option value="">--Seleziona una categoria--</option>
              @foreach ($categories as $category)
                  <option value="{{$category->id}}"
                    {{-- se id del vecchio category è uguale a quello attuale
                    allora selezionalo --}}
                    @if ($category->id == old('category_id', $post->category_id)) selected @endif>
                        
                    
                    
                    {{old('',$category->name)}}
                  </option>
              @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Descrizione</label>
          <textarea name="content" id="desc" cols="30" rows="10" class="form-control">{{old('content', $post->content)}}</textarea>
        </div>
        <div>
          <h4>Tag</h4>
          @foreach($tags as $key => $tag)
             <input id="tag{{$key}}" type="checkbox" value="{{$tag->id}}"
              {{-- se non ci sono erroi E il tag dentro post è presente nella tabella tag  --}}
               @if(!$errors->any() && $post->tags->contains($tag->id))
                checked
               @elseif(in_array($tag->id, old('tags', [])))
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