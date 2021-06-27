<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                {{ $checklist->name }}
            </div>
            <div class="card-body">
                <table class="table">
                    @foreach ($checklist->tasks->where('user_id', null) as $task)
                        <tr>
                            <td>
                                <input type="checkbox" wire:click="complete_task({{ $task->id }})" @if (in_array($task->id, $completed_tasks)) checked="checked" @endif>
                            </td>
                            <td><a href="#" wire:click.prevent="toggle_task({{ $task->id }})">{{ $task->name }}
                                </a>
                            </td>
                            <td wire:click.prevent="toggle_task({{ $task->id }})">
                                @if (in_array($task->id, $opened_tasks))
                                    <svg class="c-sidebar-nav-icon">
                                        <use
                                            xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-caret-top') }}">
                                        </use>
                                    </svg>
                                @else
                                    <svg class="c-sidebar-nav-icon">
                                        <use
                                            xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-caret-bottom') }}">
                                        </use>
                                    </svg>
                                @endif
                            </td>
                        </tr>
                        @if (in_array($task->id, $opened_tasks))
                            <tr>
                                <td></td>
                                <td colspan="2">{!! $task->description !!} </td>
                            </tr>
                        @endif
                    @endforeach
                    {{-- {{ print_r($opened_tasks) }} --}}
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @if (!is_null($current_task))
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a href="#">&star;</a>
                    </div>
                    <b>{{ $current_task->name }} </b>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    &#9788;
                    &nbsp;
                    @if($current_task->added_to_my_day_at)
                    <a wire:click.prevent="add_to_my_day({{$current_task->id}})" href="#">{{__('Remove from May Day')}} </a>
                    @else
                    <a wire:click.prevent="add_to_my_day({{$current_task->id}})" href="#">{{__('Add to May Day')}} </a>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    &#9993;
                    &nbsp;
                    <a href="#">{{__('Remind me')}}</a>
                    <hr>
                    &#9745;
                    &nbsp;
                    <a href="#">{{__('Add Due Date')}}</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    &#9745;
                    &nbsp;
                    <a href="#">{{__('Add Due Date')}}</a>
                </div>
            </div>
        @endif
    </div>
</div>
