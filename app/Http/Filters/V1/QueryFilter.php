<?php
namespace App\Http\Filters\V1;

// use League\Uri\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter {
    protected $builder;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filter ($arr){
        foreach ($arr as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $this->builder;
    }

    //  abstract public function apply($builder);

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        // $filters = $this->request->query('filters', $this->request->all());

        foreach ($this->request->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $builder;
    }

    protected function sort($value){
        $sortAttributs = explode(",",$value);
        foreach ($sortAttributs as $sortAttributs) {
                $direction = "asc";
                if (strpos($sortAttributs, "-") === 0) {
                    $direction = "desc";
                    $sortAttributs = substr($sortAttributs, 1);
                }
                if(!in_array($sortAttributs , $this->sortable) && !array_key_exists($sortAttrides , $this->sortable) ){
                    continue;
                }
                $columnaem =$this->sortable [$sortAttributs] ?? null;
                if ($columnaem === null) {
                    $columnaem = $sortAttributs;
                }
                $this->builder->orderBy($sortAttributs , $direction);
            }
        }
    }
