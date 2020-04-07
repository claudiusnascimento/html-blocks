
<input type="hidden" name="rel" value="{{ $relationString }}">
<input type="hidden" name="rel_id" value="{{ $model_id }}">

@php
    $htmlBlocksFields = [
                'key' => 'Chave',
                'title' => 'Título',
                'sub_title' => 'Sub Título',
                'order' => 'Ordem'
            ];
@endphp

<div class="checkbox">
    <label>
      <input name="active" value="1" checked="{{ old('active', true) }}" type="checkbox"> Ativo
    </label>
</div>

@foreach($htmlBlocksFields as $key => $field)
    <div class="form-group">
        <label for="{{ $key }}">{{ $field }}:</label>
        <input type="text" name="{{ $key }}" value="{{ old($key, $block->{$key}) }}" class="form-control">
    </div>
@endforeach

<div class="form-group">
    <textarea name="content" class="{{ config('html-blocks.wysisyg_class') }}" cols="30" rows="10">{{ old('content', $block->content) }}</textarea>
</div>
