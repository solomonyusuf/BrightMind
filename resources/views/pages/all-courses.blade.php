<div class="h-screen p-6" style="overflow:scroll;">
  <!-- Swiper & Tailwind CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <div class="flex flex-col gap-6 h-full">
    <!-- Top Slider -->
    <div class="flex flex-col space-y-4">
      <div class="text-lg font-bold">Top Courses</div>
      <div class="swiper leftSwiper">
        <div class="swiper-wrapper">
          @foreach($videos as $video)
            <div class="swiper-slide bg-gray-800 rounded-lg h-48 flex flex-col items-center justify-center min-w-[200px] p-2">
              <iframe
                src="{{ $video->link }}"
                class="w-full h-32 rounded-md"
                frameborder="0"
                allowfullscreen
              ></iframe>
              <p class="text-sm font-semibold mt-1 text-center">{{ $video->title }}</p>
              <p class="text-sm font-semibold mt-2 text-center">{{ $video->description }}</p>
            <a href="{{ route('delete_course', $video->id) }}" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 mb-3 px-4 rounded-lg transition duration-200">
             Delete
            </a>
            </div>
          @endforeach
        </div>
        <!-- Navigation buttons -->
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
      </div>
    </div>

    <!-- Bottom Slider -->
    <div class="flex flex-col justify-end space-y-4">
      <div class="text-lg font-bold">All Courses</div>
      <div class="swiper rightSwiper">
        <div class="swiper-wrapper">
          @foreach($videos as $video)
            <div class="swiper-slide bg-gray-800 rounded-lg h-48 flex flex-col items-center justify-center min-w-[200px] p-2">
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
        <!-- Navigation buttons -->
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
      </div>
    </div>
  </div>

  <script>
    new Swiper('.leftSwiper', {
      slidesPerView: 'auto',
      spaceBetween: 16,
      navigation: {
        nextEl: '.leftSwiper .swiper-button-next',
        prevEl: '.leftSwiper .swiper-button-prev',
      },
    });

    new Swiper('.rightSwiper', {
      slidesPerView: 'auto',
      spaceBetween: 16,
      navigation: {
        nextEl: '.rightSwiper .swiper-button-next',
        prevEl: '.rightSwiper .swiper-button-prev',
      },
    });
  </script>
</div>
