<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TicketRequest;

class TicketController extends Controller
{
  public function __construct(private Ticket $ticket){
  }
 
  public function index()
  {
    try{
      $records = $this->ticket
        ->orderBy('created_at', 'desc')
        ->paginate(10);

      $view = View::make('admin.tickets.index')
         ->with('records', $records);

      return $view;
    }
    catch(\Exception $e){
     
    }
  }

  public function create()
  {
   try {
      if (request()->ajax()) {
        return response()->json([
        ], 200);
      }
    } catch (\Exception $e) {
      return response()->json([
        'message' =>  \Lang::get('admin/notification.error'),
      ], 500);
    }
  }

  public function store(TicketRequest $request)
  {  
    try{

     $data = $request->validated();

      $this->ticket->updateOrCreate([
        'id' => $request->input('id')
      ], $data);

      return response()->json([
        'message' => 'Ticket creado correctamente',
      ], 201);
    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 422);
    }    
  }

  public function edit(Ticket $ticket)
  {
    return response()->json([
      'ticket' => $ticket,
    ], 200);
  }

  public function destroy(Ticket $ticket)
  {
    try{
      $ticket->delete();
     
      return response()->json([
        'message' => 'Ticket eliminado correctamente',
      ], 200);
    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 500);
    }
  }
}