<div class="modal fade" id="notifyProductModal">
    <div class="modal-dialog">
        <form action="{{ route("product_notify") }}" method="POST" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="message text-center">

                        @csrf
                        <input type="hidden" name="action" value="product">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                    @auth
                        <input type="hidden" name="name" value="{{ @Auth::user()->name }}">
                        <input type="hidden" name="phone" value="{{ @Auth::user()->phone }}">
                    @endauth

                        <div class="form-group">
                            <input class="form-control" type="email" name="email" @auth value="{{ @Auth::user()->email }}" @endauth placeholder="{{ __("Your email address") }}">
                        </div>

                </div>
            </div>
            <div class="modal-footer text-center">
                <div class="form-group" style="width: 100%">
                    <input class="btn-cat" type="submit" value="加入" style="margin: 0">
                </div>
            </div>
        </form>
    </div>
</div>

