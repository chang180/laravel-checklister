<table class="table table-responsive-sm" wire:sortable="updateTaskOrder">
    <tbody>
        @foreach ($tasks as $task)
            <tr wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
                <td>{{ $task->name }} </td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{route('admin.checklists.tasks.edit',[$checklist,$task])}} ">{{__('Edit')}}</a>
                    <form class="d-inline-block"
                        action="{{ route('admin.checklists.tasks.destroy', [$checklist, $task]) }} "
                        method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">
                            {{ __('Delete') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>