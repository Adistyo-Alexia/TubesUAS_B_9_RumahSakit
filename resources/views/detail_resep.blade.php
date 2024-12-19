@extends('dashboard_konsultasi')

@section('title', 'Detail Resep')

@section('content')
<div class="container">
    <a href="{{ route('konsultasi') }}" class="text-decoration-none">
        ← Kembali
    </a>

    <div class="card mt-3">
        <div class="card-header">
            <h5 class="card-title">Detail Resep</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Tanggal Resep:</strong> {{ date('d/m/Y', strtotime($resep->tanggal_resep)) }}</p>
                    <p><strong>Status:</strong> {{ $resep->status }}</p>
                </div>
            </div>

            <div class="mb-4">
                <h6>Daftar Obat</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Dosis</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resep->detailResep as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $detail->obat->nama }}</td>
                                <td>{{ $detail->dosis }}</td>
                                <td>{{ $detail->jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($resep->catatan)
                <div class="mb-3">
                    <h6>Catatan:</h6>
                    <p>{{ $resep->catatan }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection