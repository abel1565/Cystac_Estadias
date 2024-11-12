<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\placeholder;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\{ PowerGridEloquent,
Rules\RuleActions};

final class TablaUsers extends PowerGridComponent
{
    use WithExport;
    public bool $showFilters = true;
    public bool $filtersOutside = false;
    public string $sortField = 'Users.id';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, 
                    Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
            Responsive::make()
                ->fixedColumns('id', 'name', Responsive::ACTIONS_COLUMN_NAME)
        ];
    }
   

    public function datasource(): Builder
    {
        return User::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('rol')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable()
                ->bodyAttribute('align:center')
                ,

            Column::make('Email', 'email')
                ->sortable()
                ->searchable()
                ->bodyAttribute('align:center'),


            Column::make('Rol', 'rol')
                ->sortable()
                ->searchable()
                ->bodyAttribute('align:center'),

            //Column::make('Created at', 'created_at_formatted', 'created_at')
              //  ->sortable(),

            Column::make('Fecha de creacion', 'created_at')
                ->sortable()
                ->searchable()
                ->bodyAttribute('align:center'),

            Column::action('Acciones')
                ->bodyAttribute('align:center'),
        ];
    }

    public function filters(): array
    {
        return [
            
                Filter::datetimepicker('created_at'),
                Filter::inputText('id'),
                Filter::inputText('email')->placeholder('Correo'),
                Filter::inputText('name')->placeholder('Nombre'),
                Filter::boolean( 'rol')
                    ->label('Administrador', 'Trabajador'),
                
    
            
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId)
    {
        return redirect()->route('edituser.update', ['id' => $rowId]);
        
    }

    public function actions(User $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->id()
                ->route('edituser.form',['id'=>'id'])
                ->class('pg-btn-white dark:ring-pg-primary-200 dark:border-pg-primary-100 dark:hover:bg-pg-primary-200 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-100')
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
}