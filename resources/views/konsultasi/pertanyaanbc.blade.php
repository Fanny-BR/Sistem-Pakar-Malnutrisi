@extends('layouts.template-user')

@section('contents-user')

<style>

    /* Style the form */
    #regForm {
      background-color: #ffffff;
      margin: 100px auto;
      padding: 40px;
      width: 70%;
      margin-top: -30px;
      min-width: 300px;
    }

    /* Style the input fields */
    input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: Raleway;
      border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }

    /* Mark the active step: */
    .step.active {
      opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #4CAF50;
    }
    </style>


<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('user.home')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">Pertanyaan</a>
                </li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col">
            <div class="alert alert-success">Hallo, Silahkan Pilih Cek Berdasarkan Penyakit, Terimakasih.</div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Diagnosis Berdasarkan Penyakit</h4>
                        <form class="form-valide" action="{{route('diagnosabc')}}" method="post">
                            @csrf
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-outline-pink">Lanjutkan</button>
                              </div>

                     <div class="table-responsive">
                            <table id="table-diagnosa" class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr class="text-center">
                                        <th width="10px">No.</th>
                                        <th>Penyakit</th>
                                        <th>Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($penyakit as $item)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td width="500px"><span class="css-control-indicator"></span> {{$item->penyakit->nama_penyakit}}</label></td>
                                        <td width="100px" class="text-left">
                                            <label>
                                                <input type="radio" class="css-control-input" value="{{$item->kd_penyakit}}" name="penyakit">
                                            </label>
                                        </td>
                                    </tr>


                                    @empty
                                    <tr>
                                        <td colspan="12" class="text-center"><i>Belum ada data.</i></td>
                                    </tr>
                                    @endforelse

                                </tbody>

                            </table>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>



@endsection
@section('script')
<script>



    $('#table-diagnosa').DataTable( {
        paging   : false,
        ordering : false,
        info     : false,
        searching: false
} );

        </script>
@endsection
