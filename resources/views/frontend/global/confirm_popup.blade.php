<div class="modal fade" id="confirmModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="message text-center">
                    登出將會移除購物車商品，您確定嗎？
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cat" data-dismiss="modal" aria-label="Close">取消</button>
                <button class="btn-cat" onclick="document.querySelector('#frm-logout').submit();">確定</button>
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
