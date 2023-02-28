@section('title', 'Post Select | UB-S.E.V.M.S.')
@extends('layouts.app')

@section('main-content')
<div class="col-md-12">

    <div class="row justify-content-center">
                <h2><b>S E L E C T &nbsp</b><b style="color: #bb2124">P O S T</b></h2>
    </div>
    <hr style="background-color: #bb2124; height:2px;">

                  <form method="POST" action="{{ route('post.select') }}">
                    @csrf
                    @method('PUT')

                    @include('includes.messages')

                        <div class="form-group row justify-content-center">

                            

                            <div class="col-md-4">
                                <select style="color: black;" class="form-control" id="post" name="post" required="">
                                    @if (old('post') != '')
                                        <option value="{{old('post')}}" selected>{{old('post')}}</option>
                                    @else
                                        <option class="text-center" value="" disabled="" selected="">Select from the provided list.</option>
                                    @endif
                                    <option value="Main Gate">Main Gate</option>

                                    <option class="text-center" value="" disabled>
                                    ---------- "A" - FB BUILDING ----------
                                    </option>
                                    <option value="A-Entrance 1">Entrance 1</option>
                                    <option value="A-Entrance 2">Entrance 2</option>

                                    <option class="text-center" value="" disabled>
                                    ---------- "B" - AMS BUILDING ----------
                                    </option>
                                    <option value="B-Entrance 1">Entrance 1</option>
                                    <option value="B-Entrance 2">Entrance 2</option>

                                    <option class="text-center" value="" disabled>
                                    ---------- "D" - AU GYM/ICT BUILDING ----------
                                    </option>
                                    <option value="D-Entrance 1">Entrance 1</option>
                                    <option value="D-Entrance 2">Entrance 2</option>

                                    <option class="text-center" value="" disabled>
                                   ---------- "F" UB SQUARE-BAA BUILDING ----------
                                    </option>
                                    <option value="F-Entrance 1">Entrance 1</option>
                                    <option value="F-Entrance 2">Entrance 2</option>
                                    <option value="F-Entrance 3">Entrance 3</option>
                                    <option value="F-Entrance 4">Entrance 4</option>

                                    <option class="text-center" value="" disabled>
                                    ---------- "H" - CENTENNIAL BUILDING ----------
                                    </option>
                                    <option value="C-Entrance 1">Entrance 1</option>
                                    <option value="C-Entrance 2">Entrance 2</option>

                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-danger">
                                <b class="fas fa-save"> </b> <b>{{ __('S A V E') }}</b>
                            </button>
                        </div>
                  </form>

</div>
@endsection
