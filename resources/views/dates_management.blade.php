@extends('backoffice_layout')

@section('dates_management_title')
    @lang('webtags.company_name') | @lang('Dates Summary')
@endsection

@section('dates_management_header')
    
  {{-- Custom styles for this page --}}
<link href='css/fullcalendar/main.min.css' rel='stylesheet' />
<link href='css/cm_karitelocompra_css.css' rel='stylesheet' />
@endsection

@section('username')

@if (Session::has('userName'))

  {{ Session::get('userName') }}
    
@endif

@endsection

@section('dates_management_page_header')
    {{-- Page Heading --}}
    @if(Session::has('successSeason'))
      <div class="alert alert-success alert-dismissible fade show">
        {{ Session::get('successSeason') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @elseif (Session::has('errorSession'))
      <div class="alert alert-danger alert-dismissible fade show">
          {{ Session::get('errorSession') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-2 text-gray-800">@lang('Dates Summary')</h1>
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-sliders-h fa-sm text-white-400"></i> @lang('Actions')
        </button>
        <div class="dropdown-menu shadow animated--fade-in" aria-labelledby="dropdownMenuButton">
          <a href="" class="dropdown-item" 
          data-toggle="modal" data-target="#addDateModal">
            <i class="fas fa-calendar-plus fa-sm text-gray-400"></i> @lang('New Period')
          </a>
          <a href="" class="dropdown-item" 
          data-toggle="modal" data-target="#addQuotaModal">
            <i class="fas fa-cart-plus fa-sm text-gray-400"></i> @lang('Period Quotas')
          </a>
        </div>
      </div>
        
        
    </div>
@endsection

@section('dates_calendar')

  <div class="calendar" id='calendar'></div>

@endsection

@section('dates_form_modals')
    {{-- Add Date Modal --}}
  <div class="modal fade" id="addDateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('New Period')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('createSeason') }}">
            @csrf
            <div class="form-group">
              <label for="inputAddType">@lang('Period Type')</label>
              <select class="form-control form-control-user" id="inputAddType" name="type">
                <option>@lang('Air')</option>
                <option>@lang('Sea')</option>
              </select>
            </div>
            <div class="form-group">
                <label for="inputAddStart">@lang('Start Date')</label>
                <input type="date" class="form-control form-control-user" id="inputAddStart" name="start_date"
                  placeholder="@lang('Start Date')" onkeydown="return false" required>
            </div>
            <div class="form-group">
              <label for="inputAddEnd">@lang('End Date')</label>
              <input type="date" class="form-control form-control-user" id="inputAddEnd" name="end_date"
                placeholder="@lang('End Date')" onkeydown="return false" required>
                <input type="date" class="form-control form-control-user" id="inputRAddEnd" name="end_r_date"
                placeholder="@lang('End Date')" onkeydown="return false" required hidden>
            </div>
            <div class="form-group">
              <label for="inputAddShip">@lang('Shipment Date')</label>
              <input type="date" class="form-control form-control-user" id="inputAddShip" name="shipment_date"
                placeholder="@lang('Shipment Date')" onkeydown="return false" required>
            </div>
            
            <button type="submit" class="btn btn-primary" onclick="validAddDates()">@lang('Accept')</button>
            <button type="cancel" class="btn btn-cancel" data-dismiss="modal">@lang('Cancel')</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Edit Date Modal --}}
  <div class="modal fade" id="editDateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Period Info')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('updateSeason') }}" id="frmEdtSeason">
            @csrf
            <input type="hidden" id="inputEditId" name="id">
            <div class="form-group">
              <label for="inputEditType">@lang('Period Type')</label>
              <select class="form-control form-control-user" id="inputEditType" name="type">
                <option>@lang('Air')</option>
                <option>@lang('Sea')</option>
              </select>
            </div>
            <div class="form-group">
                <label for="inputEditStart">@lang('Start Date')</label>
                <input type="date" class="form-control form-control-user" id="inputEditStart" name="start_date"
                  placeholder="@lang('Start Date')" onkeydown="return false" required>
            </div>
            <div class="form-group">
              <label for="inputEditEnd">@lang('End Date')</label>
              <input type="date" class="form-control form-control-user" id="inputEditEnd" name="end_date"
                placeholder="@lang('End Date')" onkeydown="return false" required>
                <input type="date" class="form-control form-control-user" id="inputREditEnd" name="end_r_date"
                placeholder="@lang('End Date')" onkeydown="return false" required hidden>
            </div>
            <div class="form-group">
              <label for="inputEditShip">@lang('Shipment Date')</label>
              <input type="date" class="form-control form-control-user" id="inputEditShip" name="shipment_date"
                placeholder="@lang('Shipment Date')" onkeydown="return false" required>
            </div>
            
            <button type="submit" class="btn btn-primary" onclick="validEditDates()">@lang('Accept')</button>
            <button type="cancel" class="btn btn-cancel" data-dismiss="modal">@lang('Cancel')</button>
          </form>
          <hr>
          <button class="btn btn-danger dlt-ssn" data-dismiss="modal" data-toggle="modal" data-target="#dateDeleteModal">@lang('Delete Period')</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Date Delete Modal--}}
  <div class="modal fade" id="dateDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Delete Period')</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="deleteModalDiv"></div>
        <div class="modal-body">
          <form method="POST" action="{{ route('deleteSeason') }}">
            @csrf
            <input type="hidden" name="id" id="inputDeleteId">
            
            <div class="modal-footer">
              <button class="btn btn-cancel" type="button" data-dismiss="modal" data-toggle="modal" data-target="#editDateModal">@lang('Cancel')</button>
              <button type="submit" class="btn btn-primary">@lang('Delete')</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Add Quota Modal --}}
  @if (isset($eventData))
      
    <div class="modal fade" id="addQuotaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('Period Quotas')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('createDayQuota') }}">
              @csrf
              <select class="form-control form-control-user" id="addQuotaSsnIdSlct" name="season_id" hidden>
                
                @foreach(json_decode($eventData, true) as $id)

                  @if ($id['title'] == 'Aéreo' || $id['title'] == 'Marítimo')

                    <option value="{{ $id['id'] }}">{{ $id['id'] }}</option> 

                  @endif
                    
                @endforeach

              </select>

              <select class="form-control form-control-user" id="addQuotaSsnTpSlct" name="select_type" hidden>
                
                @foreach(json_decode($eventData, true) as $type)

                  @if ($type['title'] == 'Aéreo' || $type['title'] == 'Marítimo')

                    <option value="{{ $type['id'] }}">{{ "Cupos ".$type['title'] }}</option> 

                  @endif
  
                @endforeach

              </select>

              <input type="text" class="form-control form-control-user" id="addQuotaTpNpt" name="type"
                  placeholder="@lang('Quota Type')" hidden>

              <select class="form-control form-control-user" id="addQuotaSsnStrtDtSlct" name="season_start_date" hidden>
                  
                @foreach(json_decode($eventData, true) as $strtDate)

                  @if ($strtDate['title'] == 'Aéreo' || $strtDate['title'] == 'Marítimo')

                    <option value="{{ $strtDate['id'] }}">{{ $strtDate['start'] }}</option> 

                  @endif
  
                @endforeach

              </select>
              <select class="form-control form-control-user" id="addQuotaSsnNdDtSlct" name="season_end_date" hidden>
                  
                @foreach(json_decode($eventData, true) as $endDate)

                  @if ($endDate['title'] == 'Aéreo' || $endDate['title'] == 'Marítimo')

                    <option value="{{ $endDate['id'] }}">{{ date('Y-m-d', strtotime($endDate['end'])-1) }}</option> 

                  @endif
  
                @endforeach

              </select>
              <div class="form-group">
                <label for="inputAddType">@lang('Period Type')</label>
                <select class="form-control form-control-user" id="addQuotaSsnSlct" name="season_type">
                  
                  @foreach(json_decode($eventData, true) as $option)

                    @if ($option['title'] == 'Aéreo' || $option['title'] == 'Marítimo')
                      
                      <option value="{{ $option['id'] }}">{{ $option['title'].' : Del '.date('d-m-Y', strtotime($option['start'])).' Al '.date('d-m-Y', strtotime($option['end'])-1)}}</option>    

                    @endif

                  @endforeach

                </select>
              </div>
              <div class="form-group">
                  <label for="inputQuotaAddStart">@lang('Start Date')</label>
                  <input type="date" class="form-control form-control-user" id="inputQuotaAddStart" name="start_date"
                    placeholder="@lang('Start Date')" onkeydown="return false" required>
              </div>
              <div class="form-group">
                <label for="inputQuotaAddEnd">@lang('End Date')</label>
                <input type="date" class="form-control form-control-user" id="inputQuotaAddEnd" name="end_date"
                  placeholder="@lang('End Date')" onkeydown="return false" required>
              </div>
              <div class="form-group">
                <label for="addQuotaNumber">@lang('Quota Quantity')</label>
                <input type="number" class="form-control form-control-user" id="addQuotaNumber" name="quota"
                  placeholder="@lang('Quota Quantity')" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
              </div>
              
              <button type="submit" class="btn btn-primary" onclick="validQuotaAddDates()">@lang('Accept')</button>
              <button type="cancel" class="btn btn-cancel" data-dismiss="modal">@lang('Cancel')</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  @else

    <div class="modal fade" id="addQuotaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('Period Quotas')</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            @lang('No periods found, please create a period in order to be able to create quotas')
          </div>
        </div>
      </div>
    </div>

  @endif

  {{-- Edit Quota Modal --}}
  @if (isset($eventData))

    <div class="modal fade" id="editQuotaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('Quotas Summary')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('updateDayQuota') }}">
              @csrf
              <input type="hidden" id="inputEditQuotaId" name="id">
              <input type="hidden" id="inputEditQuotaBId" name="bid">
              <select class="form-control form-control-user" id="editQuotaTtlSlct" name="quota_title" hidden>
                    
                @foreach(json_decode($eventData, true) as $qtTitle)

                  @if ($qtTitle['title'] == 'Cupos Aéreo' || $qtTitle['title'] == 'Cupos Marítimo')

                    <option value="{{ $qtTitle['id'] }}">{{ $qtTitle['title'] }}</option> 

                  @endif

                @endforeach

              </select>
              <select class="form-control form-control-user" id="editQuotaSsnStrtDtSlct" name="season_start_date" hidden>
                    
                @foreach(json_decode($eventData, true) as $strtDate)

                  @if ($strtDate['title'] == 'Aéreo' || $strtDate['title'] == 'Marítimo')

                    <option value="{{ $strtDate['id'] }}">{{ $strtDate['start'] }}</option> 

                  @endif

                @endforeach

              </select>
              <select class="form-control form-control-user" id="editQuotaSsnNdDtSlct" name="season_end_date" hidden>
                  
                @foreach(json_decode($eventData, true) as $endDate)

                  @if ($endDate['title'] == 'Aéreo' || $endDate['title'] == 'Marítimo')

                    <option value="{{ $endDate['id'] }}">{{ date('Y-m-d', strtotime($endDate['end'])-1) }}</option> 

                  @endif

                @endforeach

              </select>
              <div class="form-group">
                <label for="inputAddType">@lang('Period Type')</label>
                <select class="form-control form-control-user" id="editQuotaSsnSlct" name="season_type" disabled>
                      
                  @foreach(json_decode($eventData, true) as $option)

                    @if ($option['title'] == 'Aéreo' || $option['title'] == 'Marítimo')
                      
                      <option value="{{ $option['id'] }}">{{ $option['title'].' : Del '.date('d-m-Y', strtotime($option['start'])).' Al '.date('d-m-Y', strtotime($option['end'])-1)}}</option>    

                    @endif

                  @endforeach

                </select>
              </div>
              <div class="form-group">
                  <label for="inputQuotaAddStart">@lang('Start Date')</label>
                  <input type="date" class="form-control form-control-user" id="inputQuotaEditStart" name="start_date"
                    placeholder="@lang('Start Date')" onkeydown="return false" required>
              </div>
              <div class="form-group">
                <label for="addQuotaNumber">@lang('Quota Quantity')</label>
                <input type="number" class="form-control form-control-user" id="editQuotaNumber" name="quota"
                  placeholder="@lang('Quota Quantity')" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
              </div>
              
              <button type="submit" class="btn btn-primary" onclick="validQuotaAddDates()">@lang('Accept')</button>
              <button type="cancel" class="btn btn-cancel" data-dismiss="modal">@lang('Cancel')</button>
            </form>
            <hr>
            <button class="btn btn-danger dlt-qt" data-dismiss="modal" data-toggle="modal" data-target="#quotaDeleteModal">@lang('Delete Quota(s)')</button>
          </div>
        </div>
      </div>
    </div>

  @else

    <div class="modal fade" id="addQuotaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('Period Quotas')</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            @lang('No periods found, please create a period in order to be able to create quotas')
          </div>
        </div>
      </div>
    </div>

  @endif
  
  {{-- Quota Delete Modal--}}
  <div class="modal fade" id="quotaDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('Delete Quota(s)')</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="quotaDeleteModalDiv"></div>
        <div class="modal-body">
          <form method="POST" action="{{ route('deleteQuota') }}">
            @csrf
            <input type="hidden" name="id" id="inputQuotaDeleteId">
            
            <div class="modal-footer">
              <button class="btn btn-cancel" type="button" data-dismiss="modal" data-toggle="modal" data-target="#editDateModal">@lang('Cancel')</button>
              <button type="submit" class="btn btn-primary">@lang('Delete')</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('dates_management_footer')

  {{-- Calendar plugins --}}
  <script src='js/fullcalendar/lib/main.min.js'></script>
  <script src='js/fullcalendar/lib/locales/es.js'></script>
  <script>
    /**
 * Full Calendar Query
 */

document.addEventListener('DOMContentLoaded', function() {

var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
  locale: 'es',
  initialView: 'dayGridMonth',
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
  },
  height: '100vh',
  fixedWeekCount: false,
  navLinks: true, // can click day/week names to navigate views
  editable: false, //on 'false' state disables dragging and resizing
  selectable: true,
  selectMirror: true,
  nowIndicator: true,
  dayMaxEvents: true, // allow "more" link when too many events
  expandRows: true,

  {!! isset($dates) ? $dates : ''  !!}
  
  select: function(start){

    $('#inputAddStart').val(start.startStr);
    $('#inputAddEnd').val(new Date(start.end.setDate(start.end.getDate() -1)).toISOString().split('T')[0]);
    $('#inputRAddEnd').val(start.endStr);
    $('#inputAddShip').val(new Date(start.end).toISOString().split('T')[0]);
    $('#addDateModal').modal('show');

  },

  eventClick: function (info){

    if (info.event.title == 'Aéreo' || info.event.title == 'Marítimo'){
      
      var endDate = new Date(info.event.endStr);

      $('#inputEditId').val(info.event.id);
      $('#inputEditType').val(info.event.title).change();
      $('#inputEditStart').val(info.event.startStr);
      $('#inputEditEnd').val(new Date(endDate.setDate(endDate.getDate() -1)).toISOString().split('T')[0]);
      $('#inputREditEnd').val(new Date(endDate.setDate(endDate.getDate() +1)).toISOString().split('T')[0]);
      $('#inputEditShip').val(info.event.extendedProps.ship);
      $('#editDateModal').modal('show');
    
    }else{

      $('#inputEditQuotaId').val(info.event.id);
      $('#inputEditQuotaBId').val(info.event.extendedProps.bid);
      $('#inputQuotaEditStart').val(info.event.startStr);
      $('#editQuotaNumber').val(info.event.extendedProps.quota);

      $('#editQuotaSsnSlct').val(info.event.extendedProps.bid).change();

      $('#editQuotaTtlSlct').val(info.event.id).change();

      $('#editQuotaSsnStrtDtSlct').val(info.event.extendedProps.bid).change();

      $('#editQuotaSsnNdDtSlct').val(info.event.extendedProps.bid).change();

      $('#inputQuotaEditStart').attr("min", $('#editQuotaSsnStrtDtSlct option:selected').text());

      $('#inputQuotaEditStart').attr("max", $('#editQuotaSsnNdDtSlct option:selected').text());

      $('#editQuotaModal').modal('show');

    }
  },

});

calendar.render();

});
</script>

@endsection