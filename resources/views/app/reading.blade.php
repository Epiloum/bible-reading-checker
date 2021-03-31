@extends('layouts/with_header')

@section('title', '성경읽기표')
@section('headline', '성경읽기표')

@section('contents')
    <section>
        <table>
            @foreach ($books['구약'] as $id => $title)
                <tr id="book{{ $id }}">
                    <th>{{ $title }}</th>
                    <td>
                        @foreach ($chapters[$id] as $chapter => $chk_read)
                            <button @if($chk_read) class="readed" @endif >{{ $chapter }}</button>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
