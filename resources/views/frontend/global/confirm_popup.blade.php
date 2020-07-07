<script>
    function saveLogout(){
        document.getElementById("logout_action").value = "save_logout";
        document.querySelector('#frm-logout').submit();
    }
</script>
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
                    登出將會先儲存選擇商品，請確定？
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cat" onclick="document.querySelector('#frm-logout').submit();">移除</button>
                <button class="btn-cat" data-dismiss="modal" aria-label="Close">取消</button>
                <button class="btn-cat" onclick="saveLogout()" data-dismiss="modal" aria-label="Close">確定</button>
            </div>
        </div>
    </div>
</div>
