<div class="entry__lead my-4">
  {{ $ingress }}
</div>

<div class="entry__content">
  @php( the_content() )
</div>


@foreach($layouts as $layout)
  @include($layout['template'], ['data' => $layout['data']]);
@endforeach
