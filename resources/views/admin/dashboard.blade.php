@extends('admin.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>
        <h1>Admin Panel</h1>
        <!-- /.content-header -->
        <!-- Main content -->
{{--        <section class="content bg-white p-5">--}}
{{--            <form action="{{route('admin')}}" class="col-3">--}}
{{--                <h5>sana</h5>--}}
{{--                <div class="form-group d-flex align-items-center">--}}
{{--                    <input type="date" required value="{{request()->from}}" class="form-control mr-2" name="from"> <label class="mr-2" for="dan"> dan</label>--}}
{{--                    <input type="date" required value="{{request()->to}}" class="form-control mr-2" name="to"> <label class="mr-2" for="gacha"> gacha</label>--}}
{{--                    <input type="submit" class="btn btn-success">--}}
{{--                </div>--}}
{{--            </form>--}}
{{--            <div class="container-fluid">--}}
{{--                <!-- Small boxes (Stat box) -->--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-info">--}}
{{--                            <div class="inner">--}}
{{--                                <h4>Barcha kodlar: {{ $codes }}</h4>--}}
{{--                                <h5>Foydalanilgan kodlar: {{ $codesActive }}</h5>--}}

{{--                                <p>Kodlar Haqida Ma'lumot</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="fas fa-code"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{ route('codes.index') }}" class="small-box-footer">Batafsil <i--}}
{{--                                    class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-success">--}}
{{--                            <div class="inner">--}}
{{--                                <h5>Jami Foydalanuvchilar: {{ $users }}</h5>--}}

{{--                                <h5>Kod kiritgan: {{ $codeUsers }}</h5>--}}

{{--                                <p>Foydalanuvchilar</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="fas fa-users"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{ route('users') }}" class="small-box-footer">Batafsil <i--}}
{{--                                    class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-warning">--}}
{{--                            <div class="inner">--}}
{{--                                <h5>Jami hududlar: {{ $regions }}</h5>--}}

{{--                                <h5>Aktiv hududlar: {{ $regionsActive }}</h5>--}}
{{--                                <p>Hududlar</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-person-add"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{ route('regions.index') }}" class="small-box-footer">Batafsil <i--}}
{{--                                    class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-danger">--}}
{{--                            <div class="inner">--}}
{{--                                <h5>Jami maxsulotlar: {{ $category }}</h5>--}}

{{--                                <h5>Aktiv maxsulotlar: {{ $productsActive }}</h5>--}}
{{--                                <p>Maxsulotlar</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-pie-graph"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{ route('category.index') }}" class="small-box-footer">More info <i--}}
{{--                                    class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                </div>--}}
{{--                <h4 class="text  mb-3 mt-3">Hududlar bo'yicha Foydalanuvchilar</h4>--}}
{{--                <div class="row">--}}
{{--                    @foreach($regionsUsers as $regionUser)--}}
{{--                        <div class="col-md-3">--}}
{{--                            <div class="card mini-stats-wid">--}}
{{--                                @if(request('from'))--}}
{{--                                    <div class="card-body">--}}
{{--                                        <a href="--}}
{{--                                        {{ route('usersCodes', 'region='.$regionUser->id.--}}
{{--                                        '&start_date='.request('from').'&end_date='.request('to')) }}">--}}
{{--                                            <div class="d-flex">--}}
{{--                                                <div class="flex-grow-1">--}}
{{--                                                    <p class="text-muted fw-medium">{{ $regionUser->name }}</p>--}}
{{--                                                        <h4 class="mb-0"><span style="font-size: 18px;">Foydalanuvchilar: </span> {{ $regionUser->dateFilter(request('from'), request('to'))->count() }}</h4>--}}
{{--                                                        <h4 class="mb-0"><span style="font-size: 18px;">Kod kiritganlar: </span> {{ $regionUser->dateFilter(request('from'), request('to'))->unique('user_id')->count() }}</h4>--}}
{{--                                                </div>--}}
{{--                                                <div class="flex-shrink-0 align-self-center">--}}
{{--                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">--}}
{{--                                        <span class="avatar-title">--}}
{{--                                            <i class="bx bx-user-check font-size-24"></i>--}}
{{--                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                @else--}}
{{--                                    <div class="card-body">--}}
{{--                                        <a href="{{ route('usersCodes', 'region='.$regionUser->id) }}">--}}
{{--                                            <div class="d-flex">--}}
{{--                                                <div class="flex-grow-1">--}}
{{--                                                    <p class="text-muted fw-medium">{{ $regionUser->name }}</p>--}}
{{--                                                        <h4 class="mb-0"><span style="font-size: 18px;">Foydalanuvchilar: </span> {{ $regionUser->users->count() }}</h4>--}}
{{--                                                        <h4 class="mb-0"><span style="font-size: 18px;">Kod kiritganlar: </span> {{ $regionUser->CodeUsers->unique('user_id')->count() }}</h4>--}}
{{--                                                </div>--}}
{{--                                                <div class="flex-shrink-0 align-self-center">--}}
{{--                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">--}}
{{--                                        <span class="avatar-title">--}}
{{--                                            <i class="bx bx-user-check font-size-24"></i>--}}
{{--                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <h4 class="text  mb-3 mt-3">Maxsulot bo'yicha Foydalanuvchilar</h4>--}}
{{--                <div class="row">--}}
{{--                    @foreach($productsUsers as $productUser)--}}
{{--                        <div class="col-md-3">--}}
{{--                            <div class="card mini-stats-wid">--}}
{{--                               @if(request('from'))--}}
{{--                                    <div class="card-body">--}}
{{--                                        <a href="--}}
{{--                                        {{ route('usersCodes', 'product='.$productUser->id.--}}
{{--                                        '&start_date='.request('from').'&end_date='.request('to')) }}">--}}
{{--                                            <div class="d-flex">--}}
{{--                                                <div class="flex-grow-1">--}}
{{--                                                    <p class="text-muted fw-medium">{{ $productUser->name }}</p>--}}
{{--                                                        <h4 class="mb-0"><span style="font-size: 18px;">Foydalanuvchilar: </span> {{ $productUser->dateFilter(request('from'), request('to'))->count() }}</h4>--}}
{{--                                                        <h4 class="mb-0"><span style="font-size: 18px;">Kod kiritganlar: </span> {{ $productUser->dateFilter(request('from'), request('to'))->unique('user_id')->count() }}</h4>--}}
{{--                                                </div>--}}
{{--                                                <div class="flex-shrink-0 align-self-center">--}}
{{--                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">--}}
{{--                                        <span class="avatar-title">--}}
{{--                                            <i class="bx bx-user-check font-size-24"></i>--}}
{{--                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                               @else--}}
{{--                                    <div class="card-body">--}}
{{--                                        <a href="{{ route('usersCodes','product='.$productUser->id) }}">--}}
{{--                                            <div class="d-flex">--}}
{{--                                                <div class="flex-grow-1">--}}
{{--                                                    <p class="text-muted fw-medium">{{ $productUser->name }}</p>--}}
{{--                                                        <h4 class="mb-0"><span style="font-size: 18px;">Foydalanuvchilar: </span> {{ $productUser->users->count() }}</h4>--}}
{{--                                                        <h4 class="mb-0"><span style="font-size: 18px;">Kod kiritganlar: </span> {{ $productUser->CodeUsers->unique('user_id')->count() }}</h4>--}}
{{--                                                </div>--}}
{{--                                                <div class="flex-shrink-0 align-self-center">--}}
{{--                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">--}}
{{--                                        <span class="avatar-title">--}}
{{--                                            <i class="bx bx-user-check font-size-24"></i>--}}
{{--                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                               @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div><!-- /.container-fluid -->--}}
{{--        </section>--}}
        <!-- /.content -->
    </div>

@endsection
