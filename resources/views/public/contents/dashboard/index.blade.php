@extends('public.index')
@section('heads')
    <title>Home</title>
@endsection
@section('content')
    @include('public.components.header')

    <div class="card card-body blur shadow-blur mx-3 mx-md-4">
        <section class="pt-3 pb-4" id="count-stats">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 mx-auto py-3">
                        <div class="row">
                            <div class="col-md-6 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary">
                                        <span id="state1" countTo="{{ count($categories) }}">0</span>+
                                    </h1>
                                    <h5 class="mt-3">Kategori Kue</h5>
                                    <p class="text-sm font-weight-normal">Dari best seller, short cake, lebaran kamu
                                        tercover</p>
                                </div>
                                <hr class="vertical dark">
                            </div>
                            <div class="col-md-6 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary">
                                        <span id="state2" countTo="{{ count($products) }}">0</span>+
                                    </h1>
                                    <h5 class="mt-3">Produk</h5>
                                    <p class="text-sm font-weight-normal">Campur bagiannya, ubah warnanya dan
                                        lepaskan kreativitas Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @livewire('product.product-section')
@endsection
@section('scripts')
    <script type="text/javascript">
        if (document.getElementById('state1')) {
            const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
        if (document.getElementById('state2')) {
            const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
            if (!countUp1.error) {
                countUp1.start();
            } else {
                console.error(countUp1.error);
            }
        }
        if (document.getElementById('state3')) {
            const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
            if (!countUp2.error) {
                countUp2.start();
            } else {
                console.error(countUp2.error);
            }
        }
    </script>

    <script>
        function scrollTo(sectionId) {
            var MIN_PIXELS_PER_STEP = 16;
            var MAX_SCROLL_STEPS = 30;
            var target = document.getElementById(elementId);
            var scrollContainer = target;
            do {
                scrollContainer = scrollContainer.parentNode;
                if (!scrollContainer) return;
                scrollContainer.scrollTop += 1;
            } while (scrollContainer.scrollTop == 0);

            var targetY = 0;
            do {
                if (target == scrollContainer) break;
                targetY += target.offsetTop;
            } while (target = target.offsetParent);

            var pixelsPerStep = Math.max(MIN_PIXELS_PER_STEP,
                (targetY - scrollContainer.scrollTop) / MAX_SCROLL_STEPS);

            var stepFunc = function() {
                scrollContainer.scrollTop =
                    Math.min(targetY, pixelsPerStep + scrollContainer.scrollTop);

                if (scrollContainer.scrollTop >= targetY) {
                    return;
                }

                window.requestAnimationFrame(stepFunc);
            };

            window.requestAnimationFrame(stepFunc);
        }
    </script>
@endsection
