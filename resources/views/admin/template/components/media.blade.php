@include('admin.template.components.modal.media')
@include('admin.template.components.modal.upload-media')
@include('admin.template.components.modal.detail-media')

@section('script')

<script>
let urlMediaStore = "{{ substr_replace(base64_encode(route('admin-media-store')), csrf_token(), 2, 0) }}";
let urlMediaLoadMore = "{{ substr_replace(base64_encode(route('admin-media-load-more')), csrf_token(), 2, 0) }}";
let urlMediaDetail = "{{ substr_replace(base64_encode(route('admin-media-detail')), csrf_token(), 2, 0) }}";
let urlMediaUpdate = "{{ substr_replace(base64_encode(route('admin-media-update')), csrf_token(), 2, 0) }}";
let urlMediaDestroy = "{{ substr_replace(base64_encode(route('admin-media-destroy')), csrf_token(), 2, 0) }}";
let urlMediaSearch = "{{ substr_replace(base64_encode(route('admin-media-search')), csrf_token(), 2, 0) }}";

</script>

<script src="{{ asset('admin/js/script-media.js') }}"></script>

@endsection
