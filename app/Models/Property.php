<?php

namespace App\Models;

use App\Casts\BrazilianCurrency;
use App\Helpers\CurrencyFormatter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'dados_leiloes';

    protected $appends = [
        'ir',
        'price', 
        'cover',
        'short_address',
        'images',
        'viewed',
        'bookmarked',
        'data_leilao_praca_1',
        'data_leilao_praca_2',
        // 'views_count',
        'leilao_encerrado',
        'has_evaluation',
        'data_leilao_praca_1_passed',
        'data_leilao_praca_2_passed',
        'default_cover'
    ];

    protected $casts = [
        'avaliacao' => BrazilianCurrency::class,
        'valor_lance_inicial_praca_1' => BrazilianCurrency::class, 
        'valor_lance_inicial_praca_2' => BrazilianCurrency::class,
        'valor_lance_incremento' => BrazilianCurrency::class,
        'valor_lance_inicial' => BrazilianCurrency::class
    ];

    public function get() {
        //return $this->setConnection('mysql')->hasMany(PropertyView::class);
        return $this->setConnection('pgsql')->hasMany(PropertyView::class);
        //return PropertyView::property();
    }

    public function views()
    {
        return $this->setConnection('mysql')->hasMany(PropertyView::class);
        
    }

    public function getIrAttribute()
    {
        return 'ID'.$this->attributes['id'];
    }

    public function getSituacaoAttribute()
    {
        return strtoupper($this->attributes['situacao']);
    }

    public function getAreaTotalAttribute()
    {
        return round($this->attributes['area_total']);
    }

    public function getTipoAttribute()
    {
        return strtoupper($this->attributes['tipo']);
    }

    public function getShortAddressAttribute()
    {
        $address = str_replace('&nbsp;', ' ', $this->attributes['endereco']);

        return $address ? explode(',', $address)[0] : null;
    }

    public function getDataLeilaoPraca1Attribute()
    {
        return $this->attributes['data_leilao_praca_1'] ? Carbon::parse($this->attributes['data_leilao_praca_1'])->format('d/m/y') : null;
    }

    public function getDataLeilaoPraca2Attribute()
    {
        return $this->attributes['data_leilao_praca_2'] ? Carbon::parse($this->attributes['data_leilao_praca_2'])->format('d/m/y') : null;
    }
    
    
    public function getPriceAttribute()
    {

        $values = collect([
            CurrencyFormatter::clearCurrency($this->attributes['valor_lance_inicial_praca_1']),
            CurrencyFormatter::clearCurrency($this->attributes['valor_lance_inicial_praca_2'])
        ])
        ->filter();

        if($values->count() > 0) {
            return CurrencyFormatter::toBrazilianReal($values->min());
        } 

        return null;
        
    }

    public function getDefaultCoverAttribute()
    {
        return asset('img/imoveis/no-picture.png');
    }

    public function getCoverAttribute()
    {
        $url1 = $this->attributes['url1'];
        
        if(preg_match('/(\.jpg|\.png|\.bmp)$/', $url1)) {
            return $url1;
        }

        return asset('img/imoveis/no-picture.png');
    }

    public function getImagesAttribute()
    {
        return [
            $this->attributes['url1'],
            $this->attributes['url2'],
            $this->attributes['url3'],
            $this->attributes['url4'],
            $this->attributes['url5']
        ];
    }

    public function getViewedAttribute()
    {
        $history = collect(session('history'));

        return $history->contains((string)$this->attributes['id']);
    }

    public function getViewsCountAttribute()
    {
        return PropertyView::where('property_id', $this->attributes['id'])->count();
    }

    public function getLeilaoEncerradoAttribute()
    {

        if($this->attributes['data_leilao_praca_1']) {
            return Carbon::parse($this->attributes['data_leilao_praca_1'])->lessThanOrEqualTo(now());
        }

        if($this->attributes['data_leilao_praca_2']) {
            return Carbon::parse($this->attributes['data_leilao_praca_2'])->lessThanOrEqualTo(now());
        }

        return null;
        
    }

    public function getBookmarkedAttribute()
    {
        $history = collect(session('bookmarks'));

        return $history->contains((string)$this->attributes['id']);
    }

    public function getHasEvaluationAttribute()
    {

        if($this->avaliacao) {
            return CurrencyFormatter::clearCurrency($this->attributes['avaliacao']) > CurrencyFormatter::clearBrazilianCurrency($this->price);
        }

        return false;
    }

    public function getDataLeilaoPraca1PassedAttribute()
    {
        return Carbon::parse($this->attributes['data_leilao_praca_1'])->lessThanOrEqualTo(now());
    }

    public function getDataLeilaoPraca2PassedAttribute()
    {
        return Carbon::parse($this->attributes['data_leilao_praca_2'])->lessThanOrEqualTo(now());
    }

    public function scopeSearch($query, $params)
    {
        $search = $params['busca'] ?? null;
        $type = $params['tipo'] ?? null;
        $city = $params['cidade'] ?? null;
        $bedrooms = $params['quartos'] ?? null;
        $min = $params['min'] ?? null;
        $max = $params['max'] ?? null;
        $sort = $params['classificacao'] ?? null;

        if($sort) {

            if($sort == 'maior-preco') {
               // $query->orderBy('valor_lance_inicial_praca_1', 'desc');
                
            }

            if($sort == 'menor-preco') {
                //$query->orderBy('valor_lance_inicial_praca_1', 'asc');
            }

            if($sort == 'maior-desconto') {
                $query->whereNotNull('desconto')->orderBy('desconto', 'desc');
            }

            if($sort == 'menor-desconto') {
                $query->whereNotNull('desconto')->orderBy('desconto', 'asc');
            }

            if($sort == 'mais-recente') {
                $query->orderBy('created_at', 'desc');
            }

            if($sort == 'judicial') {
                $query->where('tipo', 'Judicial');
            }

            if($sort == 'extrajudicial') {
                $query->where('tipo', 'Extrajudicial');
            }

            if($sort == 'ocupado') {
                $query->where('situacao', 'Ocupado');
            }

            if($sort == 'desocupado') {
                $query->where('situacao', 'Desocupado');
            }

        }

        if($type) {
            $query->where('descricao', $type);
        }

        if($city) {
            $query->where('cidade', $city);
        }

        if($bedrooms) {

            if($bedrooms == '5') {
                $query->where('dormitorios', '>=', $bedrooms);    
            } else {
                $query->where('dormitorios', $bedrooms);
            }
        }

        if($min) {
            $query->where('valor_lance_inicial_praca_1', '>=', $min)
            ->orWhere('valor_lance_inicial_praca_2', '>=', $min);
        }

        if($max) {
            $query->where('valor_lance_inicial_praca_1', '<=', $max)
            ->orWhere('valor_lance_inicial_praca_2', '<=', $max);
        }

        if($search) {

            if(strtolower($search) == 'judicial') {
                $query->where('tipo', 'Judicial');
            }

            if(strtolower($search) == 'extrajudicial') {
                $query->where('tipo', 'Extrajudicial');
            }

            $query->where(function($query) use ($search) {
                // $query->where('descricao_curta', 'ilike', '%'.$search.'%')
                // ->orWhere('descricao_detalhada', 'ilike', '%'.$search.'%')
                // ->orWhere('endereco', 'ilike', '%'.$search.'%')
                // ->orWhere('cidade', 'ilike', '%'.$search.'%')
                // ->orWhere('bairro', 'ilike', '%'.$search.'%')
                // ->orWhere('descricao_curta', 'ilike', '%'.$search.'%');

                $query->where('descricao_curta', 'ilike', '%'.$search.'%')
                ->orWhere('descricao_detalhada', 'ilike', '%'.$search.'%')
                ->orWhere('endereco', 'ilike', '%'.$search.'%')
                ->orWhere('cidade', 'ilike', '%'.$search.'%')
                ->orWhere('bairro', 'ilike', '%'.$search.'%')
                ->orWhere('id', 'ilike', '%'.$search.'%')
                ->orWhere('funcao', 'ilike', '%'.$search.'%')
                ->orWhere('cep', 'ilike', '%'.$search.'%')
                ->orWhere('situacao', 'ilike', '%'.$search.'%')
                ->orWhere('uf', 'ilike', '%'.$search.'%');
            });

            
        }

        return $query;
        
    }
}
