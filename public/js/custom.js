// JavaScript Document
// JavaScript Sticky Header Effect //


// JavaScript Slider Effect //


$(document).ready(function () {
    var owl = $('#home-slider');

    owl.owlCarousel({

        margin: 0,
        loop: true,
        autoplay: false,
        height: 400,
        dots: true,
        autoplayTimeout: 2000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navigation: true,
        nav: true,
        responsive: {

            0: {

                items: 1

            },

            480: {

                items: 1

            },

            680: {

                items: 1

            },

            1000: {

                items: 1

            }

        }

    });

});



$(document).ready(function () {
    var owl = $('#guide-slider');

    owl.owlCarousel({

        margin: 30,
        loop: true,
        autoplay: false,
        dots: false,
        autoplayTimeout: 2000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navigation: true,
        nav: true,
        responsive: {

            0: {

                items: 1

            },

            480: {

                items: 1

            },

            680: {

                items: 2

            },

            1000: {

                items: 3

            }

        }

    });

});

$(document).ready(function () {
    var owl = $('#rv-slider');

    owl.owlCarousel({

        margin: 30,
        loop: true,
        autoplay: false,
        dots: false,
        autoplayTimeout: 2000,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navigation: true,
        nav: true,
        responsive: {

            0: {

                items: 1

            },

            480: {

                items: 1

            },

            680: {

                items: 2

            },

            1000: {

                items: 4

            }

        }

    });

});

// JavaScript Scroll Effect //

jQuery(document).ready(function () {
    jQuery('.container').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated fadeInUp',
        offset: 100
    });
});

// JavaScript Toggle Effect //

$(document).ready(function () {
    $(".category-list").click(function () {
        $(".toggle-cat").slideToggle();
    });
});

$(document).ready(function () {
    $(".msearch").click(function () {
        $(".mob-search").slideToggle();
    });
});

$(document).ready(function () {
    $(".dash-left h3 img").click(function () {
        $(".dash-left ul").slideToggle();
    });
});


//FAQ Action
var action = 'click';
var speed = "500";
//Document.Ready
$(document).ready(function () {
    //Question handler
    $('li.q').on(action, function () {
        //gets next element
        //opens .a of selected question
        $(this).next().slideToggle(speed)
        //selects all other answers and slides up any open answer
            .siblings('li.a').slideUp();

        //Grab img from clicked question
        var img = $(this).children('img');
        //Remove Rotate class from all images except the active
        $('img').not(img).removeClass('rotate');
        //toggle rotate class
        img.toggleClass('rotate');

    });//End on click

});//End Ready


window.onscroll = function () {
    myFunction()
};

var header = document.getElementById("header");
var sticky = header.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}

/**
 * Angular
 * @type {angular.Module}
 */
var app = angular.module("cat", ["ngSanitize"]);
app.controller("catCtrl", function ($scope, $http) {



    $scope.product = {};
    $scope.order = {delivery: "pickup"};

    $scope.getFrames = function () {
        $scope.frames = [
            {
                name: "白橡木",
                time: 3
            },
            {
                name: "紅柚木",
                time: 5
            },
            {
                name: "古銅金",
                time: 7
            }
        ]
    };

    $scope.getThickness = function () {
        $scope.thickness =  [
            {
                name: "3CM",
                value: 3
            },
            {
                name: "5CM",
                value: 5
            }
        ]
    };

    $scope.$watch("order.delivery", function (value) {
        if(typeof value === 'undefined') return;

        $scope.order.shipping_fee = value === 'shipping' ? 30 : 0;
        $scope.calculatePrice();
    });

    $scope.calculatePrice = function () {
        console.log($scope.product);

        $scope.result = {
            frame: $scope.product.frame,
            thickness: $scope.product.thickness,
            totalLength: $scope.product.totalLength,
            shipping_fee: $scope.order.shipping_fee,
            price: Math.round($scope.product.thickness + $scope.product.totalLength * 2*1.2)
        }
    };

    $scope.resetSelection = function () {
        $scope.product = {};
        $scope.order = {delivery: "pickup"};
        $scope.calculatePrice();
    }
});
