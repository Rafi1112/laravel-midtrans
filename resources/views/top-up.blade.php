@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">TopUp Gems</div>

                    <div class="card-body">
                        <form action="{{ route('topup.store') }}" method="post">
                            @csrf
                            <h3>TopUp Form</h3>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <td>Select Gem's</td>
                                    <td>
                                        <select id="inputState" name="gems" class="form-control">
                                            @foreach($gems as $gem)
                                                <option value="{{ $gem->id }}">{{ $gem->title }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button type="submit" class="btn btn-primary float-right">Proceed</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

