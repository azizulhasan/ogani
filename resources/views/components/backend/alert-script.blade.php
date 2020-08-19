<div>
    <script>
        var status = "<?php echo session('status') ?>";
        if(status != ''){
            setInterval(() => {
                document.querySelector('.alert-success').style.display= 'none';
                "<?php echo session()->forget('status')?>";
            }, 7000);
        }
       
        var errors = "<?php echo $errors->any(); ?>";
        if(errors !=''){
            setInterval(() => {
                document.querySelector('.alert-danger').style.display= 'none';
                "<?php echo session()->forget('errors')?>";
            }, 7000);
        }
    </script>
</div>