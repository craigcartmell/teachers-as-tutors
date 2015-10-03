@extends('app')

@section('title', 'My Calendar')

@section('css')
        <!-- TODO: Add to one css file -->
    <link href="{{ asset('build/css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('build/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('calendar') !!}
@endsection

@section('content')
    <div class="container">
        <div id="calendar" data-tutor-id="{{ auth()->user()->getKey() }}" data-is-editable="{{ ! auth()->user()->is_parent }}"></div>
    </div>

    <div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title">Lesson Booking</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger hidden"></div>
                    <form>
                        <label for="parent_id">Parent</label>
                        <select id="parent_id" name="parent_id" class="form-control">
                            <option value="0">-- Please Select --</option>
                            @foreach($parents as $p)
                                <option value="{{ $p->getKey() }}">{{ $p->name }}</option>
                            @endforeach
                        </select>

                        <label>When</label>

                        <div class="input-group clockpicker" data-placement="bottom" data-align="top"
                             data-autoclose="true">
                            <input id="started_at" type="text" class="form-control" value="started_at" placeholder="e.g. 12:30">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                        </div>

                        <label for="hours">Hours</label>
                        <input id="hours" type="text" class="form-control" type="number" placeholder="e.g. 1.5">

                        <div>
                            <label for="hourly_rate">Hourly Rate (£)</label>
                            <input id="hourly_rate" name="hourly_rate" type="number" class="form-control" placeholder="e.g. 30">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button id='modal-delete' class="btn btn-danger pull-left">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id='modal-save' type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var Calendar = App.Calendar;
        Calendar.init();
    </script>
@endsection