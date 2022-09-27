@extends('layout')


@section('content')
<div class="mx-4">
   <x-card class="p-10 max-w-lg mx-auto mt-24">
      <header class="text-center">
         <h2 class="text-2xl font-bold uppercase mb-1">Update a Project</h2>
         <p class="mb-4">{{$listing->title}} for {{$listing->company}}</p>
      </header>

      <form action="/listing/{{$listing->id}}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('PUT')
         <div class="mb-6">
            <label for="company" class="inline-block text-lg mb-2">Company Name</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company" 
               value="{{$listing->company}}" />
            @error('company')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <label for="title" class="inline-block text-lg mb-2">Project Title</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
               placeholder="Example: Senior Laravel Developer" value="{{$listing->title}}"/>
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <label for="category" class="inline-block text-lg mb-2">Project Category</label>
            <select name="category" id="category" class="border border-gray-200 rounded p-2 w-full">
               @foreach ($categories as $category)
                   <option value="{{$category->id}}" {{$category->id == $listing->category->id ? 'selected' : ''}}>{{$category->name}}</option>
               @endforeach
            </select>
            @error('category')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <label for="location" class="inline-block text-lg mb-2">Project Location</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
               placeholder="Example: Remote, Boston MA, etc" value="{{$listing->location}}" />
            @error('location')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2">Contact Email</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email" 
               value="{{$listing->email}}" />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <label for="website" class="inline-block text-lg mb-2">Website/Application URL</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website" 
               value="{{$listing->website}}" />
            @error('website')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <label for="tags" class="inline-block text-lg mb-2">Tags (Comma Separated)</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
               placeholder="Example: Laravel, Backend, Postgres, etc" value="{{$listing->tags}}" />
            @error('tags')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <label for="tags_list" class="inline-block text-lg mb-2">Tags</label>
            <div>
               <textarea name="tags_list" cols="30" rows="1" class="border border-gray-200 rounded p-2 w-full" id="tags_list-area"></textarea>
               <p>
                  <strong>Propositions : </strong>
                  <span id="tags_list-suggest-edit"></span>
               </p>
               <p>
                  <strong>Selected : </strong>
                  <span id="tags_list-selected-edit">
                     @forelse ($listing->tags_list as $tag)
                         <button type="button" class="inline-bloc bg-green-500 text-white px-3 mx-2" id={{$tag->id}}>{{$tag->name}}</button>
                     @empty
                         
                     @endforelse
                  </span>
               </p>
               {{-- <form id="tags_list-form">
                  @csrf
               </form> --}}
            </div>
            <input type="hidden" name="tags_list" id="tags_list-input-edit"/>
            <script src="{{asset('js/tags_list.js')}}"></script>
            @error('tags_list')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <label for="logo" class="inline-block text-lg mb-2">Company Logo</label>
            <img class="w-48 mr-6 mb-6" alt="" 
               src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}" 
               />
            <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />
            @error('logo')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <label for="description" class="inline-block text-lg mb-2">Project Description</label>
            <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
               placeholder="Include tasks, requirements, salary, etc" id='project-description-area'>{{$listing->description}}</textarea>
            @error('description')
               <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
         </div>

         <div class="mb-6">
            <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Update Project</button>

            <a href="/" class="text-black ml-4"> Back </a>
         </div>
      </form>
   </x-card>
</div>
@endsection