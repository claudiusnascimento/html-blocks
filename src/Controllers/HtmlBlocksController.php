<?php

namespace ClaudiusNascimento\HtmlBlocks\Controllers;

//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Exception;
use ClaudiusNascimento\HtmlBlocks\Models\HtmlBlock;
use ClaudiusNascimento\HtmlBlocks\Requests\HtmlBlocksRequest;

class HtmlBlocksController extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function store(HtmlBlocksRequest $request)
    {

        try {
            $block = HtmlBlock::create($request->all());
        } catch (Exception $e) {

            //dd($e->getMessage());
            \Log::error('HTML_BLOCKS_ERROR::');
            \Log::error($e->getTraceAsString());

            $error = env('APP_DEBUG', false) ?
                                $e->getMessage() :
                                'Erro ao cadastrar bloco de html';

            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($error, $request->get('errorBag', 'htmlBlocksCreateErrorBag'));
        }

        return redirect()->back();
    }

    public function update(HtmlBlocksRequest $request, $id)
    {
        dd('update', $request->all());
    }

    public function destroy($id)
    {
        dd('destroy', $request->all());
    }

}
