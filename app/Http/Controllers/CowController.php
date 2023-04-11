<?php

namespace App\Http\Controllers;

use App\Models\Cow;
use App\Models\CowSituation;
use DateInterval;
use DateTime;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\View\View as ViewView;

const DIAS_DESMAMA = '205';
const DIAS_CIO = '45';
const DIAS_CRIA = '290';

class CowController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Illuminate/View
     */
    public function index()
    {
        $cows = Cow::all();
        foreach ($cows as $idx => $cow) {
            $cow = $this->trataDatas($cow);
            $cow->situacao = CowSituation::find($cow->cow_situation_id)->descricao;
        }
        return view('cows.index', ['cows' => $cows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $situacoes = CowSituation::all();
        return view('cows.create', ['situacoes' => $situacoes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->except('_token');
        Cow::create($dados);
        return redirect('/cows');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $situacoes = CowSituation::all();
        $cow = Cow::find($id);
        return view('cows.edit', ['cow' => $cow, 'situacoes' => $situacoes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cow  $cow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $cow = Cow::find($id);
        $cow->update([
            'nome' => $request->nome,
            'nascimento' => $request->nascimento,
            'dataprimeiracria' => $request->dataprimeiracria,
            'ultimacria' => $request->ultimacria,
            'litrosleite' => $request->litrosleite,
            'cow_situation_id' => $request->cow_situation_id
        ]);
        return redirect('/cows');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $cow = Cow::find($id);
        $cow->delete();
        return redirect('/cows');
    }


    /**
     * Trata datas e retorna Cow
     *
     * @param  \App\Models\Cow  $cow
     * @return \Illuminate\Http\Cow
     */
    public function trataDatas(Cow $cow)
    {
        $dataUltimaCria = new DateTime($cow->ultimacria);
        $dataUltimaCriaOriginal = clone $dataUltimaCria;
        $dataPrimeiraCria = new DateTime($cow->dataprimeiracria);
        $dataUltimaCria = new DateTime($cow->ultimacria);
        $dataUltimaCria = new DateTime($cow->ultimacria);
        $dataNascimento = new DateTime($cow->nascimento);


        $periodoCio = new DateInterval('P' . DIAS_CIO . 'D');
        $periodoDesmama = new DateInterval('P' . DIAS_DESMAMA . 'D');
        $periodoCria = new DateInterval('P' . DIAS_CRIA . 'D');

        $previsaoDesmama = $dataUltimaCria->add($periodoDesmama)->format('d/m/Y');
        $previsaoCio = $dataUltimaCria->add($periodoCio);
        $previsaoCria = $previsaoCio->add($periodoCria)->format('d/m/Y');

        $cow->previsaodesmama = $previsaoDesmama;
        $cow->previsaocria = $previsaoCria;
        $cow->dataprimeiracria = $dataPrimeiraCria->format('d/m/Y');
        $cow->ultimacria = $dataUltimaCriaOriginal->format('d/m/Y');
        $cow->nascimento = $dataNascimento->format('d/m/Y');


        return $cow;
    }
}
