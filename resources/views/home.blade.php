@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hola, {{Auth::user()->name}}</div>
                    <div class="card-body">
                        <form action="{{route('mensajes')}}" method="get">
                            @csrf
                            <select name="idUsuario" id="" style="width: 85%;">
                                <option value="" selected></option>
                                @if(isset($idusuario))
                                    @for ($i = 0; $i < count($usuarios); $i++)
                                        @if ($idusuario == $usuarios[$i]['id'])
                                            <option value="{{$usuarios[$i]['id']}}"
                                                    selected>{{$usuarios[$i]['name']}}</option>
                                        @else
                                            <option value="{{$usuarios[$i]['id']}}">{{$usuarios[$i]['name']}}</option>
                                        @endif

                                    @endfor
                                @else
                                    @for ($i = 0; $i < count($usuarios); $i++)
                                        <option value="{{$usuarios[$i]['id']}}">{{$usuarios[$i]['name']}}</option>
                                    @endfor
                                @endif
                            </select>
                            <input type="submit" value="Escoger">
                        </form>
                        @if (isset($mensajes))
                            @if (count($mensajes) > 0)
                                <div style="width: 100%;">
                                    <table style="width: 100%; border: 1px solid #0000;">
                                        @for ($a = 0; $a < count($mensajes); $a++)
                                            @if ($mensajes[$a]['emisor']['id'] == Auth::user()->id)
                                                <tr>
                                                    <td></td>
                                                    <td>{{$mensajes[$a]['mensaje']}}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>{{$mensajes[$a]['mensaje']}}</td>
                                                    <td></td>
                                                </tr>
                                            @endif

                                        @endfor
                                    </table>
                                </div>
{{--                                                            {{dd($mensajes)}}--}}
                            @endif
                        @endif

                        @if(isset($idusuario))
                            <form action="{{route('mensajes.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="idusuario" value="{{$idusuario}}">
                                <textarea name="mensaje" style="width: 100%; height: 10vh;"
                                          placeholder="Tu mensaje !"></textarea>
                                <input type="submit" value="Enviar">
                            </form>
                        @else
                            <h2>Por favor escoga con quien quiere hablar</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
