@extends('admin.master')
@section('module', 'book')
@section('action', 'Edit')

@section('content')

    <!-- main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        @include('admin.blocks.book.title')
                    </div>
                </div>
                <!-- end main title -->

                <!-- form -->
                <div class="col-12">
                    <form action="{{ route('admin.book.update', ['id' => $book->id]) }}" method="post" class="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row row--form">

                            <div class="col-12 col-md-5 customize-card form__cover">
                                <div class="row row--form">
                                    <div class="col-12 col-sm-6 col-md-12">
                                        <div class="form__img">
                                            <label for="form__img-upload">Upload cover (270 x 400)</label>
                                            <input id="form__img-upload" name="image" type="file"
                                                accept=".png, .jpg, .jpeg">
                                            <img id="form__img" src="{{ asset('uploads/covers') }}/{{ $book->image }}"
                                                alt="Errrol image!">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-7 form__content">
                                <div class="row row--form">

                                    <div class="col-12">
                                        <input type="text" name="name" class="form__input" value="{{ $book->name }}"
                                            placeholder="Name"> 
                                    </div>
 
                                    <div class="col-12">
                                        <textarea id="text" name="description" class="form__textarea" placeholder="Description">{{ $book->description }}</textarea>
                                    </div>

                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <input type="text" name="author" class="form__input"
                                            value="{{ $book->author }}" placeholder="Author">
                                    </div>
 
                                    <div class="col-12 col-lg-6">
                                        <select name="category_id" class="js-example-basic-multiple" id="genre">
                                            {{-- multiple="multiple" --}}
                                            <option  value="{{ $book->category_id }}" selected>
                                                @foreach ($category as $cate)
                                                    {{ $book->category_id == $cate->id ? $cate->name : '' }}
                                                @endforeach 
                                            </option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                  
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row row--form">
                                    <div class="col-12">
                                        <button type="submit" class="form__btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end form -->
            </div>
        </div>
    </main>
    <!-- end main content -->

@endsection
