<?php

namespace App\DataTables;

use App\Models\Property;

class PropertyDataTable
{
    public function render()
    {
        return datatables()->of($this->query())
        ->setRowAttr([
            'data-url' => function($property) {
                return route('dashboard.property.show', $property);
            }
        ])
        ->filter(function($query){

            if(request()->has('search.value')) {

                $search = request('search.value');

                $query->where('descricao_curta', 'ilike', '%'.$search.'%')
                ->orWhere('descricao_detalhada', 'ilike', '%'.$search.'%')
                ->orWhere('endereco', 'ilike', '%'.$search.'%')
                ->orWhere('cidade', 'ilike', '%'.$search.'%')
                ->orWhere('bairro', 'ilike', '%'.$search.'%')
                ->orWhere('id', 'ilike', '%'.$search.'%')
                ->orWhere('funcao', 'ilike', '%'.$search.'%')
                ->orWhere('cep', 'ilike', '%'.$search.'%')
                ->orWhere('situacao', 'ilike', '%'.$search.'%')
                ->orWhere('descricao_detalhada', 'ilike', '%'.$search.'%')
                ->orWhere('uf', 'ilike', '%'.$search.'%');
            }

        })
        ->toJson();
    }

    private function query()
    {
        return Property::query();
    }
}
