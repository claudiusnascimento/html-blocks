@if($errors->{$errorBagName}->any())
    <ul class="alert alert-danger">
        @foreach($errors->{$errorBagName}->all() as $error)
            <li style="list-style-type: none;">{{ $error }}</li>
        @endforeach
    </ul>
@endif
