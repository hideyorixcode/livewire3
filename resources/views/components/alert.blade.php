<div id="showAlertContainer" class="mb-3" style="display: none">
    <div id="myAlert" class="alert fade" role="alert">
        <strong><span id="alert_title"></span></strong> <span id="alert_text"></span>
    </div>
</div>
<?php
if (session('success') === true) {
    $alertType = 'success';
} else if (session('success') === false) {
    $alertType = 'danger';
} else {
    $alertType = null;
}
?>
@if(!empty($alertType))
    <div class="alert alert-{{$alertType}} alert-dismissible fade show" role="alert" id="alertSession">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif


