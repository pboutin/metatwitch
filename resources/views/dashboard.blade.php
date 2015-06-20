@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col s6">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <div class="col s2">
                        <img src="http://placecage.com/100/100" alt="user" class="circle responsive-img valign">
                    </div>
                    <div class="col s7">
                        <h5>Dalran {{trans('dashboard.playing')}} League of Legends</h5>
                        <h6>Super title of doom yeah !</h6>
                        <div class="row text-center">
                            <div class="col s4 red-text">
                                <i class="small mdi-social-people"></i>
                                <div>34</div>
                            </div>
                            <div class="col s4">
                                <i class="small mdi-image-remove-red-eye"></i>
                                <div>123,123</div>
                            </div>
                            <div class="col s4">
                                <i class="small mdi-action-favorite"></i>
                                <div>6,666</div>
                            </div>
                        </div>
                    </div>
                    <div class="col s3">
                        <a class="waves-effect waves-light btn-large green darken-1">
                            <i class="mdi-av-videocam left"></i> {{trans('dashboard.watch')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s6">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <div class="col s2">
                        <img src="http://placecage.com/100/100" alt="user" class="circle responsive-img valign">
                    </div>
                    <div class="col s7">
                        <h5>Inf4Mc {{trans('dashboard.watching')}}</h5>
                        <h6>Dalran playing League of Legends</h6>
                        <h6>Super title of doom yeah !</h6>
                    </div>
                    <div class="col s3">
                        <a class="waves-effect waves-light btn-large green darken-1">
                            <i class="mdi-av-videocam left"></i> {{trans('dashboard.join')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop