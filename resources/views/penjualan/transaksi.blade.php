@extends('layouts.main')
@section('content')
    <form id="produkForm" class="row g-3 needs-validation" novalidate>
      @csrf
      <div class="col-md-4">
        <label for="penjualanID" class="form-label">Nomor Transaksi</label>
        <input type="text" class="form-control" id="penjualanID" name="penjualanID" value="{{ $penjualan->penjualanID }}" readonly>
      </div>
      <div class="col-md-4">
        <label for="namaMember" class="form-label">Member</label>
        <select class="form-select" id="namaMember" name="namaMember">
          <option selected value="Bukan member">Bukan member</option>
          @foreach ($members as $member)
            <option value="{{ $member->nama }}">{{ $member->nama }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Mohon isi tanggal barang" value="{{ $penjualan->tanggal }}" readonly>
      </div>

      <div class="col-md-4">
        <label for="produkID" class="form-label">Produk</label>
        <select class="form-select" id="produkID" name="produkID">
          @foreach ($produks as $produk)
            <option 
              value="{{ $produk->produkID }}" 
              data-harga="{{ $produk->harga }}" 
              data-stok="{{ $produk->stok }}">
                {{ $produk->nama }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
      </div>
      <div class="col-md-4">
        <label for="subtotal" class="form-label">Subtotal</label>
        <input type="number" class="form-control" id="subtotal" name="subtotal" readonly>
      </div>

      <div class="col-12">
        <button class="btn btn-primary" id="tambahProduk" type="submit">Tambah</button>
        <a class="btn btn-danger" href="/penjualan/hapus{{ $penjualan->penjualanID }}" onclick="return confirm('Ingin membatalkan transaksi')">Batalkan Transaksi</a>
      </div>
    </form>
    <br><br>
    <h3>Keranjang</h3>
    <div class="table-responsive">
      <table class="table table-stripped table-hover ">
          <thead>
              <tr>
                  <th scope="col">No</th>
                  <th scope="col">Produk</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Subtotal</th>
                  <th scope="col">Aksi</th>
              </tr>
          </thead>
          <tbody>
            @if (isset($penjualan->detailPenjualan))
                @foreach ($penjualan->detailPenjualan as $detail)
                <tr>
                  <td>{{ $loop->iteration }}</td> 
                  <td>{{ $detail->produk->nama }}</td> 
                  <td>{{ $detail->jumlah }}</td> 
                  <td>{{ $detail->subtotal }}</td> 
                  <td><a class="btn btn-danger deleteBtn" id="deleteBtn" data-dID="{{ $detail->detailID }}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
            @endif
            <!-- ajax -->
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3">Total</th>
              <th colspan="2" id="totalCol">
                @if (isset($total)) 
                  {{ $total }}
                @endif
              </th>
            </tr>
          </tfoot>
      </table>
    </div>

    <form action="/penjualan/selesai{{ $penjualan->penjualanID }}" method ="POST" id="penjualanForm" class="row g-3 needs-validation" novalidate>
      @csrf
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <label for="totalAkhir" class="form-label">
              Total Akhir Diskon : 
                <span id="diskon">
                @if (isset($diskon)) 
                  {{ $diskon }}
                @else
                  0
                @endif
              </span>
              %
            </label>
            <input type="hidden" class="form-control" id="total" name="total"
              @if (isset($total)) 
                value="{{ $total }}"
              @endif>
            <input type="number" class="form-control" id="totalAkhir" name="totalAkhir" 
              @if (isset($totalAkhir)) 
                value="{{ $totalAkhir }}"
              @endif
            readonly>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <label for="bayar" class="form-label">Bayar</label>
            <input type="number" class="form-control" id="bayar" name="bayar" required>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <label for="kembalian" class="form-label">Kembalian</label>
            <div class="input-group">
              <input type="number" class="form-control" id="kembalian" name="kembalian" readonly>
              <div class="input-group-text">
                <button class="btn btn-success" id="selesaiBtn" type="submit" disabled>Selesai</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <script src="assets/js/keranjang.js"></script>
    <script src="assets/js/hitungTransaksi.js"></script>
@endsection