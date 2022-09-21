@extends('layout')


@section('content')
   @include('partials._search')
   <div class="flex">
      <a href="/" class="inline text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>
      @if ($listing->user_id == auth()->id())
         
      <div class="mr-4 flex space-x-6 bg-grey-50 ml-auto">
         <a href="/listing/{{$listing->id}}/edit">Edit Project</a>

         <form action="/listing/{{$listing->id}}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" class="text-red-500">Delete Project</button>
         </form>
      </div>

      @endif
   </div>
   <div class="mx-4">
      <x-card class="p-10">
         <div class="flex flex-col items-center justify-center text-center">
            <img class="w-48 mr-6 mb-6" alt="" 
            src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}" 
            />
   
            <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            
            <x-listing-tags :tagsCsv="$listing->tags" />

            <div class="text-lg my-4">
               <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
            </div>
            <div class="border border-gray-200 w-full mb-6"></div>
            <div>
               <h3 class="text-3xl mb-4">
                  <span class="font-bold">Project Category : </span>
                  {{$listing->category->name}}
               </h3>
               
               <h3 class="text-3xl font-bold mb-4">
                  Description
               </h3>
               <div class="text-lg space-y-6">
                  <p>{{$listing->description}}</p>
   
                  <a href="mailto:{{$listing->email}}"
                     class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                        class="fa-solid fa-envelope"></i>
                     Contact Employer</a>
   
                  <a href="{{$listing->website}}" target="_blank"
                     class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i class="fa-solid fa-globe"></i>
                     Visit
                     Website</a>
               </div>
            </div>
         </div>
      </x-card>

      
      

   </div>
@endsection