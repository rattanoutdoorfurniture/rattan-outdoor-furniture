/*******************************************\
|   Sets Default Value For Custom Options   |
\*******************************************/


function fireEvent(element, event) {
    if (document.createEventObject) {
        // dispatch for IE
        var evt = document.createEventObject();
        return element.fireEvent('on' + event, evt);
    }
    else {
        // dispatch for firefox + others
        var evt = document.createEvent("HTMLEvents");
        evt.initEvent(event, true, true);
        return !element.dispatchEvent(evt);
    }
}

function setDefaultConfigOptions() {
    if (spConfigIndex >= spConfig.settings.length) {
        return; // stop
    }

    spConfig.settings[spConfigIndex].selectedIndex = 1;
    var obj = spConfig.settings[spConfigIndex];

    ++spConfigIndex;

    Event.observe(obj, 'change', function () {
    });
    fireEvent(obj, 'change');

    window.setTimeout("setDefaultConfigOptions()", 1); // Add a small delay before moving onto the next option
}

var spConfigIndex = 0;
Event.observe(window, 'load', function () {
    setDefaultConfigOptions();
});
