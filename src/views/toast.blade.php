@if(Session::has('toast'))

<div class="position-fixed bottom-0 end-0 p-3 " style="z-index: 11">
    <div class="toast-container ">
        <div class="toast bg-dark text-light border border-secondary" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header bg-secondary text-light">
                <span class="icon-bell me-2 "></span>
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ Session::get('toast') }}
            </div>
        </div>
    </div>
</div>

@endif
{{ Session::forget('toast') }}


<script>
    $(document).ready(function() {
        $(".toast").toast('show');
    });
</script>
