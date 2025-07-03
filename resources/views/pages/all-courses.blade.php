<div class="h-screen p-6 overflow-scroll">

  <div class="flex flex-col gap-6 h-full">
    <!-- All Courses Section -->
    <div class="flex flex-col space-y-4">
      <div class="text-lg font-bold">All Courses</div>
      <div class="flex flex-row flex-wrap gap-4">
        @foreach($videos as $video)
          <div class="bg-gray-800 rounded-lg w-[250px] flex flex-col items-center justify-start p-2">
            <iframe
              src="{{ $video->link }}"
              class="w-full h-32 rounded-md"
              frameborder="0"
              allowfullscreen
            ></iframe>
            <p class="text-sm font-semibold mt-1 text-center">{{ $video->title }}</p>
            <p class="text-sm font-semibold mt-2 text-center">{{ $video->description }}</p>
          </div>
        @endforeach
      </div>
    </div>

  </div>

</div>
