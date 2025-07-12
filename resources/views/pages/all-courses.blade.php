<div class="h-screen p-6 overflow-scroll">

  <div class="flex flex-col gap-6 h-full">
    <!-- All Courses Section -->
    <div class="flex flex-col space-y-4">
      <div class="text-lg font-bold">All Courses</div>
      <div class="text-lg font-bold">
        <select id="categoryDropdown" class="p-2 bg-chat-bg rounded border">
          <option value="#">Select Category For AI Recommendation</option>
          <option value="{{ route('all_courses') }}?category=technology">Technology</option>
          <option value="{{ route('all_courses') }}?category=health">Health</option>
          <option value="{{ route('all_courses') }}?category=education">Education</option>
          <option value="{{ route('all_courses') }}?category=finance">Finance</option>
          <option value="{{ route('all_courses') }}?category=sports">Sports</option>
          <option value="{{ route('all_courses') }}?category=entertainment">Entertainment</option>
          <option value="{{ route('all_courses') }}?category=science">Science</option>
          <option value="{{ route('all_courses') }}?category=business">Business</option>
          <option value="{{ route('all_courses') }}?category=politics">Politics</option>
          <option value="{{ route('all_courses') }}?category=travel">Travel</option>
          <option value="{{ route('all_courses') }}?category=fashion">Fashion</option>
          <option value="{{ route('all_courses') }}?category=environment">Environment</option>
          <option value="{{ route('all_courses') }}?category=history">History</option>
          <option value="{{ route('all_courses') }}?category=culture">Culture</option>
        </select>
      </div>



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
            <a href="{{ route('delete_course', $video->id) }}" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 mb-3 px-4 rounded-lg transition duration-200">
             Delete
            </a>
          </div>
        @endforeach
      </div>
    </div>

  </div>
  <script>
  const dropdown = document.getElementById('categoryDropdown');
  dropdown.addEventListener('change', function () {
    const selected = this.value;
    if (selected) {
      window.location.href = selected; 
    }
  });
</script>

</div>
