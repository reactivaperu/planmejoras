<ul>
  @foreach( $encargados as $encargado )
  <li>{{ $encargado->name }}</li>
  @endforeach
</ul>