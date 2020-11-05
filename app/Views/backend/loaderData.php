<style>
    @keyframes blink {
        50% {
            color: transparent
        }
    }

    .loader__dot {
        animation: 1s blink infinite
    }

    .loader__dot:nth-child(2) {
        animation-delay: 250ms
    }

    .loader__dot:nth-child(3) {
        animation-delay: 500ms
    }
</style>
<div class="loaderData alert alert-warning" role="alert">
    <div class="d-flex align-items-center">
        <strong>Memuat Data<span class="loader__dot">.</span><span class="loader__dot">.</span><span
                    class="loader__dot">.</span></strong>
        <div class="spinner-grow ml-auto" role="status" aria-hidden="true"></div>
    </div>
</div>