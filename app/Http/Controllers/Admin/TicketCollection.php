<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\TicketCollection;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TicketCollectionRequest;

class TicketCollectionController extends Controller
{
  public function __construct(private TicketCollection $ticketCollection){
  }
 
  public function index()
  {
    try{
      $records = $this->ticketCollection
        ->orderBy('created_at', 'desc')
        ->paginate(10);

      $view = View::make('admin.ticketCollections.index')
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

  public function store(TicketCollectionRequest $request)
  {  
    try{

     $data = $request->validated();

      $this->ticketCollection->updateOrCreate([
        'id' => $request->input('id')
      ], $data);

      return response()->json([
        'message' => 'TicketCollection creado correctamente',
      ], 201);
    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 422);
    }    
  }

  public function edit(TicketCollection $ticketCollection)
  {
    return response()->json([
      'ticketCollection' => $ticketCollection,
    ], 200);
  }

  public function destroy(TicketCollection $ticketCollection)
  {
    try{
      $ticketCollection->delete();
     
      return response()->json([
        'message' => 'TicketCollection eliminado correctamente',
      ], 200);
    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 500);
    }
  }
}