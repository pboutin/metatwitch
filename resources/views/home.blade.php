@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-6" data-bind="foreach: streams">
            <div class="panel panel-default panel-stream" data-bind="style: { backgroundImage: 'url(\'' + preview() + '\')' }">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-2">
                            <img class="img-circle img-responsive" data-bind="attr: { src: channelLogo }" alt="avatar" />
                        </div>
                        <div class="col-xs-6">
                            <h4>
                                <span data-bind="text: channelName"></span> {{trans('dashboard.playing')}} <span data-bind="text: game"></span>
                            </h4>
                            <h6 data-bind="text: channelStatus"></h6>
                            <p>
                                <span class="inline-stats"><i class="fa fa-user"></i> <span data-bind="text: cleanViewers"></span></span>
                                <span class="inline-stats"><i class="fa fa-eye"></i> <span data-bind="text: cleanChannelViews"></span></span>
                                <span class="inline-stats"><i class="fa fa-heart"></i> <span data-bind="text: cleanChannelFollowers"></span></span>
                            </p>
                        </div>
                        <div class="col-xs-4">
                            <form action="room" method="post">
                                <input type="hidden" name="channel_name" data-bind="attr: { value: channelName }"/>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-video-camera"></i> {{trans('dashboard.watch')}}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        ko.applyBindings(new StreamList({!! json_encode($followed) !!}));
    </script>
@stop