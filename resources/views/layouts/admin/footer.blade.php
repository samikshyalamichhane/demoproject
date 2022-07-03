  <script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">
    $('textarea').summernote({
      placeholder: 'Content..',
      tabsize: 2,
      height: 150
    });
    // for image preview
    function handleUploadPreview() {
        console.log('handleUploadPreview');
        document.getElementById(event.target.dataset.previewElId).src = URL.createObjectURL(event.target.files[0]);
    }
</script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

@yield('third_party_scripts')

@stack('scripts')
</body>
</html>