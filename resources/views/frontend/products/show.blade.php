<h1>{{$product->name}}</h1>
<p>Price: {{$product->price}}</p>
<p>Description: {{$product->description}}</p>
<img src="{{asset('storage/'.$product->image)}}">
