<div x-data="{ showModal: false, task: {} }" x-init="document.addEventListener('task-info-click', event => {
                showModal = true;
                task = event.detail;
              })">
    <div x-show="showModal" class="modal flex text-center justify-center">
        <div class="modal-content flex flex-col self-center bg-gray-100 dark:bg-gray-200 p-2 rounded-lg w-full max-w-[500px]">
        <template x-if="task.id">
    <div>
        <div class="flex flex-row justify-center ml-2.5 w-full">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight w-11/12" x-text="task.title"></h2>
            <div class="close max-w-4 text-2xl hover:cursor-pointer text-red-800" @click="showModal = false">&times;</div>
        </div>
        <div class="flex flex-col pt-1">
            <p class="text-sm font-bold py-4 text-center">Target Date<br /><span x-text="task.target_date"></span></p>
            <div class="flex justify-center space-x-4">
                <div class="text-center">
                    <p class="font-bold">Hours<br /><span x-text="task.hours_required"></span></p>
                </div>
                <div class="text-center">
                    <p class="font-bold">Priority<br /><span x-text="task.priority"></span></p>
                </div>
                <div class="text-center">
                    <p class="font-bold">Tech Level<br /><span x-text="task.technological_level"></span></p>
                </div>
            </div>

            <p class="py-4 font-bold text-center">Description<br /><span x-text="task.description"></span></p>
            <div class="py-2" x-show="task.image_path">
                <img x-bind:src="task.image_path ? ('/storage/' + task.image_path) : ''" alt="Task Image" class="max-w-full h-auto mb-4" x-show="task.image_path && task.image_path !== ''">
            </div>
            <div class="flex flex-row justify-evenly">
                <x-button>
                    <a :href="'{{ route('tasks.edit', ['taskId' => 'TASK_ID']) }}'.replace('TASK_ID', task.id)">Edit</a>
                </x-button>
            </div>
        </div>
    </div>
</template>

        </div>
    </div>
</div>