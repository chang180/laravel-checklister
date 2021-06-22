@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.checklist_groups.checklists.update', [$checklistGroup,$checklist]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">{{ __('Edit Checklist in ') }}{{ $checklistGroup->name}}</div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input class="form-control" name="name" type="text"
                                                value="{{$checklist->name }} ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-primary" type="submit"> {{ __('Save') }}</button>
                                <button class="btn btn-sm btn-danger d-none" type="reset"> {{ __('Reset') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <form action="{{ route('admin.checklist_groups.checklists.destroy', [$checklistGroup, $checklist]) }} " method="POST" onsubmit="return confirm('{{__('Are you sure?') }}');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit"> {{ __('Delete This Checklist') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
