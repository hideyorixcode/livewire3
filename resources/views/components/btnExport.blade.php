<!--  Dropright menu  -->
<div class="btn-group dropstart">
    <button type="button" class="btn btn-sm btn-outline-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-fw fa-file-export me-2"></i> Export
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="javascript:exportToExcel('{{$title}}')"><i class="fas fa-fw fa-file-excel me-2"></i>Excel</a></li>
        <li><a class="dropdown-item" href="javascript:printTable('{{$title}}')"><i class="fas fa-fw fa-print me-2"></i>Print</a></li>
    </ul>
</div>
<!--  END : Dropright menu  -->
