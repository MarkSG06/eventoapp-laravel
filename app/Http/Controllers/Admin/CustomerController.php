<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MySQL\Customer;
use App\ViewModels\Admin\CustomerViewModel as ViewModel;
use App\Http\Requests\Admin\CustomerRequest;

class CustomerController extends Controller
{
  
  public function __construct(private Customer $customer){}
  
  public function index()
  {
    try{
      $filters = [
        'name' => 'like',
        'email' => 'like'
      ];

      $query = $this->customer;

      foreach ($filters as $field => $type) {
        $value = request($field);

        if ($value === null || $value === '') {
          continue;
        }

        match ($type) {
          'like' => $query->where($field, 'like', '%' . $value . '%'),
          '='    => $query->where($field, $value),
          default => null,
        };
      }

      $customers = $query
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();
      
      if(request()->ajax()) {
            
        return response()->json([
          'table' => view('components.tables', ['tableStructure' => ViewModel::tableStructure(), 'records' => $customers])->render(),
          'form' => view('components.forms', ['formStructure' => ViewModel::formStructure(), 'record' => $this->customer])->render()
        ], 200); 

      }else{

        $view = View::make('admin.customers.index')
        ->with('tableStructure', ViewModel::tableStructure())
        ->with('formStructure', ViewModel::formStructure())
        ->with('records', $customers)
        ->with('record', $this->customer);

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
          'form' => view('components.forms', ['formStructure' => $this->customer->formStructure(), 'record' => $this->customer])->render(),
        ], 200);
      }
    } catch (\Exception $e) {
      return response()->json([
          'message' =>  'hola',
      ], 500);
    }
  }

  public function store(CustomerRequest $request)
  {            
    try{

      $data = $request->validated();

      unset($data['password_confirmation']);
      
      if (!$request->filled('password') && $request->filled('id')){
        unset($data['password']);
      }
  
      $this->customer->updateOrCreate([
        'id' => $request->input('id')
      ], $data);

      $customers = $this->customer
      ->orderBy('created_at', 'desc')
      ->paginate(10);

      if ($request->filled('id')){
        $message = \Lang::get('admin/notification.update');
      }else{
        $message = \Lang::get('admin/notification.create');
      }
      
      return response()->json([
        'table' => view('components.tables', ['tableStructure' => $this->customer->tableStructure(), 'records' => $customers])->render(),
        'form' => view('components.forms', ['formStructure' => $this->customer->formStructure(), 'record' => $this->customer])->render(),
        'message' => $message,
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => $e->getMessage(),
      ], 500);
    }
  }

  public function show(Customer $customer)
  {
    try{
      return response()->json([
        'form' => view('components.forms', ['formStructure' => $this->customer->formStructure(), 'record' => $customer])->render(),
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => 'hola',
      ], 500);
    }
  }

  public function destroy(Customer $customer)
  {
    try{
      $customer->delete();

      $customers = $this->customer
      ->orderBy('created_at', 'desc')
      ->paginate(10);

      $message = \Lang::get('admin/notification.destroy');
      
      return response()->json([
        'table' => view('components.tables', ['tableStructure' => $this->customer->tableStructure(), 'records' => $customers])->render(),
        'form' => view('components.forms', ['formStructure' => $this->customer->formStructure(), 'record' => $this->customer])->render(),
        'message' => $message,
      ], 200);
    }
    catch(\Exception $e){
      return response()->json([
        'message' => 'hola',
      ], 500);
    }
  }
}