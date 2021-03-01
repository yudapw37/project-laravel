@extends('main.mainOther')

@section('title', 'Aqwam')

@section('body')

    <div class="container container-240 catleft cAtas" style="margin-bottom:40px;">
      <div class="conOutterHistory">
        <div style="overflow:auto;">
          <div style="min-width:500px;padding:0 5px;">
            <!-- sebelum diulas -->
            <div class="conInnerHistory">
              <table class="w-100">
                <tr>
                  <td style="padding:5px 10px;width:120px;">
                    <img src="{{$getBaseUrl}}img/product/samsung.jpg" style="max-width:100px;" alt="Futurelife">
                  </td>
                  <td style="max-width: 250px;min-width:200px;">
                    <a href="#" style="" class="text-danger text-bold">isi judul buku di sebelah sini  aaaaaaaaaaa</a>
                  </td>
                  <td style="padding-left:10px;width: 54px!important;">
                    <p style="width:44px">rating </p>
                  </td>
                  <td>
                    <select style="width:38px;" class="form-control" name="rating">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td style="padding: 0 10px;" class="w-50">
                    <input type="submit" class="btn btn-success" style="float:right" name="simpan" value="simpan">
                  </td>
                </tr>
              </table>
              <div style="padding:5px 10px;">
                <textarea  class="form-control w-100" name="ulasan" rows="4"></textarea>
              </div>
            </div>
            <!-- sesudah diulas -->
            <div class="conInnerHistory">
              <table class="w-100">
                <tr>
                  <td style="padding:5px 10px;width:120px;">
                    <img src="{{$getBaseUrl}}img/product/samsung.jpg" style="max-width:100px;" alt="Futurelife">
                  </td>
                  <td style="max-width: 250px;min-width:200px;">
                    <a href="#" style="" class="text-danger text-bold">isi judul buku di sebelah sini  aaaaaaaaaaa</a>
                  </td>
                  <td style="padding-left:10px;width: 54px!important;">
                    <p style="width:44px">rating </p>
                  </td>
                  <td>
                    <select style="width:38px;" class="form-control" name="rating" disabled>
                      <option>1</option>
                      <option>2</option>
                      <option selected>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td style="padding: 0 10px;" class="w-50">
                    <input type="submit" class="btn btn-success " style="float:right" name="simpan" value="simpan" disabled>
                  </td>
                </tr>
              </table>
              <div style="padding:5px 10px;">
                <textarea  class="form-control w-100" name="ulasan" rows="4" disabled>tampilan ketika barang sudah di ulas</textarea>
              </div>
            </div>
            <div class="conInnerHistory">
              <table class="w-100">
                <tr>
                  <td style="padding:5px 10px;width:120px;">
                    <img src="{{$getBaseUrl}}img/product/samsung.jpg" style="max-width:100px;" alt="Futurelife">
                  </td>
                  <td style="max-width: 250px;min-width:200px;">
                    <a href="#" style="" class="text-danger text-bold">isi judul buku di sebelah sini  aaaaaaaaaaa</a>
                  </td>
                  <td style="padding-left:10px;width: 54px!important;">
                    <p style="width:44px">rating </p>
                  </td>
                  <td>
                    <select style="width:38px;" class="form-control" name="rating" disabled>
                      <option>1</option>
                      <option>2</option>
                      <option selected>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td style="padding: 0 10px;" class="w-50">
                    <input type="submit" class="btn btn-success " style="float:right" name="simpan" value="simpan" disabled>
                  </td>
                </tr>
              </table>
              <div style="padding:5px 10px;">
                <textarea  class="form-control w-100" name="ulasan" rows="4" disabled>tampilan ketika barang sudah di ulas</textarea>
              </div>
            </div>
            <div class="conInnerHistory">
              <table class="w-100">
                <tr>
                  <td style="padding:5px 10px;width:120px;">
                    <img src="{{$getBaseUrl}}img/product/samsung.jpg" style="max-width:100px;" alt="Futurelife">
                  </td>
                  <td style="max-width: 250px;min-width:200px;">
                    <a href="#" style="" class="text-danger text-bold">isi judul buku di sebelah sini  aaaaaaaaaaa</a>
                  </td>
                  <td style="padding-left:10px;width: 54px!important;">
                    <p style="width:44px">rating </p>
                  </td>
                  <td>
                    <select style="width:38px;" class="form-control" name="rating" disabled>
                      <option>1</option>
                      <option>2</option>
                      <option selected>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </td>
                  <td style="padding: 0 10px;" class="w-50">
                    <input type="submit" class="btn btn-success " style="float:right" name="simpan" value="simpan" disabled>
                  </td>
                </tr>
              </table>
              <div style="padding:5px 10px;">
                <textarea  class="form-control w-100" name="ulasan" rows="4" disabled>tampilan ketika barang sudah di ulas</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection
