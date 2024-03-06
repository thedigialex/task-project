<div class="phase-card p-5 rounded-md shadow-md">
    <div class="text-center mb-4">
        <i class="fa fa-tasks" aria-hidden="true"></i>
    </div>
    <div class="text-center mb-2.5">
        <h3 class="text-lg font-semibold">{{ $phaseName }}</h3>
    </div>
    <div class="text-center">
        <p>{{ $phaseDescription }}</p>
        <p>Status:
            @if ($completionPercentage == 100)
            <span class="text-green-500">
                {{ $completionPercentage }}%
            </span>
            @else
            <span class="text-yellow-500">
                {{ $completionPercentage }}%
            </span>
            @endif
        </p>
    </div>
</div>