<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MySQL\TicketDetail;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TicketDetailRequest;

class TicketDetailController extends Controller
{
  public function __construct(private TicketDetail $ticketDetail){
  }
 
  public function index()
  {
    try{
      $records = $this->ticketDetail
        ->orderBy('created_at', 'desc')
        ->paginate(10);

      $view = View::make('admin.ticketDetails.index')
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

  public function store(TicketDetailRequest $request)
  {  
    try{

     $data = $request->validated();

      $this->ticketDetail->updateOrCreate([
        'id' => $request->input('id')
      ], $data);

      return response()->json([
        'message' => 'TicketDetail creado correctamente',
      ], 201);
    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 422);
    }    
  }

  public function edit(TicketDetail $ticketDetail)
  {
    return response()->json([
      'ticketDetail' => $ticketDetail,
    ], 200);
  }

  public function destroy(TicketDetail $ticketDetail)
  {
    try{
      $ticketDetail->delete();
     
      return response()->json([
        'message' => 'TicketDetail eliminado correctamente',
      ], 200);
    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 500);
    }
  }
}