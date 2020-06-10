<div class="modal fade" id="notifyProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="message text-center">
                    <form action="{{ route("subscribe") }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="product">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <p class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="{{ __("Your email address") }}">
                        </p>
                        <p class="form-group">
                            <input class="btn-cat" type="submit" value="加入">
                        </p>
                    </form>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

