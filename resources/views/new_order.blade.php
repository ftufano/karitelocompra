@extends('backoffice_layout')

@section('new_order_title')
    @lang('webtags.company_name') | @lang('New List')
@endsection

@section('new_order_header')
  <link href="css/order-generator.css" rel="stylesheet">
@endsection

@section('username')

@if (Session::has('userName'))

  {{ Session::get('userName') }}
    
@endif

@endsection

@section('new_order_page_header')
    {{-- Page Heading --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-2 text-gray-800">@lang('New List')</h1>
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-sliders-h fa-sm text-white-400"></i> @lang('Actions')
        </button>
        <div class="dropdown-menu shadow animated--fade-in" aria-labelledby="dropdownMenuButton">
          <button class="dropdown-item text-center" 
          data-toggle="modal" data-target="#addItemModal" id="testAddItem">
            <i class="fas fa-cart-plus fa-sm text-gray-400"></i> @lang('Add New Item')
          </button>
          <hr>
          <button class="dropdown-item text-center" id="bPlcLst">
            <i class="fas fa-clipboard-check fa-sm text-gray-400"></i> <strong>@lang('Place List')</strong>
          </button>
        </div>
      </div>
    </div>
@endsection

@section('new_order_checkout')
  <form method="POST" action="">
    @csrf
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">@lang('Customer Information')</h6>
      </div>

      <table class="table table-bordered table-responsive-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('Name')</th>
            <th scope="col">@lang('E-Mail Address')</th>
            <th scope="col">@lang('Phone Number')</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th class="align-middle" scope="row">1</th>
            <td class="align-middle">{{ Session::get('userName') }}</td>
            <td class="align-middle">{{ Session::get('userEmail') }}</td>
            <td class="align-middle">{{ Session::get('userPhone') }}</td>
          </tr>
        </tbody>
      </table>

    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">@lang('List Information')</h6>
      </div>

      <table class="table table-bordered table-responsive-xl text-center">
        <thead>
          <tr>
            <th style="width: 5%" scope="col">#</th>
            <th style="width: 10%" scope="col">@lang('Picture')</th>
            <th style="width: 40%" scope="col">@lang('Description')</th>
            <th style="width: 5%" scope="col">Link</th>
            <th style="width: 5%" scope="col">@lang('Quantity')</th>
            <th style="width: 10%" scope="col">@lang('Price')</th>
            <th style="width: 15%" scope="col">Total</th>
            <th style="width: 10%" scope="col">@lang('Actions')</th>
          </tr>
        </thead>
        <tbody id="orderItemList">
          
          <tr class="table table-borderless" id="orderSubTotal">
            <td>   </td>
            <td>   </td>
            <td>   </td>
            <td><h5>Total Items</h5></td>
            <td><h5><strong id="qtyTotal"></strong></h5></td>
            <td><h5>@lang('List Subtotal')</h5></td>
            <td class="text-right"><h5><strong id="subTotal"></strong></h5></td>
            <td>   </td>
          </tr>
          <tr class="table table-borderless">
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td><h5>@lang('Commission') 10%</h5></td>
              <td class="text-right"><h5><strong id="commPerc"></strong></h5></td>
              <td>   </td>
          </tr>
          <tr class="table table-borderless">
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td>   </td>
              <td><h3>@lang('List Total')</h3></td>
              <td class="text-right"><h3><strong id="gTotal"></strong></h3></td>
              <td>   </td>
          </tr>
        </tbody>
      </table>

    </div>
  </form>
    
@endsection

@section('new_order_form_modals')
    {{-- Add Item Modal --}}
  <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('New Item')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="fAddItem">        
            @csrf
            <div class="form-group">
                <label for="inputImage">@lang('Picture')</label>
                <input type="file" class="form-control-file" id="inputImage" name="image"
                  placeholder="@lang('Picture')" accept="image/png, image/jpeg">
            </div>
            <div class="form-group">
                <label for="inputDescription">@lang('Description')</label>
                <textarea class="form-control form-control-user" id="inputDescription" name="description"
                    rows="3" placeholder="@lang('Describe your product here...')" required></textarea>
            </div>
            <div class="form-group">
              <label for="inputLink">@lang('Link')</label>
              <input type="url" class="form-control form-control-user" id="inputLink" name="link"
                  placeholder="@lang('Format: https://example.com')" pattern="https://.*">
            </div>
            <div class="form-group">
              <label for="inputQuantity">@lang('Quantity')</label>
              <input type="number" class="form-control form-control-user" id="inputQuantity" name="quantity"
                  placeholder="@lang('Quantity')" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
            </div>
            <div class="form-group">
              <label for="inputPrice">@lang('Price')</label>
                <div class="input-group mb-6">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="text" class="form-control" id="inputPrice" name="price" placeholder="@lang('Example: 1234567.89')" autocomplete="off" required>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="bAddItem">@lang('Accept')</button>
            <button type="cancel" class="btn btn-cancel" data-dismiss="modal">@lang('Cancel')</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Edit item Modal --}}
  <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Edit Item')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="fEditItem">
            @csrf
            <div class="form-group">
              <label for="inputEditName">@lang('Picture (click on it to change it)')</label>
              <img class="cm-img-dsp-mrg" src="img/karitelocompra_menu_logo.png" id="imgEditImage" onclick="edtImg()"/>
              <input type="file" class="form-control-file cm-npt-dsp" id="inputEditImage" name="image"
              placeholder="@lang('Picture')" accept="image/png, image/jpeg">
            </div>
            <div class="form-group">
              <label for="inputEditDescription">@lang('Description')</label>
              <textarea class="form-control form-control-user" id="inputEditDescription" name="description"
                  rows="3" placeholder="@lang('Describe your product here...')" required></textarea>
            </div>
            <div class="form-group">
              <label for="inputEditLink">@lang('Link')</label>
              <input type="url" class="form-control form-control-user" id="inputEditLink" name="link"
                  placeholder="@lang('Format: https://example.com')" pattern="https://.*">
            </div>
            <div class="form-group">
              <label for="inputEditQuantity">@lang('Quantity')</label>
              <input type="number" class="form-control form-control-user" id="inputEditQuantity" name="quantity"
                  placeholder="@lang('Quantity')" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
            </div>
            <div class="form-group">
              <label for="inputEditPrice">@lang('Price')</label>
                <div class="input-group mb-6">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="text" class="form-control" id="inputEditPrice" name="price" placeholder="@lang('Example: 1234567.89')" autocomplete="off" required>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="bEditItem">@lang('Accept')</button>
            <button type="cancel" class="btn btn-cancel" data-dismiss="modal">@lang('Cancel')</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Item Delete Modal--}}
  <div class="modal fade" id="itemDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Delete Item')</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="deleteModalDiv"></div>
        <div class="modal-body">
          <form id="fDltItem">
            @csrf
            <input type="hidden" name="id" id="inputDeleteId">
            
            <div class="modal-footer">
              <button class="btn btn-cancel" type="button" data-dismiss="modal">@lang('Cancel')</button>
              <button type="button" class="btn btn-primary" id="bDltItem">@lang('Delete')</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('new_order_footer')

  {{-- Page level custom scripts --}}
  <script src="js/order-generator.js"></script>

@endsection