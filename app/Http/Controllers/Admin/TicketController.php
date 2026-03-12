<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\ViewModels\Admin\TicketViewModel as ViewModel;
use Illuminate\Http\Request;
use App\Models\MongoDB\Ticket;
use App\Http\Requests\Admin\TicketRequest;

class TicketController extends Controller
{
  public function __construct(private Ticket $ticket)
  {
  }
 
  public function index()
  {
    try{
      $filters = [
        'fiscal_name' => 'like',
        'datetime' => 'date'
      ];

      $query = $this->ticket;

      foreach ($filters as $field => $type) {
        $value = request($field);

        if ($value === null || $value === '') {
          continue;
        }

        match ($type) {
          'like' => $query->where($field, 'like', '%' . $value . '%'),
          '='    => $query->where($field, $value),
          'date' => $query->whereDate($field, $value),
          default => null,
        };
      }

      $tickets = $query
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();
      
      if(request()->ajax()) {
            
        return response()->json([
          'table' => view('components.tables', ['tableStructure' => ViewModel::tableStructure(), 'records' => $tickets])->render(),
          'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $this->ticket])->render()
        ], 200); 

      }else{

        $view = View::make('admin.tickets.index')
        ->with('tableStructure', ViewModel::tableStructure())
        ->with('formStructure', ViewModel::formStructure())
        ->with('records', $tickets)
        ->with('record', $this->ticket);

        return $view;
      }
    }catch(\Exception $e){
      return response()->json([
        'message' =>  $e->getMessage(),  
      ], 500);
    }
  }

  public function create()
  {
    try {
      if (request()->ajax()) {
        return response()->json([
          'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $this->ticket])->render(),
          
        ], 200);
      }
    } catch (\Exception $e) {
      return response()->json([
          'message' =>  $e->getMessage(),
      ], 500);
    }
  }

  public function store(TicketRequest $request)
  {            
    try{

      $request->validated();
      $data = $request->all();
      $data['_id'] = $request->input('id');

      $ticket = $this->ticket->updateOrCreate([
        'id' => $request->input('id')
      ], $data);

      $tickets = $this->ticket
        ->orderBy('created_at', 'desc')
        ->paginate(10);

      $message = \Lang::get('admin/notification.saved');

      return response()->json([
        'table' => view('components.tables', [
          'tableStructure' => ViewModel::tableStructure(),
          'records' => $tickets
        ])->render(),

        'form' => view('components.forms', [
          'formStructure' => ViewModel::formStructure(),
          'record' => $this->ticket
        ])->render(),

        'message' => $message,
      ], 200);

    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 422);
    }  
  }

  public function show(Ticket $ticket)
  {
    try{
      return response()->json([
        'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $ticket])->render(),
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => $e->getMessage(),
      ], 500);
    }
  }

  public function destroy(Ticket $ticket)
  {
    try{
      $ticket->delete();

      $tickets = $this->ticket
      ->orderBy('created_at', 'desc')
      ->paginate(10);

      $message = \Lang::get('admin/notification.destroy');
      
      return response()->json([
        'table' => view('components.tables', ['tableStructure' => ViewModel::tableStructure(), 'records' => $tickets])->render(),
        'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $this->ticket])->render(),
        'message' => $message,
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => $e->getMessage(),
      ], 500);
    }
  }
}