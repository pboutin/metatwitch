@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-6" data-bind="foreach: channels">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-2">
                            <img class="img-circle img-responsive" data-bind="attr: { src: channel.logo }" alt="avatar" />
                        </div>
                        <div class="col-xs-7">
                            <h5>
                                <span data-bind="text: channel.name"></span> {{trans('dashboard.playing')}} <span data-bind="text: game"></span>
                            </h5>
                            <h6 data-bind="text: channel.status"></h6>

                            <div class="row text-center">
                                <div class="col-xs-4 text-danger">
                                    <i class="fa fa-user"></i> <span data-bind="text: viewers"></span>
                                </div>
                                <div class="col-xs-4">
                                    <i class="fa fa-eye"></i> <span data-bind="text: channel.views"></span>
                                </div>
                                <div class="col-xs-4">
                                    <i class="fa fa-heart"></i> <span data-bind="text: channel.followers"></span>
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
    <script type="text/javascript">
        ko.applyBindings(new FollowedViewModel({!! json_encode($followed) !!}));
    </script>
@stop