{{-- @if (Auth::check()) --}}
@extends('admin.master')
@section('module', 'Dashboard')
@section('action', 'Manage')
@section('content')

    <!-- main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="row row--grid">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        @include('admin.blocks.dashboard.title')
                        <a href="{{ route('admin.book.create') }}" class="main__title-link">Add Book</a>
                    </div>
                </div>
                <!-- end main title -->

                <!-- dashbox Latest books-->
                <div class="col-12">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3><i class="icon ion-ios-book"></i> List books</h3>
                        </div>

                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE COVER</th>
                                        <th>NAME BOOK</th>
                                        <th>CATEGORY</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @foreach ($data['books'] as $item)
                                        <tr>
                                            <td>
                                                <div class="main__table-text">{{ $item->id }}</div>
                                            </td>

                                            <td>
                                                <div class="main__table-img"><img
                                                        src="{{ asset('uploads/covers') }}/{{ $item->image }}"
                                                        alt="errol">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="main__table-text"><a href="#">{{ $item->name }} 2</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="main__table-text">
                                                    @foreach ($data['category']  as $cate)
                                                        {{ $item->category_id == $cate->id ? $cate->name : '' }}
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox Latest books-->

            </div>
        </div>
    </main>
    <!-- end main content -->
@endsection

{{-- @endif --}}
