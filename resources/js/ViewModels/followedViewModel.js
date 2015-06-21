window.FollowedViewModel = function(channels) {
    if (channels) {
        this.channels = ko.observableArray(channels);
    } else {
        this.channels = ko.observableArray([]);
    }
};