<script src="{{ asset('/dist/libraries/jquery-3.6.1/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('/dist/libraries/bootstrap-5.0.2/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/dist/plugins/select2-4.1.0-rc.0/js/select2.min.js') }}"></script>
<script src="{{ asset('/user/templates/js/chart.umd.min.js') }}"></script>
<script src="{{ asset('/user/templates/js/main.min.js') }}"></script>
<script src="{{ asset('/user/customs/js/common.min.js') }}"></script>
<script src="{{ asset('/frontend/templates/js/owl.carousel.min.js') }}"></script>
<script src="https://kit.fontawesome.com/0a0371d9f8.js" crossorigin="anonymous"></script>

<script type="text/javascript">
    var SITE_URL = "{{ url('/') }}";
    var FIATDP = "{{ number_format(0, preference('decimal_format_amount', 2)) }}";
    var CRYPTODP = "{{ number_format(0, preference('decimal_format_amount_crypto', 8)) }}";

    $(document).ready(function() {
        $("#select_language").on("change", function() {
            if ($("#select_language select").val() == 'ar') {
                localStorage.setItem('lang', 'ar');
                let lang = $("#select_language select").val();

                $.ajax({
                    type: 'get',
                    url: '{{ url('change-lang') }}',
                    data: {
                        lang: lang
                    },
                    success: function(msg) {
                        if (msg == 1) {
                            location.reload();
                            $("html").attr("dir", "rtl");
                        }
                    }
                });

            } else {
                let lang = $("#select_language select").val();
                $.ajax({
                    type: 'get',
                    url: '{{ url('change-lang') }}',
                    data: {
                        lang: lang
                    },
                    success: function(msg) {
                        if (msg == 1) {
                            location.reload()
                            localStorage.setItem('lang', lang);
                            $("html").removeAttr("dir", "rtl");
                        }
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        var owl = $('.owl-carousel');

        // Check screen width on window resize
        $(window).resize(function() {
            checkScreenWidth();
        });

        // Check screen width on page load
        checkScreenWidth();

        // Function to check screen width and initialize or destroy Owl Carousel
        function checkScreenWidth() {
            if ($(window).width() < 992) { // Adjust the breakpoint as needed
                owl.owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: false,
                    autoplay: true,
                    autoplayTimeout: 3000,
										dots: false,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                    }
                });
            } else {
                owl.owlCarousel({
                    loop: false,
                    margin: 10,
                    nav: false,
                    autoplay: false,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                    }
                });
            }
        }
    });
</script>

@stack('js')
