<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-user-circle text-6xl text-gray-500"></i>
            </div>
            <div class="ml-4">
                <div class="text-lg leading-6 font-medium text-gray-900">{{ $name }}</div>
                <div class="text-sm leading-5 text-gray-500"><a href="mailto:{{ $email }}">Email</a></div>
            </div>
        </div>
        <div class="mt-5 flex">
            <a href="{{ $editUrl }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
        </div>
    </div>
</div>