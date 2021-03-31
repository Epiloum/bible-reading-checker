@extends('layouts/with_header')

@section('title', '성경읽기표')
@section('headline', '성경읽기표')

@section('contents')
    <section>
        <table>
            @foreach ($books as $book)
                <tr id="book{{ $book->id }}">
                    <th>{{ $book->title }}</th>
                    <td>
                        @foreach ($book->chapters as $chapter)
                            <button @if($chapter->chapter <= 2) class="readed" @endif >{{ $chapter->chapter }}</button>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
