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
                    <h4 class="modal-title" id="myModalLabel">Lesson Booking</h4>
                </div>
                <div class="modal-body">
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
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group clockpicker" data-placement="bottom" data-align="top"
                                     data-autoclose="true">
                                    <input type="text" class="form-control" value="started">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group clockpicker" data-placement="bottom" data-align="top"
                                     data-autoclose="true">
                                    <input type="text" class="form-control" value="ended">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var Calendar = App.Calendar;
        Calendar.init();

        console.log(Calendar);
    </script>
@endsection