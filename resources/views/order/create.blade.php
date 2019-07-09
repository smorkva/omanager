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
                            <tr data-price="{{ $item->price * 100 }}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td class="text-right">{{$item->price}}</td>
                                <td style="padding:5px;width: 140px;text-align:right">
                                    <div class="input-group">
                                        <input type="text" name="count[{{ $item->id }}]" class="form-control count" placeholder="Цена">
                                    </div>
                                </td>
                                <td class="text-right summ">
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            <tr class="table-success">
                                <td class="text-right" colspan="4"><b>Итого</b></td>
                                <td class="itog text-right"></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('order.index') }}" class="btn btn-danger">Отмена</a>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.count').on('keyup', function(){
            var tr = $(this).closest('tr')
            var price = tr.data('price')
            var count = $(this).val()

            var summ = price/100 * count
            tr.find('td.summ').html(summ)

            console.log($('.summ'))
            var summ = $('.summ')
                .toArray()
                .reduce(function(summ, item){
                    var i = parseFloat($(item).html().trim())

                    console.log('i', summ, i)

                    if(isNaN(i))
                        return summ
                    else 
                        return i + summ
                },0)
            $('.itog').html(summ)
        })
    })
</script>
@endsection