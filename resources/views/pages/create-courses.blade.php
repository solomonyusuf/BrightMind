<div style="height:100%;overflow:scroll;">
   <form action="{{ route('post_course') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl mx-auto p-6  space-y-5">
    @csrf

    <!-- Image Upload -->
    <div>
        <label for="image" class="block text-sm font-medium text-gray-300">Course Image</label>
        <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full bg-gray-700 text-white rounded-xl file:bg-gray-600 file:text-white file:border-none file:rounded-lg file:py-3 file:px-3">
    </div>

    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-300">Course Title</label>
        <input type="text" id="title" name="title" class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <!-- Meta Data -->
    <div>
        <label for="meta_data" class="block text-sm font-medium text-gray-300">Description (Optional)</label>
        <textarea id="meta_data" maxlength="255" name="description" rows="3" class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <!-- Link -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-300">Video Link (link to course)</label>
        <input type="text" id="title" name="link" class="mt-1 block w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <!-- Submit Button -->
    <div class="text-right">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
            Save Course
        </button>
    </div>
</form>

</div>
