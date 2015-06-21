@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-2">
                            <img src="http://placecage.com/100/100" alt="user" class="img-circle img-responsive">
                        </div>
                        <div class="col-xs-7">
                            <h5>Dalran {{trans('dashboard.playing')}} League of Legends</h5>
                            <h6>Super title of doom yeah !</h6>

                            <div class="row text-center">
                                <div class="col-xs-4 text-danger">
                                    <i class="fa fa-user"></i> 34
                                </div>
                                <div class="col-xs-4">
                                    <i class="fa fa-eye"></i> 123,000
                                </div>
                                <div class="col-xs-4">
                                    <i class="fa fa-heart"></i> 1,000
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <button class="btn btn-primary pull-right">
                                <i class="fa fa-video-camera"></i> {{trans('dashboard.watch')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop