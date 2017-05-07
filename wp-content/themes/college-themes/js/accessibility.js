var html = jQuery("body > *:not('.as-container, meta, script, link, title, style')");
var asContainer = jQuery('.as-container');

var fontSizeIncrease = jQuery('button[value="increase"]');
var fontSizeDecrease = jQuery('button[value="decrease"]');
var fontSizeDefault = jQuery('button[value="font-size-default"]');
var currentFontSize = jQuery('body > div').css('font-size');

var grayscale = jQuery('button[value="grayscale"]');
var grayscaleDefault = jQuery('button[value="grayscale-default"]');

var contrast = jQuery('button[value="contrast"]');
var contrastDefault = jQuery('button[value="contrast-default"]');

var sepia = jQuery('button[value="sepia"]');
var sepiaDefault = jQuery('button[value="sepia-default"]');

var invert = jQuery('button[value="invert"]');
var invertDefault = jQuery('button[value="invert-default"]');


var cursor = jQuery('button[value="cursor"]');
var cursorDefault = jQuery('button[value="cursor-default"]');

var links = jQuery('button[value="links"]');
var linksDefault = jQuery('button[value="links-default"]');

function pageSizeChanger(operation) {
    var html = jQuery('html');
    var currentFontSize = html.css('transform');
    var value = currentFontSize.match(/-?[\d\.]+/g);

    if (operation == 'decrease') {
        var neededValue = parseFloat(value[0]) - 0.1;
        if (parseInt(value[0]) > 0.7) {
            html.css({
                '-webkit-transform': 'scale(' + neededValue + ')',
                '-moz-transform': 'scale(' + neededValue + ')',
                '-ms-transform': 'scale(' + neededValue + ')',
                '-o-transform': 'scale(' + neededValue + ')',
                'transform': 'scale(' + neededValue + ')'
            });
        }
    } else {
        var neededValue = parseFloat(value[0]) + 0.1;
        if (parseInt(value[0]) < 1.4) {
            html.css({
                '-webkit-transform': 'scale(' + neededValue + ')',
                '-moz-transform': 'scale(' + neededValue + ')',
                '-ms-transform': 'scale(' + neededValue + ')',
                '-o-transform': 'scale(' + neededValue + ')',
                'transform': 'scale(' + neededValue + ')'
            });
        }
    }
}

fontSizeIncrease.click(function () {
    pageSizeChanger('increase');
});

fontSizeDefault.click(function () {
    html.css({
        '-webkit-transform': 'scale(1)',
        '-moz-transform': 'scale(1)',
        '-ms-transform': 'scale(1)',
        '-o-transform': 'scale(1)',
        'transform': 'scale(1)'
    });
});

fontSizeDecrease.click(function () {
    pageSizeChanger('decrease');
});

var handicapIcon = jQuery('.handicap-icon');
var asClose = jQuery('.as-close');

handicapIcon.click(function (e) {
    asContainer.css('display', 'block');
    asContainer.animate({'width': '100%'}, 300);
});

asClose.click(function () {
    var asContainer = jQuery('.as-container');

    asContainer.animate({'width': '0%'}, 300, function () {
        asContainer.css('display', 'none');
    });
});

function applyValuesToPage() {
    var array = ['grayscale', 'sepia', 'contrast', 'invert', 'cursor', 'highlight_links'];

    var i = 0;
    for (i; i < array.length; i++) {
        var currentItemValue = localStorage.getItem(array[i]);
        if (currentItemValue == 'true') {
            setFilter(array[i]);
            makeButtonActive(array[i]);
        } else if (currentItemValue == 'yes') {
            jQuery('a').addClass('hightlight-links');
            makeButtonActive('links');
        } else if (currentItemValue == 'no') {
            jQuery('a').removeClass('hightlight-links');
            makeButtonUnActive('links');
        }
    }
}

applyValuesToPage();

function makeButtonActive(filterName) {
    jQuery('.as-container button[value="' + filterName + '"]').addClass('active-option');
}

function makeButtonUnActive(filterName) {
    jQuery('.as-container button[value="' + filterName + '"]').removeClass('active-option');
}

function setFilter(filterName) {
    var html = jQuery("body > *:not('.as-container, meta, script, link, title, style')");
    html.addClass(filterName);

    localStorage.setItem(filterName, 'true');
}

function removeFilter(filterName) {
    var html = jQuery("body > *:not('.as-container, meta, script, link, title, style')");
    html.removeClass(filterName);
    localStorage.setItem(filterName, 'false');
}

grayscale.click(function () {
    setFilter('grayscale');
    makeButtonActive('grayscale');
});

grayscaleDefault.click(function () {
    removeFilter('grayscale');
    makeButtonUnActive('grayscale');
});

sepia.click(function () {
    setFilter('sepia');
    makeButtonActive('sepia');
});

sepiaDefault.click(function () {
    removeFilter('sepia');
    makeButtonUnActive('sepia');
});

contrast.click(function () {
    setFilter('contrast');
    makeButtonActive('contrast');
});

contrastDefault.click(function () {
    removeFilter('contrast');
    makeButtonUnActive('contrast');
});

invert.click(function () {
    setFilter('invert');
    makeButtonActive('invert');
});

invertDefault.click(function () {
    removeFilter('invert');
    makeButtonUnActive('invert');
});

cursor.click(function () {
    setFilter('cursor');
    makeButtonActive('cursor');
});

cursorDefault.click(function () {
    removeFilter('cursor');
    makeButtonUnActive('cursor');
});

links.click(function () {
    jQuery('a').addClass('hightlight-links');
    localStorage.setItem('highlight_links', 'yes')
    makeButtonActive('links');
});

linksDefault.click(function () {
    jQuery('a').removeClass('hightlight-links');
    localStorage.setItem('highlight_links', 'no')
    makeButtonUnActive('links');
});

if (jQuery('.field-name').length === 0) {
    jQuery('.nothing-to-show').css('display', 'block');
}
