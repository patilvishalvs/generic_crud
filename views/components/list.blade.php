<ul class="list-unstyled mb-0">
  @foreach($list as $item)
    <li>{{ $item[$column] }}</li>
  @endforeach
</ul>