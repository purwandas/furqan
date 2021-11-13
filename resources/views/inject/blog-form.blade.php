@push('additional-css')
<style type="text/css">
    .padding-left-15px{
        padding-left: 15px;
    }
    .padding-right-0{
        padding-right: 0;
    }
</style>
@endpush
@push('additional-js')
<script type="text/javascript">
    var dataEdit = {};

    $(document).ready(function() {
        $('#blog_url').attr('name','protocol');
        $('#blog_url').attr('id','blog_protocol');
        $('#blog_protocol').parent().append('<input name="url" value="" class="col-md-9 form-control" type="text" id="blog_url" required="required" placeholder="Enter Url here">');
    });

    function onClearInject() {
        $('#blog_protocol').val('');
    }

    function onEditInject() {
        $('#blog_protocol').val(dataEdit.protocol).trigger('change');
    }

    function onEdit2Inject() {
        if (dataEdit.blog_categories != null) {
            $.each(dataEdit.blog_categories, function(k, v){
                setSelect2IfPatch($('#blog_blog_category_id'), v.blog_category_id, v.blog_category);
            });
        }
    }
</script>
@endpush