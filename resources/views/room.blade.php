@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div>
                <div class="avatar-wrapper online"><img src="http://placecage.com/50/50" alt="avatar" /></div>
                <div class="avatar-wrapper online"><img src="http://placecage.com/50/50" alt="avatar" /></div>
                <div class="avatar-wrapper away"><img src="http://placecage.com/50/50" alt="avatar" /></div>
                <div class="avatar-wrapper offline"><img src="http://placecage.com/50/50" alt="avatar" /></div>
            </div>
            <iframe
                type="text/html"
                class="video-stream"
                width="100%"
                height="auto"
                src="http://www.twitch.tv/summit1g/embed"
                frameborder="0">
            </iframe>
        </div>
        <div class="col-xs-4">
            <div class="chat-wrapper">
                <iframe frameborder="0"
                    scrolling="no"
                    src="http://www.twitch.tv/inf4mc/chat"
                    height="400"
                    width="100%">
                </iframe>
            </div>
            <div class="chat-wrapper">
                <iframe frameborder="0"
                    scrolling="no"
                    src="http://www.twitch.tv/summit1g/chat"
                    height="400"
                    width="100%">
                </iframe>
            </div>
        </div>
    </div>
@stop