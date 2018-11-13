<?php

namespace App\Http\Controllers;

require "/var/www/public/simplehtmldom_1_5/simple_html_dom.php";

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Carros;

class CarrosController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {    

        //TARGET URL
        $url = 'https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/BMW/modelo/1239/usuario/todos';

        //Cria DOM da URL
        $html = file_get_html($url, false, null, 0);

        //Array principal que armazenas todos os dados dos carros
        $arrDadosCarros = array();

        //Busca marca e modelo no título principal
        $arrMarcaModelo = array();
        foreach ($html->find('dd[class="titulo-busca"]') as $key => $titulo) {
            $arrTemp = explode(" ", $titulo->plaintext);
            $arrMarcaModelo[$key] = $arrTemp;
        }

        foreach ($arrMarcaModelo as $key => $value) {
            $arrDadosCarros[$key]['marca'] = $arrMarcaModelo[$key][0];
            $arrDadosCarros[$key]['modelo'] = $arrMarcaModelo[$key][1];
        }

        //Busca o preço
        $arrPreco = array();
        foreach ($html->find('span[class="preco_busca"]') as $key => $preco) {
            $arrPreco[$key] = $preco->plaintext;
        }

        foreach ($arrPreco as $key => $value) {
            $valor = (preg_replace("/[^0-9]/", "", $value))/100;
            $valorFormatado = number_format($valor, 2, '.', '');
            $arrDadosCarros[$key]['preco'] = $valorFormatado;
        }

        //Busca o ano de fabricação e ano de modelo
        $arrAno = array();
        foreach ($html->find('div[class="bg-nitro-mais-home"]') as $key => $ano) {
            $arrTemp = explode(" ", $ano->plaintext);
            $arrAno[$key] = $arrTemp;
        }

        foreach ($arrAno as $key => $value) {
            $arrAnoTemp = explode("/", $arrAno[$key][3]);
            $arrDadosCarros[$key]['ano-fabricacao'] = $arrAnoTemp[0];
            $arrDadosCarros[$key]['ano-modelo'] = $arrAnoTemp[1];
        }

        //Busca o código
        $arrCodigo = array();
        foreach ($html->find('dt a') as $key => $codigo) {
            $arrCodigoTemp = explode("/", $codigo->href);
            $arrCodigo[$key] = $arrCodigoTemp;
        }

        foreach ($arrCodigo as $key => $value) {
            $arrDadosCarros[$key]['cod-carro'] = $arrCodigo[$key][5];
        }

        //Busca a url
        foreach ($html->find('dt a') as $key => $link) {
            $arrDadosCarros[$key]['url-carro'] = $link->href;
        }

        /**
         * Itera sobre o array principal $arrDadosCarro
         * Pega todas as informações encontradas
         * Realiza a inserção na tabela carros
         */
        foreach ($arrDadosCarros as $key => $value) {
            Carros::create(['marca' => $arrDadosCarros[$key]['marca'], 'modelo' => $arrDadosCarros[$key]['modelo'], 'ano_fabricacao' => $arrDadosCarros[$key]['ano-fabricacao'], 'ano_modelo' => $arrDadosCarros[$key]['ano-modelo'], 'preco' => $arrDadosCarros[$key]['preco'], 'cod_carro' => $arrDadosCarros[$key]['cod-carro'], 'url_carro' => $arrDadosCarros[$key]['url-carro']]);
        }

        //Exibe as informações no browser
        return view('carros.show', ['arrDadosVeiculos' => Carros::all()]);

    }

}
