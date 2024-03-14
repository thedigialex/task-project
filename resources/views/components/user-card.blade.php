<div class="shadow-lg p-5 rounded-md transition-transform duration-200 w-48 hover:scale-105 bg-slate-800">
    <div class="flex items-center justify-center flex-col">
        <div class="flex-shrink-0 relative">
            <a href="mailto:{{ $email }}" class="group">
                <i class="fas fa-user text-4xl text-white transition duration-300 transform hover:text-cyan-400 hover:scale-110"></i>
                <span class="hidden group-hover:block absolute top-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded-md">Email</span>
            </a>
        </div>
        <div class="mt-4">
            <a href="{{ $editUrl }}" class="group relative">
                <h2 class="text-lg leading-6 font-medium text-white transition duration-300 transform hover:text-cyan-400 hover:scale-110">{{ $name }}</h2>
                <span class="hidden absolute top-full left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded-md group-hover:block">Edit</span>
            </a>
        </div>
    </div>
</div>

