// JavaScript Document
// JavaScript Sticky Header Effect //


// JavaScript Slider Effect //

Number.prototype.round = function () {
    return Math.round(this);
}

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


    $scope.filter = {
        page: 1,
        min: 0,
        max: 100000,
        brands: [],
        origins: [],
        pieces: [],
        category_id: typeof category_id === "undefined" ? null : category_id,
        sort: typeof sort === "undefined" ? null : sort,
        order: typeof order === 'undefined' ? null: order,
        orderBy: typeof orderBy === 'undefined' ? null: orderBy,
        perPage: typeof perPage === "undefined" ? 9 : perPage
    };
    $scope.product = {};
    $scope.paged_data = {};
    $scope.order = {
        items: {},
        delivery: "pickup",
        create_account: false,
        payment_method: "ecpay",
        preference_discount: 0,
        country: "Taiwan"
    };

    $scope.getShippingFee = function () {
        $http.get("/api/get_shipping_fee").then(function (res) {
            console.log(res.data);
        })
    };

    $scope.toggleCreateAccount = function () {
        $scope.order.create_account = !$scope.order.create_account;
    };

    $scope.$on("update_range_slide", function (event, range) {

        $scope.filter.min = range[0];
        $scope.filter.max = range[1];

        $scope.filterProduct();

    });

    $scope.setPage = function (p) {
        $scope.filter.page = p;
        $scope.filterProduct();
    };

    $scope.filterProduct = function () {

        $scope.filter.origins_arr = $scope.filter.origins.reduce(function (t, e, i) {
            if (e === true) t.push(i);
            return t;
        }, []);

        $scope.filter.brands_arr = $scope.filter.brands.reduce(function (t, e, i) {
            if (e === true) t.push(i);
            return t;
        }, []);

        $scope.filter.pieces_arr = $scope.filter.pieces.reduce(function (t, e, i) {
            if (e === true) t.push(i);
            return t;
        }, []);

        console.log($scope.filter);


        $http.post("/api/getProducts", $scope.filter).then(function (res) {
            $scope.paged_data = res.data;
            $scope.paged_data.totalPage = Math.ceil($scope.paged_data.total_items / $scope.paged_data.perPage);

            console.log($scope.paged_data);

        })
    };


    $scope.getFrames = function () {

        $http.get("/api/frames").then(function (res) {
            $scope.frames = res.data;
        })
    };

    $scope.getThickness = function () {
        $scope.thickness = [
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
        if (typeof value === 'undefined') return;

        if (value === 'shipping') {
            $http.get("/api/shipping_fee").then(function (res) {
                $scope.order.shipping_fee = res.data;

                $scope.calculatePrice();
            })
        } else {
            $scope.order.shipping_fee = 0;
            $scope.calculatePrice();
        }


    });

    $scope.calculatePrice = function () {
        console.log($scope.product);

        $scope.result = {
            frame: $scope.product.frame,
            thickness: $scope.product.thickness,
            totalLength: $scope.product.totalLength,
            shipping_fee: $scope.order.shipping_fee,
            price: Math.round($scope.product.thickness + $scope.product.totalLength * 2 * 1.2)
        };

        if (typeof $scope.result.frame !== 'undefined')
            $http.post("/api/create_customized_product", JSON.stringify({
                frame_id: $scope.result.frame.id,
                thickness: $scope.result.thickness,
                total_length: $scope.result.totalLength

            })).then(function (res) {
                console.log(res.data);
                $scope.customized_product = res.data;
            })
    };

    $scope.resetSelection = function () {
        $scope.product = {};
        $scope.order = {delivery: "pickup"};
        $scope.calculatePrice();
    };


}).filter('range', function () {
    return function (input, min, max) {
        min = parseInt(min); //Make string input int
        max = parseInt(max);
        for (var i = min; i < max; i++)
            input.push(i);
        return input;
    };
}).directive("rangeSlide", function () {
    return {
        restrict: "A",
        compile: function (element) {

            $("#min-price, #max-price").on("change", function (e) {

                console.log(e)

                var min_price_range = parseInt(angular.element("#min_price").val());

                var max_price_range = parseInt(angular.element("#max_price").val());


                angular.element(element).slider({
                    values: [min_price_range, max_price_range]
                });


            });

            return function (scope, element, iAttrs, controller, $timeout) {
                angular.element(element).slider({
                    range: true,
                    orientation: "horizontal",
                    min: 0,
                    max: 4000,
                    values: [0, 4000],
                    step: 100,

                    change: function (e, ui) {
                        scope.$emit("update_range_slide", ui.values);
                    },

                    slide: function (event, ui) {
                        if (ui.values[0] === ui.values[1]) {
                            return false;
                        }

                        angular.element("#min_price").val(ui.values[0]);
                        angular.element("#max_price").val(ui.values[1]);
                    }
                });

            }
        }
    }
});
