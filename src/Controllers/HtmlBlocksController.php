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

        $errorBag = $request->get('errorBag');

        try {

            $block = HtmlBlock::create($request->all());

        } catch (Exception $e) {

            //dd($e->getMessage());
            \Log::error('HTML_BLOCKS_ERROR::');
            \Log::error($e->getTraceAsString());

            $error = env('APP_DEBUG', false) ?
                                $e->getMessage() :
                                'Erro ao criar bloco de html';

            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($error, $errorBag);
        }

        session()->flash('block_message', [
                'type' => 'success',
                'message' => 'Bloco criado com sucesso'
            ]
        );

        return redirect()->back();

    }

    public function update(HtmlBlocksRequest $request, $id)
    {

        $block = HtmlBlock::where('rel', $request->get('rel'))->find($id);

        $errorBag = $request->get('errorBag');

        if(!$block) {

            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors('Bloco não encontrado', $errorBag);
        }

        try {

            $block = $block->update($request->all());

        } catch (Exception $e) {

            \Log::error('HTML_BLOCKS_ERROR::');
            \Log::error($e->getTraceAsString());

            $error = env('APP_DEBUG', false) ?
                                $e->getMessage() :
                                'Erro ao criar bloco de html';

            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($error, $errorBag);
        }

        session()->flash($errorBag, [
                'type' => 'success',
                'message' => 'Bloco editado com sucesso'
            ]
        );

        return redirect()->back();
    }

    public function destroy($id)
    {

        if($block = HtmlBlock::where('rel', $rel)->find($id))
        {
            $block->delete();
            session()->flash('block_message', [
                    'type' => 'success',
                    'message' => 'Bloco deletado com sucesso'
                ]
            );

            return redirect()->back();
        }

        session()->flash('block_message', [
                'type' => 'danger',
                'message' => 'Bloco não encontrado'
            ]
        );

        return redirect()->back();
    }

}
