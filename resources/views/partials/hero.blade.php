<div class="jumbotron">
    <div class="container hero"
         style="background: url('{{ !empty($hero_image_uri) ? $hero_image_uri : asset('img/heroes/hero_apple.jpg') }}') no-repeat; background-size: 100%; background-position-y: -100px;">
        <p>{!! $hero_text !!}</p>
    </div>
</div>