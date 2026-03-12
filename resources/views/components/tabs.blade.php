@props(['tabs' => []])

<div class="tabs">
  @foreach ($tabs as $tab)
  <div class="tab {{ $loop->first ? 'active-tab' : '' }}" data-tab="{{ $tab['name'] }}">
    <span>{{ $tab['label'] }}</span>
  </div>
  @endforeach
</div>