<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:p-6 flex items-center justify-center flex-col">
        <div class="flex-shrink-0 relative">
            <a href="mailto:{{ $email }}" class="group">
                <i class="fas fa-user-circle text-6xl text-gray-500 transition duration-300 transform hover:text-blue-500 hover:scale-110"></i>
                <span class="hidden group-hover:block absolute top-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded-md">Email</span>
            </a>
        </div>
        <div class="mt-4">
            <a href="{{ $editUrl }}" class="text-blue-500 group relative">
                <h2 class="text-lg leading-6 font-medium text-gray-900">{{ $name }}</h2>
                <span class="hidden absolute top-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded-md group-hover:block">Edit</span>
            </a>
        </div>
    </div>
</div>
