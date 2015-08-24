@extends('app')

@section('title', 'My Calendar')

@section('css')
        <!-- TODO: Add to one css file -->
<link href="{{ asset('build/css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('build/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container">
        <div id="calendar" data-tutor-id="{{ auth()->user()->getKey() }}"></div>
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

                        <label>Lesson</label>

                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                <div class="input-group clockpicker" data-placement="bottom" data-align="top"
                                     data-autoclose="true">
                                    <input id="started_at" type="text" class="form-control" value="started_at">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                                </div>
                            </div>
                            <div class="col-lg-1">to</div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                <div class="input-group clockpicker" data-placement="bottom" data-align="top"
                                     data-autoclose="true">
                                    <input id="ended_at" type="text" class="form-control" value="ended_at">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                                </div>
                            </div>

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