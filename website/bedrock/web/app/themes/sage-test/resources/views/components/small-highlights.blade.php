<div class="small-highlights">
  @foreach($data as $highlight)
    <div class="small-highlights__item">
      <h3>
        <a href="{{ $highlight['link']['url'] }}">
          {{ $highlight['title'] }}
        </a>
      </h3>
      {{ $highlight['description'] }}
    </div>
  @endforeach
</div>
