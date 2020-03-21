<div class="modal fade" id="infoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="message text-center">
                    @if(Session::has('message'))
                        {{ Session::get('message') }}
                    @endif
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
@if(Session::has('message'))
    <script>
        jQuery(document).ready(function ($) {
            $("#infoModal").modal();
        })
    </script>
@endif
