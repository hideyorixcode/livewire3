<?php

namespace App\PowerGridThemes;

use PowerComponents\LivewirePowerGrid\Themes\Bootstrap5;
use PowerComponents\LivewirePowerGrid\Themes\Components\Actions;
use PowerComponents\LivewirePowerGrid\Themes\Components\Checkbox;
use PowerComponents\LivewirePowerGrid\Themes\Components\Cols;
use PowerComponents\LivewirePowerGrid\Themes\Components\Editable;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterBoolean;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterDatePicker;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterInputText;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterMultiSelect;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterNumber;
use PowerComponents\LivewirePowerGrid\Themes\Components\FilterSelect;
use PowerComponents\LivewirePowerGrid\Themes\Components\Footer;
use PowerComponents\LivewirePowerGrid\Themes\Components\SearchBox;
use PowerComponents\LivewirePowerGrid\Themes\Components\Table;
use PowerComponents\LivewirePowerGrid\Themes\Components\Toggleable;
use PowerComponents\LivewirePowerGrid\Themes\Theme;

class bs5custom extends Bootstrap5
{
    public string $name = 'bootstrap5';

    public function table(): Table
    {
        return Theme::table('table table-bordered table-hover table-striped table-checkable table-highlight-head mb-2')
            ->div('table-responsive col-md-12', 'margin: 10px 0 10px;')
            ->thead('')
            ->thAction('', '')
            ->tdAction('')
            ->tr('')
            ->th('', '')
            ->tbody('')
            ->tdBodyEmpty('')
            ->tdBodyTotalColumns('')
            ->tdBody('');
    }

    public function cols(): Cols
    {
        return Theme::cols()
            ->div('')
            ->clearFilter('', 'color: #c30707; cursor:pointer; float: right;');
    }

    public function footer(): Footer
    {
        return Theme::footer()
            ->view($this->root().'.footer')
            ->select('');
    }

    public function actions(): Actions
    {
        return Theme::actions()
            ->tdBody('text-center')
            ->rowsBtn('');
    }

    public function toggleable(): Toggleable
    {
        return Theme::toggleable()
            ->view($this->root().'.toggleable');
    }

    public function editable(): Editable
    {
        return Theme::editable()
            ->view($this->root().'.editable')
            ->span('d-flex justify-content-between')
            ->button('width: 100%;text-align: left;border: 0;padding: 4px;background: none')
            ->input('form-control shadow-none');
    }

    public function checkbox(): Checkbox
    {
        return Theme::checkbox()
            ->th('d-flex justify-content-center', '')
            // ->div('form-check')
            // ->label('form-check-label')
            ->div('form-check-sm')
            ->input('form-check-input shadow-none');
    }

    public function filterBoolean(): FilterBoolean
    {
        return Theme::filterBoolean()
            ->view($this->root().'.filters.boolean')
            ->select('form-control form-select shadow-none');
    }

    public function filterDatePicker(): FilterDatePicker
    {
        return Theme::filterDatePicker()
            ->view($this->root().'.filters.date-picker')
            ->input('form-control shadow-none');
    }

    public function filterMultiSelect(): FilterMultiSelect
    {
        return Theme::filterMultiSelect()
            ->view($this->root().'.filters.multi-select');
    }

    public function filterNumber(): FilterNumber
    {
        return Theme::filterNumber()
            ->base(attrStyle: 'min-width: 85px !important')
            ->view($this->root().'.filters.number')
            ->input('form-control shadow-none');
    }

    public function filterSelect(): FilterSelect
    {
        return Theme::filterSelect()
            ->view($this->root().'.filters.select')
            ->select('form-control form-select shadow-none');
    }

    public function filterInputText(): FilterInputText
    {
        return Theme::filterInputText()
            ->base(attrStyle: 'min-width: 165px !important')
            ->view($this->root().'.filters.input-text')
            ->select('form-control mb-1 shadow-none form-select')
            ->input('form-control shadow-none');
    }

    public function searchBox(): SearchBox
    {
        return Theme::searchBox()
            ->input('col-12 col-sm-8 form-control form-control-sm')
            ->iconSearch('bi bi-search')
            ->iconClose('');
    }
}
