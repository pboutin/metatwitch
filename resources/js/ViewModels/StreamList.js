window.StreamList = function(streams) {
    if (streams) {
        this.streams = ko.observableArray(streams.map(window.Stream));
    } else {
        this.streams = ko.observableArray([]);
    }
};