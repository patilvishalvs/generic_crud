<ul class="list-unstyled">
  @foreach($list as $item)
    <li>{{ $item[$column] }}</li>
  @endforeach
</ul>