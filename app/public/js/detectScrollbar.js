(function ($) {
    $.fn.hasScrollBar = function () {
        // The Modern solution
        if (typeof window.innerWidth === 'number')
            return window.innerWidth > document.documentElement.clientWidth

        // rootElem for quirksmode
        var rootElem = document.documentElement || document.body

        // Check overflow style property on body for fauxscrollbars
        var overflowStyle

        if (typeof rootElem.currentStyle !== 'undefined')
            overflowStyle = rootElem.currentStyle.overflow

        overflowStyle = overflowStyle || window.getComputedStyle(rootElem, '').overflow

        // Also need to check the Y axis overflow
        var overflowYStyle

        if (typeof rootElem.currentStyle !== 'undefined')
            overflowYStyle = rootElem.currentStyle.overflowY

        overflowYStyle = overflowYStyle || window.getComputedStyle(rootElem, '').overflowY

        var contentOverflows = rootElem.scrollHeight > rootElem.clientHeight
        var overflowShown = /^(visible|auto)$/.test(overflowStyle) || /^(visible|auto)$/.test(overflowYStyle)
        var alwaysShowScroll = overflowStyle === 'scroll' || overflowYStyle === 'scroll'

        return (contentOverflows && overflowShown) || (alwaysShowScroll)
    }
})(jQuery);

// This Prevents that the footer overfloats the content and if the content doesn't have a scrollbar, the footer gets set to the bottom.
if ($('main').hasScrollBar()) {
    jQuery('.footer').removeClass('fixed-bottom');
} else {
    jQuery('.footer').addClass('fixed-bottom');
}