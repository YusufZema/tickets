<?php

namespace App\Http\Filters\V1;

use Symfony\Component\CssSelector\Node\FunctionNode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TicketFilter extends QueryFilter{

    public function craeteadt($value){

        $dates = explode(",",$value);
        if ( count($dates) > 1) {
            return $this->builder->whereBetween("created_at", $dates);
        }
        return $this->builder->whereDate("created_at", $value);
    }

    public function include($value){
        return $this->builder->with(explode(",",$value));
    }


    public function status ($value)
        {
            return  $this->builder->wherein("status", explode(",",$value));
        }

    public function title ($value)
        {
            $linkeStr = str_replace("*", "%", $value);
            return  $this->builder->where("title", "like", $linkeStr);

        }

     public function updated($value){

        $dates = explode(",",$value);
        if ( count($dates) > 1) {
            return $this->builder->whereBetween("updated_at", $dates);
        }
        return $this->builder->whereDate("updated_at", $value);
    }
}
