<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componentes extends Model
{
    use HasFactory;

    public function formatacaoMascaraDinheiroDecimal($valorParaFormatar)
    {
        
        $tamanho = strlen($valorParaFormatar);
        $dados = str_replace(',', '.', $valorParaFormatar);
        If($tamanho <=6){
            $dados = str_replace(",", ".", $valorParaFormatar);
        } else{
            if($tamanho >= 8 && $tamanho <=10){
                $retiraVirgulaPorPonto = str_replace(',', '.', $valorParaFormatar);
                $separaPorIndice = explode('.', $retiraVirgulaPorPonto);
                $dados = $separaPorIndice[0] . $separaPorIndice[1];
            }
        }
        return $dados;
    }

    public function brl2decimal($brl, $casasDecimais = 2) {
        // Se já estiver no formato USD, retorna como float e formatado
        if(preg_match('/^\d+\.{1}\d+$/', $brl))
            return (float) number_format($brl, $casasDecimais, '.', '');
        // Tira tudo que não for número, ponto ou vírgula
        $brl = preg_replace('/[^\d\.\,]+/', '', $brl);
        // Tira o ponto
        $decimal = str_replace('.', '', $brl);
        // Troca a vírgula por ponto
        $decimal = str_replace(',', '.', $decimal);
        return (float) number_format($decimal, $casasDecimais, '.', '');
    }
}
