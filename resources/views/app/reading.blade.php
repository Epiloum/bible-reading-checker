@extends('layouts/with_header')

@section('title', '성경읽기표')
@section('headline', '성경읽기표')

@section('contents')
    <section>
        <table>
            <tr>
                <th>창세기</th>
                <td>
                    @for ($i = 1; $i <= 50; $i++)
                        <button @if($i <= 17) class="readed" @endif >{{ $i }}</button>
                    @endfor
                </td>
            </tr>
            <tr>
                <th>출애굽기</th>
                <td>
                    @for ($i = 1; $i <= 40; $i++)
                        <button>{{ $i }}</button>
                    @endfor
                </td>
            </tr>
            <tr>
                <th>레위기</th>
                <td>
                    @for ($i = 1; $i <= 27; $i++)
                        <button>{{ $i }}</button>
                    @endfor
                </td>
            </tr>
        </table>
    </section>
@endsection
