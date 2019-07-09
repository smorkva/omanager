@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('order.store') }}" method="POST" >
            @csrf
            <div class="card">
                <div class="card-header">Создать новый заказ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Код</th>
                                <th>Наименование</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Сумма</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr class="table-primary">
                                <td colspan="5"><b>{{$group->name}}</b></td>
                            </tr>
                            @foreach($group->items as $item)
                            @if(array_key_exists($item->id, $buys))
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td class="text-right">{{ $buys[$item->id]['price'] }}</td>
                                <td class="text-right">{{ $buys[$item->id]['count'] }}</td>
                                <td class="text-right">{{ $buys[$item->id]['summ'] }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                            <tr class="table-success">
                                <td class="text-right" colspan="4"><b>Итого</b></td>
                                <td class="itog text-right">{{ $order->summ }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('order.index') }}" class="btn btn-danger">Назад</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection