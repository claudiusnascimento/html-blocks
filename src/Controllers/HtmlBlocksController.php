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

        return $this->doAction('create', $request);
    }

    public function update(HtmlBlocksRequest $request, $id)
    {
        return $this->doAction('update', $request);
    }

    public function destroy($id)
    {
        dd($id);

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
                'type' => 'error',
                'message' => 'Bloco não encontrado'
            ]
        );

        return redirect()->back();
    }

    public function doAction($action, $request)
    {
        try {
            $block = HtmlBlock::{$action}($request->all());
        } catch (Exception $e) {

            //dd($e->getMessage());
            \Log::error('HTML_BLOCKS_ERROR::');
            \Log::error($e->getTraceAsString());

            $error = env('APP_DEBUG', false) ?
                                $e->getMessage() :
                                'Erro ao '. ($action == 'create' ? 'criar' : 'atualizar') .' bloco de html';

            $bag = $action == 'create' ? 'Create' : 'Update';

            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($error, $request->get('errorBag', 'htmlBlocks'. $bag .'ErrorBag'));
        }

        session()->flash('block_message', [
                'type' => 'success',
                'message' => 'Bloco '. ($action == 'create' ? 'criado' : 'atualizado') .' com sucesso'
            ]
        );

        return redirect()->back();
    }

}
