$(document).ready(function () {

    // Hide show-password
    $('input[type=password]').each(function (index) {

        var $currentField = $(this),
            $currentFieldBackgroundSize,
            $currentFieldSpaceRightSize;

        $currentField.hideShowPassword({
            show: false,
            innerToggle: 'focus',
            toggle: {
                className: 'text-toggle'
            },
            states: {
                shown: {
                    toggle: {
                        content: $(this).attr('data-hide') || 'Hide'
                    }
                },
                hidden: {
                    toggle: {
                        content: $(this).attr('data-show') || 'Show'
                    }
                }
            }
        });

        // fix last-pass like services
        setTimeout(function() {
            $currentFieldBackgroundSize = $currentField.css('background-size').split(' ');
            $currentFieldSpaceRightSize = 0;

            for(var $currentFieldSide in $currentFieldBackgroundSize){
                // if width or height is set
                if($currentFieldBackgroundSize[$currentFieldSide]) {
                    var $currentBackgroundSize = parseInt($currentFieldBackgroundSize[$currentFieldSide].slice(0, -2));
                    // 35px as a threshold should be enough ?
                    if($currentBackgroundSize < 35 && $currentBackgroundSize > $currentFieldSpaceRightSize) {
                        $currentFieldSpaceRightSize = $currentBackgroundSize + (5 * (window.devicePixelRatio || 1));
                    }
                }
            }


            $currentField.parent('.hideShowPassword-wrapper').find('button[type=button]').css('right', $currentFieldSpaceRightSize + 'px');

        }, 500);

    });

});