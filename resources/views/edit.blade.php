<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit Todo List Item</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
        <link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/dist/mdb5/standard/core.min.css">

        <link rel='stylesheet' id='roboto-subset.css-css'  href='https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5' type='text/css' media='all' />
        <link href="{{ asset('/css/todo.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/theme.min.css" rel="stylesheet">

<script>
$(document).ready(function(){
    $("#savebtn").click(function(){
        $("#editform").submit();
    });

    $("#datepickerimage").click(function(){
        $('#dialog').dialog('open');
    }); 

    $(".form-check-input").click(function() {
      //if ( $(this).is(":checked") ) {

        var todo_id = $(this).parent().data('id');

        $.ajax
        ({ 
            url: 'todo/'+todo_id+'/complete',
            data: {"id": todo_id},
            type: 'get',
            success: function(result)
            {
                alert('Completion status changed');
            }
        });

      //}
    });

    $("#todolistforms :input").attr("disabled", true);
});

$(function() {
    $('#dialog').dialog({autoOpen: false, modal: true,
        title: 'Select a date', width: 350, height: 450,
        buttons: {
            OK: function() {
                $('#dateInput').val($('#dpDlg').datepicker('getDate'));
                $('#dialog').dialog('close');
            },
            Cancel: function() {
                $('#dialog').dialog('close');
            }
        }
    });
    $('#dpDlg').datepicker({ onSelect: function() { // Automatic close on selection
        $('#dateInput').val($('#dpDlg').datepicker('getDate'));
        $('#dialog').dialog('close');
      },
      altField: "#date_due", 
      altFormat: "mm/dd/yy",
      defaultDate: new Date({!! $edit->year !!}, ({!! $edit->month !!}-1), {!! $edit->day !!}),
      changeMonth: true,
      changeYear: true
    });
});

  </script>


    </head>
    <body class="antialiased">


<div id="dialog">
  <div id="dpDlg"></div>
</div>

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
          <div class="card-body py-4 px-4 px-md-5">

            <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
              <i class="fas fa-check-square me-1"></i>
              Rios Todo List
            </p>
            <form method="POST" id="editform" action="./">
            <div class="pb-2">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-row align-items-center">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="date_due" name="date_due" value="{{ $edit->month }}/{{ $edit->day }}/{{ $edit->year }}">
                    <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1"
                      value="{{ $edit->name }}" name="name">
                    @csrf
                    <a href="#!" data-mdb-toggle="tooltip" title="Set due date" id="datepickerimage"><i
                        class="fas fa-calendar-alt fa-lg me-3"></i></a>
                    <div>
                      <button type="button" id="savebtn" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </form>

            <hr class="my-4">

<!--             <div class="d-flex justify-content-end align-items-center mb-4 pt-2 pb-3">
              <p class="small mb-0 me-2 text-muted">Filter</p>
              <select class="select">
                <option value="1">All</option>
                <option value="2">Completed</option>
                <option value="3">Active</option>
                <option value="4">Has due date</option>
              </select>
              <p class="small mb-0 ms-4 me-2 text-muted">Sort</p>
              <select class="select">
                <option value="1">Added date</option>
                <option value="2">Due date</option>
              </select>
              <a href="#!" style="color: #23af89;" data-mdb-toggle="tooltip" title="Ascending"><i
                  class="fas fa-sort-amount-down-alt ms-2"></i></a>
            </div> -->

        <div id="todolistforms">
@if ($todos)
    @foreach ($todos as $todo)
        <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
            <li
            class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                <div class="form-check" data-id="{{ $todo->id }}">
                    <input class="form-check-input me-0" type="checkbox" value="1" id="flexCheckChecked{{ $todo->id }}"
                    aria-label="..." 
        @if ($todo->completed == 1)
            checked
        @endif
                     />
                </div>
            </li>
            <li
            class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                <p class="lead fw-normal mb-0">{{ $todo->name }}</p>
            </li>
            <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                <div class="d-flex flex-row justify-content-end mb-1">
                    <span class="text-info"><i
                        class="fas fa-pencil-alt me-3"></i></span>
                        <form action="todo/{{ $todo->id }}" method="POST">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button class="text-danger fas fa-trash-alt" style="border: 0px;"></button>
                        </form>
                </div>
                <div class="text-end text-muted">
                    <span class="text-muted" title="Created date">
                    <p class="small mb-0"><i class="fas fa-info-circle me-2"></i>
                @php
                    print date('jS M Y', strtotime($todo->date_due));
                @endphp
                    
                    </p>
                    </span>
                </div>
            </li>
        </ul>
    @endforeach
@endif
        </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>