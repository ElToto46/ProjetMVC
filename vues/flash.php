<div class="alert alert-<?=$_SESSION['msgStyle'];?> alert-dismissible fade show" role="alert">
    <?=$_SESSION['msgTxt'];?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <script>
        $(document).ready(function (){
        $('.alert').alert();
    });
        </script>