<form action="{{ route($route) }}" method="POST" class="w-full md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
    @csrf
    <input type="hidden" name="id" value="{{ $model->id }}">
    <div class="shadow-lg p-6 rounded-md bg-header flex flex-col justify-between items-center">

        <!-- Title at the top, centered -->
        <div class="text-center mb-4 w-full">
            <x-fonts.highlight-header>{{ $model->truncateName() }}</x-fonts.highlight-header>
            <hr class="border-t-2 border-accent">
        </div>

        <div class="flex flex-col items-center">
            <div class="mb-4">
                @if(!empty($email))
                <a href="mailto:{{ $email }}">
                    <i class="{{ $faIcon }} text-4xl text-text"></i>
                </a>
                @else
                <i class="{{ $faIcon }} text-4xl text-text"></i>
                @endif
            </div>
            <div>
                <x-primary-button type="submit">{{ $buttonName }}</x-primary-button>
            </div>
        </div>
    </div>
</form>