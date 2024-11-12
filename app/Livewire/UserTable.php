<?php

namespace App\Livewire;

use App\Models\Egresos;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class UserTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Egresos::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('RFC_Emisor')
            ->add('Nombre_Emisor')
            ->add('RegimenFiscal_Emisor')
            ->add('RFC_Receptor')
            ->add('Nombre_Receptor')
            ->add('UsoCFDI')
            ->add('RegimenFiscalReceptor')
            ->add('DomicilioFiscalReceptor')
            ->add('Version')
            ->add('Serie')
            ->add('Folio')
            ->add('Fecha_formatted', fn (Egresos $model) => Carbon::parse($model->Fecha)->format('d/m/Y H:i:s'))
            ->add('Sello')
            ->add('NoCertificado')
            ->add('Certificado')
            ->add('TipoDeComprobante')
            ->add('FormaPago')
            ->add('MetodoPago')
            ->add('LugarExpedicion')
            ->add('SubTotal')
            ->add('Descuento')
            ->add('Total')
            ->add('TotalImpuestosTrasladados')
            ->add('TotalImpuestosRetenidos')
            ->add('CadenaOriginal')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('RFC Emisor', 'RFC_Emisor')
                ->sortable()
                ->searchable(),

            Column::make('Nombre Emisor', 'Nombre_Emisor')
                ->sortable()
                ->searchable(),

            Column::make('RegimenFiscal Emisor', 'RegimenFiscal_Emisor')
                ->sortable()
                ->searchable(),

            Column::make('RFC Receptor', 'RFC_Receptor')
                ->sortable()
                ->searchable(),

            Column::make('Nombre Receptor', 'Nombre_Receptor')
                ->sortable()
                ->searchable(),

            Column::make('UsoCFDI', 'UsoCFDI')
                ->sortable()
                ->searchable(),

            Column::make('RegimenFiscalReceptor', 'RegimenFiscalReceptor')
                ->sortable()
                ->searchable(),

            Column::make('DomicilioFiscalReceptor', 'DomicilioFiscalReceptor')
                ->sortable()
                ->searchable(),

            Column::make('Version', 'Version')
                ->sortable()
                ->searchable(),

            Column::make('Serie', 'Serie')
                ->sortable()
                ->searchable(),

            Column::make('Folio', 'Folio')
                ->sortable()
                ->searchable(),

            Column::make('Fecha', 'Fecha_formatted', 'Fecha')
                ->sortable(),

            Column::make('Sello', 'Sello')
                ->sortable()
                ->searchable(),

            Column::make('NoCertificado', 'NoCertificado')
                ->sortable()
                ->searchable(),

            Column::make('Certificado', 'Certificado')
                ->sortable()
                ->searchable(),

            Column::make('TipoDeComprobante', 'TipoDeComprobante')
                ->sortable()
                ->searchable(),

            Column::make('FormaPago', 'FormaPago')
                ->sortable()
                ->searchable(),

            Column::make('MetodoPago', 'MetodoPago')
                ->sortable()
                ->searchable(),

            Column::make('LugarExpedicion', 'LugarExpedicion')
                ->sortable()
                ->searchable(),

            Column::make('SubTotal', 'SubTotal')
                ->sortable()
                ->searchable(),

            Column::make('Descuento', 'Descuento')
                ->sortable()
                ->searchable(),

            Column::make('Total', 'Total')
                ->sortable()
                ->searchable(),

            Column::make('TotalImpuestosTrasladados', 'TotalImpuestosTrasladados')
                ->sortable()
                ->searchable(),

            Column::make('TotalImpuestosRetenidos', 'TotalImpuestosRetenidos')
                ->sortable()
                ->searchable(),

            Column::make('CadenaOriginal', 'CadenaOriginal')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('Fecha'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Egresos $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */

    //<livewire:user-table/>
}
