
@if($blocks->isNotEmpty())
    <div class="html-blocks-container">
        <h2>Blocos de Html</h2>
        <hr>

        @foreach($blocks as $key => $block)

            <div class="block-item">

                @include('html-blocks::errors', [
                    'errorBagName' => 'htmlBlocksEditErrorBag_' . $block->id
                ])

                <form
                    action="{{ route('html-blocks.update', $block->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    <input type="hidden" name="old_block_{{ $block->id }}" value="1">
                    <input type="hidden" name="errorBag" value="htmlBlocksEditErrorBag_{{ $block->id }}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    @include('html-blocks::inputs', ['block' => $block])

                    <button type="submit" class="btn btn-success">Salvar</button>

                </form>

            </div>

        @endforeach
    </div>
@endif

<div class="html-blocks-form-container">

    <h2>Adicionar Bloco de Html</h2>
    <hr>

    @include('html-blocks::errors', ['errorBagName' => 'htmlBlocksCreateErrorBag'])

    <form
        action="{{ route('html-blocks.store') }}"
        method="POST"
        enctype="multipart/form-data">

        <input type="hidden" name="old_block_0" value="1">

        <input type="hidden" name="errorBag" value="htmlBlocksCreateErrorBag">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('html-blocks::inputs', ['block' => null])

        <button type="submit" class="btn btn-success">Salvar</button>

    </form>

</div>

<script>

    var errorId = 'html-block-errors';
    var el = document.getElementById(errorId);

    if(el) {
        el.scrollIntoView();
    }

</script>
