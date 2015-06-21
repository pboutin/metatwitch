window.Stream = function(rawStream) {
    this.channelName = ko.observable(rawStream.channel.name);
    this.channelStatus = ko.observable(rawStream.channel.status);
    this.channelLogo = ko.observable(rawStream.channel.logo);
    this.channelViews = ko.observable(rawStream.channel.views);
    this.channelFollowers = ko.observable(rawStream.channel.followers);
    this.game = ko.observable(rawStream.game);
    this.viewers = ko.observable(rawStream.viewers);
    this.preview = ko.observable(rawStream.preview.medium);

    this.cleanViewers = ko.computed(function() {
        return parseInt(this.viewers(), 10).toLocaleString();
    });
    this.cleanChannelViews = ko.computed(function() {
        return parseInt(this.channelViews(), 10).toLocaleString();
    });
    this.cleanChannelFollowers = ko.computed(function() {
        return parseInt(this.channelFollowers(), 10).toLocaleString();
    });
};