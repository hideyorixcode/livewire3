<div class="btn-group btn-group-sm" id="grupfilter">

    <div class="dropdown" id="columnToggleWrapper">
      <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="toggleColumnVisibility" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-fw fa-table-columns me-2"></i> Column Visibility
      </button>
      <ul class="dropdown-menu" id="columnDropdown" aria-labelledby="toggleColumnVisibility">

      </ul>
    </div>

    <a href="{{'javascript:openFilter()'}}" class="btn btn-outline-success"><span><i
                class="fas fa-fw fa-filter mr-sm-2"></i> <span
                class="d-none d-sm-inline-block">Filter Data</span></span></a>
    <a href="{{'javascript:resetFilterdata()'}}" class="btn btn-outline-danger"><span><i
                class="fas fa-fw fa-times mr-sm-2"></i> <span
                class="d-none d-sm-inline-block">Reset Filter</span></span></a>


</div>
